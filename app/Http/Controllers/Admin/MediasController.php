<?php

namespace App\Http\Controllers\Admin;

use App\Media;
use Illuminate\Http\Request;
use App\Http\Requests\MediaRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Intervention\Image\ImageManagerStatic as Image;

class MediasController extends Controller
{
    /**
     * Show media library page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        // get all medias
        $medias = Media::whereIn('type', ["jpeg", "jpg", "png", "gif"])->orderBy('created_at', 'desc')->paginate(35);

        // get all dates
        $dates = Media::selectRaw('DATE_FORMAT(created_at, "%M %Y") as date')->distinct()->get()->pluck('date', 'date');

        $dates->prepend('All Dates', '');

        return view('admin.media.index', compact('medias', 'dates'));
    }

    public function documents() {
        // get all medias
        $medias = Media::whereIn('type', ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'xlsm'])->orderBy('created_at', 'desc')->paginate(35);

        return view('admin.media.documents', compact('medias'));
    }

    /**
     * Show medias by date
     * @param $date
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($mediaDate) {
        // get all medias
        $medias = Media::whereRaw('DATE_FORMAT(created_at, "%M %Y") = "'.$mediaDate.'"')
            ->orderBy('created_at', 'desc')
            ->paginate(35);

        // get all dates
        $dates = Media::selectRaw('DATE_FORMAT(created_at, "%M %Y") as date')->distinct()->get()->pluck('date', 'date');

        $dates->prepend('All Dates', '');

        return view('admin.media.index', compact('medias', 'dates', 'mediaDate'));
    }

    /**
     * Create new media
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('admin.media.create');
    }

    /**
     * Upload files
     */
    public function store(MediaRequest $request) {
        // get file
        $file = $request->file('file');
        // set folder
        $folder = '/uploads/' . date('Y/m') . '/';
        // set uploads path
        $destinationPath = public_path() . $folder;
        // get file name
        $fileName = $file->getClientOriginalName();
        // get only extension
        $type = pathinfo($fileName, PATHINFO_EXTENSION);
        // get only name
        $name = Media::getName(pathinfo($fileName, PATHINFO_FILENAME));
        // create folder if not exist
        File::makeDirectory($destinationPath, 0775, true, true);
        // move the uploaded files to the destination directory
        $file = $file->move($destinationPath, $name . '.' . $type);

        if( $file ) {
            if(in_array($type, array('jpeg','jpg','png','gif'))) {
                // read image from temporary file
                $img = Image::make($file);
                // generate thumbnail
                $thumbnail = $this->generateThumbnail($img, $destinationPath, $name, $type);
                // get url
                $url = $folder . $name . '.' . $type;
            } else {
                $thumbnail = '';
                $url = '/admin_tmpl/dist/img/media/' . $type . '.jpg';
            }

            // insert media in db
            $media = Media::create([
                'name' => $name,
                'folder' => $folder,
                'type' => $type,
                'thumbnail' => $thumbnail
            ]);

            $data = [
                'url' => $url,
                'id' => $media->id
            ];

            return json_encode($data);
        }
    }

    public function destroy(Request $request) {
        // get elected files
        $files = $request->input('files');

        if($files) {
            // delete selected files
            foreach($files as $id) {
                // get media by id
                $media = Media::findOrFail($id);
                // delete image form disk
                unlink(public_path() . $media->image());
                // delete thumbnail form disk
                if($media->thumbnail != '') {
                    unlink(public_path() . $media->thumbnail());
                }
                // delete media from db
                $media->delete();
            }

            $message = [
                'flash_message' => 'Files successfully deleted.',
                'flash_message_type' => 'success'
            ];

        } else {
            $message = [
                'flash_message' => 'You need to select at least one file.',
                'flash_message_type' => 'warning'
            ];
        }

        return redirect()->back()->with($message);
    }

    /**
     * Generate thumbnail
     * @param $img
     * @param $folder
     * @param $name
     * @param $ext
     * @return mixed
     */
    private function generateThumbnail($img, $folder, $name, $ext) {
        // set width
        $width = 300;
        // set height
        $height = 250;

        // resize image
        $img->fit($width, $height);

        // set file name
        $filename = $name . '-' . $width . 'x' . $height . '.' . $ext;

        // save image
        if($img->save($folder . '/' . $filename))
            return $width . 'x' . $height;
        else
            return null;
    }
}
