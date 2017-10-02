<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SliderValidation;
use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $sliders = Slider::all();
        return view('admin.sliders.index', compact('sliders'));
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
            'order' => $request->input('order'),
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if($request->ajax()){
            return Slider::findOrFail($request->slider_id);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
