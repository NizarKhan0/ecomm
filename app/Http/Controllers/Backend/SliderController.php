<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function AllSlider()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all', ['sliders' => $sliders]);
    }

    public function AddSlider()
    {
        return view('backend.slider.slider_add');
    }

    public function StoreSlider(Request $request)
    {
                   // Validate the request to ensure the file is present and is an image
        $request->validate([
            'slider_title' => 'required|string|max:255',
            'short_title' => 'required|string|max:255',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $images = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalName();
        // Image::make($images)->resize(300, 300)->save('upload/brand_images/' . $name_gen);
        $images->move(public_path('upload/slider_images'), $name_gen);
        $save_url = 'upload/slider_images/' . $name_gen;

        Slider::insert([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    }

    public function EditSlider($id)
    {
        $slider = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', ['slider' => $slider]);
    }

    public function UpdateSlider(Request $request)
    {
        $slider_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('slider_image')) {

            $images = $request->file('slider_image');
            $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalName();
            // Image::make($images)->resize(300, 300)->save('upload/brand_images/' . $name_gen);
            $images->move(public_path('upload/slider_images'), $name_gen);
            $save_url = 'upload/slider_images/' . $name_gen;

            // Check and delete old image if exists
            // $old_image_path = public_path('upload/brand_images/' . $old_image);

            // if (file_exists($old_image_path)) {
            //     @unlink($old_image_path);
            // }
            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $save_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Slider Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.slider')->with($notification);
        } else {
            Slider::findOrFail($slider_id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Slider Updated Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.slider')->with($notification);
        }
    }

    public function DeleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        if (file_exists($slider->slider_image)) {
            unlink($slider->slider_image);
        }
        $slider->delete();
        $notification = array(
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
