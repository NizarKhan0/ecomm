<?php

namespace App\Http\Controllers\User;

use App\Models\ShipState;
use Illuminate\Http\Request;
use App\Models\ShipDistricts;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function DistrictGetAjax($division_id)
    {
        $districts = ShipDistricts::where('division_id', $division_id)->get();
        // dd($districts);
        return response()->json($districts);

    }


    public function StateGetAjax($districts_id)
    {
        $states = ShipState::where('districts_id', $districts_id)->get();
        return response()->json($states);
    }

    public function CheckoutStore(Request $request){

        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;

        $data['division_id'] = $request->division_id;
        $data['districts_id'] = $request->districts_id;
        $data['states_id'] = $request->states_id;
        $data['shipping_address'] = $request->shipping_address;
        $data['notes'] = $request->notes;
        $cartTotal = Cart::total();

        if ($request->payment_option == 'stripe') {
           return view('frontend.payment.stripe',compact('data','cartTotal'));
        }elseif ($request->payment_option == 'card'){
            return 'Card Page';
        }else{
            return view('frontend.payment.cash',compact('data','cartTotal'));
        }


    }// End Method
}
