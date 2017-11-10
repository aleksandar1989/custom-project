<?php

namespace App\Http\Controllers\Admin\Ajax;

use App\Media;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Intervention\Image\ImageManagerStatic as Image;

class MediasController extends Controller
{
    protected $allowed = [
        'loadMore',
        'crop'
    ];

    /**
     * Detect action and call it
     * @param $action
     * @return mixed
     */
    public function init(Request $request){
        $action = $request->input('action');
        if( in_array($action, $this->allowed) && $request->ajax() )
            return $this->$action($request);
    }

    private function loadMore(Request $request) {
        // get medias
        $medias = Media::whereIn('type', ["jpeg", "jpg", "png", "gif"])->orderBy('created_at', 'desc')->paginate(30);

        $hasMorePages = $medias->hasMorePages();

        $data = [];

        if($medias->count()) {
            foreach($medias as $media) {
                $data[] = (String)view('admin.media.media', compact('media'));
            }
        }

        return array(
            'data' => $data,
            'hasMore' => $hasMorePages
        );
    }

    private function crop(Request $request) {
        $id = $request->input('id');
        $image = $request->input('image');

        // get media by id
        $media = Media::findOrFail($id);

        // set image permission
        chmod(public_path() . $media->image(), 0777);
        chmod(public_path() . $media->thumbnail(), 0777);

        if( $media->type == 'png' ) {
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $data = base64_decode($image);
            $status = file_put_contents(public_path() . $media->image(), $data);
        } elseif( $media->type == 'jpg' || $media->type == 'jpeg' || $media->type== 'gif' ) {
            list($width, $height) = getimagesize($image);
            $file = imagecreatetruecolor($width, $height);
            $new = imagecreatefrompng($image);
            $kek = imagecolorallocate($file, 255, 255, 255);
            imagefill($file, 0, 0, $kek);
            imagecopyresampled($file, $new, 0, 0, 0, 0, $width, $height, $width, $height);

            if($media->type == 'gif') {
                $status = imagegif($file, public_path() . $media->image(), 100);
            } else {
                $status = imagejpeg($file, public_path() . $media->image(), 100);
            }

        }

        // generate new thumbnail
        $thumbnail = public_path() . $media->thumbnail();

        // set width
        $width = 300;

        // set height
        $height = 250;

        // delete old thumbnail
        unlink($thumbnail);

        // create Image from file
        $img = Image::make($image);

        // crop image
        $img->fit($width, $height);

        Image::canvas($width, $height, '#ffffff')
            ->insert($img)
            ->save(public_path() . $media->folder . $media->name . '-' . $width . 'x' . $height . '.' . $media->type);

        // save new thumbnail dimensions
        $media->thumbnail = $width . 'x' . $height;
        $media->save();

        return [
            'status' => $status
        ];
    }
}
