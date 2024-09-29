<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all', ['brands' => $brands]);
    }

    public function AddBrand()
    {
        return view('backend.brand.brand_add');
    }

    public function StoreBrand(Request $request)
    {
        // Validate the request to ensure the file is present and is an image
        $request->validate([
            'brand_name' => 'required|string|max:255',
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $images = $request->file('brand_image');
        $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalName();
        // Image::make($images)->resize(300, 300)->save('upload/brand_images/' . $name_gen);
        $images->move(public_path('upload/brand_images'), $name_gen);
        $save_url = 'upload/brand_images/' . $name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            'brand_image' => $save_url,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);
    }

    public function EditBrand($id)
    {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', ['brand' => $brand]);
    }

    public function UpdateBrand(Request $request)
    {
        $brand_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('brand_image')) {

            $images = $request->file('brand_image');
            $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalName();
            // Image::make($images)->resize(300, 300)->save('upload/brand_images/' . $name_gen);
            $images->move(public_path('upload/brand_images'), $name_gen);
            $save_url = 'upload/brand_images/' . $name_gen;

            // Check and delete old image if exists
            // $old_image_path = public_path('upload/brand_images/' . $old_image);

            // if (file_exists($old_image_path)) {
            //     @unlink($old_image_path);
            // }
            if(file_exists($old_image))
            {
                unlink($old_image);
            }

            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Brand Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brand')->with($notification);
        } else {
            Brand::findOrFail($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Brand Updated Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.brand')->with($notification);
        }
    }

    public function DeleteBrand($id)
    {
        $brand = Brand::findOrFail($id);
        if (file_exists($brand->brand_image)) {
            unlink($brand->brand_image);
        }
        $brand->delete();
        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
