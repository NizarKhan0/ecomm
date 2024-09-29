<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_all', ['categories' => $categories]);
    }

    public function AddCategory()
    {
        return view('backend.category.category_add');
    }

    public function StoreCategory(Request $request)
    {
        // Validate the request to ensure the file is present and is an image
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $images = $request->file('category_image');
        $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalName();
        // Image::make($images)->resize(300, 300)->save('upload/brand_images/' . $name_gen);
        $images->move(public_path('upload/category_images'), $name_gen);
        $save_url = 'upload/category_images/' . $name_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'category_image' => $save_url,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }

    public function EditCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', ['category' => $category]);
    }

    public function UpdateCategory(Request $request)
    {
        $category_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('category_image')) {

            $images = $request->file('category_image');
            $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalName();
            // Image::make($images)->resize(300, 300)->save('upload/brand_images/' . $name_gen);
            $images->move(public_path('upload/category_images'), $name_gen);
            $save_url = 'upload/category_images/' . $name_gen;

            // Check and delete old image if exists
            // $old_image_path = public_path('upload/brand_images/' . $old_image);

            // if (file_exists($old_image_path)) {
            //     @unlink($old_image_path);
            // }
            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $save_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Category Updated With Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.category')->with($notification);
        } else {
            Category::findOrFail($category_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Category Updated Without Image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.category')->with($notification);
        }
    }
    public function DeleteCategory($id)
    {
        $category = Category::findOrFail($id);
        if (file_exists($category->category_image)) {
            unlink($category->category_image);
        }
        $category->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
