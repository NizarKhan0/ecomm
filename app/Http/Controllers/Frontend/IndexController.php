<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\MultiImg;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;

class IndexController extends Controller
{

    public function Index()
    {
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)
        ->orderBy('id', 'DESC')->limit(5)->get();
        // dd($skip_category_0);

        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', 1)->where('category_id', $skip_category_1->id)
        ->orderBy('id', 'DESC')->limit(5)->get();

        $hot_deals = Product::where('hot_deals', 1)->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->limit(3)->get();

        $special_offer = Product::where('special_offer', 1)->where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $new_products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();

        $special_deals = Product::where('special_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.index', [
            'skip_category_0' => $skip_category_0,
            'skip_product_0' => $skip_product_0,
            'skip_category_1' => $skip_category_1,
            'skip_product_1' => $skip_product_1,
            'hot_deals' => $hot_deals,
            'special_offer' => $special_offer,
            'new_products' => $new_products,
            'special_deals' => $special_deals
        ]);
    }

    public function ProductDetails($id, $slug)
    {
        $product = Product::findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        $multiImage = MultiImg::where('product_id', $id)->get();

        $category_id = $product->category_id;
        //Untuk taknak ambil id yg dh requat kat page yg sama
        $relatedProduct = Product::where('category_id', $category_id)->where('id', '!=', $id)
        ->orderBy('id', 'DESC')->limit(4)->get();


        return view('frontend.product.product_details', [
            'product' => $product,
            'product_color' => $product_color,
            'product_size' => $product_size,
            'multiImage' => $multiImage,
            'relatedProduct' => $relatedProduct
        ]);
    }

    public function VendorDetails($id)
    {
        $vendor = User::findOrFail($id);
        $vproduct = Product::where('vendor_id', $id)->get();

        return view('frontend.vendor.vendor_details', [
            'vendor' => $vendor,
            'vproduct' => $vproduct
        ]);
    }

    public function VendorAll()
    {
        $vendors = User::where('role', 'vendor')->where('status', 'active')->orderBy('id', 'DESC')->get();

        return view('frontend.vendor.vendor_all', [
            'vendors' => $vendors
        ]);
    }

    public function CatWiseProduct(Request $request, $id, $slug)
    {
        $products = Product::where('category_id', $id)->where('status', 1)->orderBy('id', 'DESC')->get();

        $categories = Category::orderBy('category_name', 'ASC')->get();

        $breadcat = Category::where('id', $id)->first();

        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();


        return view('frontend.product.category_view', [
            'products' => $products,
            'categories' => $categories,
            'breadcat' => $breadcat,
            'newProduct' => $newProduct
        ]);
    }

    public function SubCatWiseProduct(Request $request, $id, $slug)
    {
        $products = Product::where('subcategory_id', $id)->where('status', 1)->orderBy('id', 'DESC')->get();

        $categories = Category::orderBy('category_name', 'ASC')->get();

        $breadsubcat = SubCategory::where('id', $id)->first();

        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();


        return view('frontend.product.subcategory_view', [
            'products' => $products,
            'categories' => $categories,
            'breadsubcat' => $breadsubcat,
            'newProduct' => $newProduct
        ]);
    }


    public function ProductViewAjax($id)
    {
        $product = Product::with('category', 'subcategory', 'brand')->findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        return response()->json(array(
            'product' => $product,
            'color' => $color,
            'size' => $size
        ));
    }
}
