<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function AllBanner()
    {
        $banners = Banner::latest()->get();
        return view('backend.banner.banner_all', ['banners' => $banners]);
    }

    public function AddBanner()
    {
        return view('backend.banner.banner_add');
    }

    public function StoreBanner(Request $request)
    {
                   // Validate the request to ensure the file is present and is an image
        $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_url' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $images = $request->file('banner_image');
        $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalName();
        // Image::make($images)->resize(300, 300)->save('upload/brand_images/' . $name_gen);
        $images->move(public_path('upload/banner_images'), $name_gen);
        $save_url = 'upload/banner_images/' . $name_gen;

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Banner Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification);
    }

    public function EditBanner($id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.banner.banner_edit', ['banner' => $banner]);
    }

    public function UpdateBanner(Request $request)
    {
        $banner_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('banner_image')) {

            $images = $request->file('banner_image');
            $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalName();
            // Image::make($images)->resize(300, 300)->save('upload/brand_images/' . $name_gen);
            $images->move(public_path('upload/banner_images'), $name_gen);
            $save_url = 'upload/banner_images/' . $name_gen;

            // Check and delete old image if exists
            // $old_image_path = public_path('upload/brand_images/' . $old_image);

            // if (file_exists($old_image_path)) {
            //     @unlink($old_image_path);
            // }
            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Banner::findOrFail($banner_id)->update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
                'banner_image' => $save_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Banner Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.banner')->with($notification);
        } else {
            Banner::findOrFail($banner_id)->update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Banner Updated Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.banner')->with($notification);
        }
    }

    public function DeleteBanner($id)
    {
        $banner = Banner::findOrFail($id);
        if (file_exists($banner->banner_image)) {
            unlink($banner->banner_image);
        }
        $banner->delete();
        $notification = array(
            'message' => 'Banner Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
