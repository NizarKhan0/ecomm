<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function AllCoupon()
    {
        $coupon = Coupon::latest()->get();
        return view('backend.coupon.coupon_all', ['coupon' => $coupon]);
    }

    public function AddCoupon()
    {
        return view('backend.coupon.coupon_add');
    }

    public function StoreCoupon(Request $request)
    {
        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
        ]);

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification);
    }

    public function EditCoupon($id)
    {
        $coupons = Coupon::findOrFail($id);
        return view('backend.coupon.coupon_edit', ['coupon' => $coupons]);
    }

    public function UpdateCoupon(Request $request)
    {
        $coupon_id = $request->id;

        $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',
        ]);

        Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification);
    }

    public function DeleteCoupon($id)
    {
        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
