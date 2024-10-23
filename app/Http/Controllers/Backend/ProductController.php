<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\MultiImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\VendorController;

class ProductController extends Controller
{
    public function AllProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_all', ['products' => $products]);
    }

    public function AddProduct()
    {
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view(
            'backend.product.product_add',
            [
                'activeVendor' => $activeVendor,
                'brands' => $brands,
                'categories' => $categories
            ]
        );
    }

    public function StoreProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
        ]);

        // Handling single image upload
        $image = $request->file('product_thumbnail');
        $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalName(); // Ensure correct file extension
        $image->move(public_path('upload/products/thumbnail'), $image_name); // Move to the correct directory
        $save_url = 'upload/products/thumbnail/' . $image_name; // Correct the save URL

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            'product_thumbnail' => $save_url,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        // Handling multiple image upload
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalName(); // Ensure correct file extension
            $img->move(public_path('upload/products/multi-images'), $make_name); // Move to the correct directory
            $uploadPath = 'upload/products/multi-images/' . $make_name; // Correct the save URL

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function EditProduct($id)
    {
        $multiImgs = MultiImg::where('product_id', $id)->get();
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view(
            'backend.product.product_edit',
            [
                'activeVendor' => $activeVendor,
                'brands' => $brands,
                'categories' => $categories,
                'products' => $products,
                'subcategories' => $subcategories,
                'multiImgs' => $multiImgs
            ]
        );
    }

    public function UpdateProduct(Request $request)
    {
        $product_id = $request->id;

        $request->validate([
            'product_name' => 'required|string|max:255',
        ]);

        Product::findOrFail($product_id)->update([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
            // 'product_thumbnail' => $save_url,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }


    public function UpdateProductThumbnail(Request $request)
    {
        $pro_id = $request->id;
        $oldImage = public_path($request->old_img);

        $image = $request->file('product_thumbnail');
        if ($image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalName();
            $image->move(public_path('upload/products/thumbnail'), $name_gen);
            $save_url = 'upload/products/thumbnail/' . $name_gen; // Fixed missing slash

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            Product::findOrFail($pro_id)->update([
                'product_thumbnail' => $save_url,
                'updated_at' => now(), // Use Carbon directly if not using Carbon\Carbon namespace
            ]);

            $notification = [
                'message' => 'Product Image Thumbnail Updated Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'message' => 'No Image Selected',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function UpdateProductMultiImage(Request $request)
    {
        if ($request->has('multi_img') && is_array($request->multi_img)) {
            $imgs = $request->multi_img;

            foreach ($imgs as $id => $img) {
                $imgDel = MultiImg::findOrFail($id);
                if (file_exists($imgDel->photo_name)) {
                    unlink($imgDel->photo_name);
                }

                $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('upload/products/multi-images'), $make_name);
                $uploadPath = 'upload/products/multi-images/' . $make_name;

                MultiImg::where('id', $id)->update([
                    'photo_name' => $uploadPath,
                    'updated_at' => now(),
                ]);
            }

            $notification = [
                'message' => 'Product Multi Image Updated Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        }

        $notification = [
            'message' => 'No images to update',
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($notification);
    }


    public function MultiImageDelete($id)
    {
        $imgDel = MultiImg::findOrFail($id);
        if (file_exists($imgDel->photo_name)) {
            unlink($imgDel->photo_name);
        }

        $imgDel->delete();

        $notification = [
            'message' => 'Product Multi Image Deleted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function InactiveProduct($id)
    {
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactivated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ActiveProduct($id)
    {
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Activated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function DeleteProduct($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $multiImgs = MultiImg::where('product_id', $id)->get();
        foreach ($multiImgs as $img) {
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ProductStock(){

        $products = Product::latest()->get();
        return view('backend.product.product_stock',compact('products'));

    }// End Method

}
