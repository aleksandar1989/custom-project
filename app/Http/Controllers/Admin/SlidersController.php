<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SliderValidation;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Cache::remember('slider_posts_cache', 1, function (){
            return Slider::all();
        });
        return view('admin.sliders.index', compact('sliders'));
    }

    /**
     * Create new slider
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderValidation $request)
    {
        $slider_image = $request->file('image');
        $image_name = $slider_image->getClientOriginalName();

        $slider = Slider::create([
            'title' => $request->input('title'),
            'url' => $request->input('url'),
            'image' => $image_name,
            'content' => $request->input('content'),
            'position' => $request->input('position'),
            'type' => $request->input('type'),
            'order' => $request->input('order') ? $request->input('order') : 1,
        ]);

        if($slider){
            // upload slider
            //  get slider path
            if( $slider->type == 'slider' ){
                $destinationPath = public_path('/images/slider/');
            }else{
                $destinationPath = public_path('/images/banner/');
            }

            //  if image with same nama already exist
            if(File::exists($destinationPath.$image_name)){
                $i = 1;
                while(File::exists($destinationPath.$image_name))
                {
                    $image_crop_ext = explode('.', $image_name);
                    $image_name = $image_crop_ext[0].$i.'.'.$image_crop_ext[1];
                    $i++;
                }
            }

            //  move image to location
            $slider_image->move($destinationPath, $image_name);

            $notification = array(
                'message' => 'Slider is successfully created!',
                'type' => 'success'
            );

        }else{
            $notification = array(
                'message' => 'Slider doesn\'t create!',
                'type' => 'error'
            );
        }

        return redirect('/admin/sliders')->with($notification);
    }


    /**
     * Edit Slider
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        // get user by id
        $slider = Slider::findOrFail($id);

        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderValidation $request, $id)
    {
        // get user by id
        $slider = Slider::findOrFail($id);

        $image = $request->file('image');

        $slider->title = $request->input('title');
        $slider->url = $request->input('url');
        $slider->content = $request->input('content');
        $slider->position = $request->input('position');
        $slider->type = $request->input('type');
        $slider->order = $request->input('order');

        // upload slider
        if($image) {
            // upload slider
            $image_name = $image->getClientOriginalName();
            //  get slider path
            if( $slider->type == 'slider' ){
                $destinationPath = public_path('/images/slider/');
            }else{
                $destinationPath = public_path('/images/banner/');
            }

            //  if image with same nama already exist
            if(File::exists($destinationPath.$image_name)){
                $i = 1;
                while(File::exists($destinationPath.$image_name))
                {
                    $image_crop_ext = explode('.', $image_name);
                    $image_name = $image_crop_ext[0].$i.'.'.$image_crop_ext[1];
                    $i++;
                }
            }

            //  move image to location
            $image->move($destinationPath, $image_name);
            $slider->image = $image_name;
        }


        if($slider->update()) {
            $notification = array(
                'message' => 'Slider is  successfully updated!',
                'type' => 'success'
            );
        } else{
            $notification = array(
                'message' => 'Slider doesn\'t update!',
                'type' => 'error'
            );
        }

        return redirect()->back()->with($notification);
    }

    /**
     * Delete slider
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get user
        $slider = Slider::findOrFail($id);

        if($slider->delete()) {
            $message = [
                'message' => 'Slider has been deleted.',
                'type' => 'success'
            ];
        } else {
            $message = [
                'message' => 'Slider has not been deleted.',
                'type' => 'danger'
            ];
        }

        return redirect()->back()->with($message);
    }
}
