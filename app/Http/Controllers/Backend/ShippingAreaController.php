<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShipDistricts;

class ShippingAreaController extends Controller
{
    public function AllDivision()
    {
        $division = ShipDivision::latest()->get();
        return view('backend.ship.division.division_all', ['division' => $division]);
    }

    public function AddDivision()
    {
        return view('backend.ship.division.division_add');
    }

    public function StoreDivision(Request $request)
    {
        $request->validate([
            'division_name' => 'required',
            // 'division_name' => 'required|unique:ship_divisions,division_name',
        ]);
        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Division Added Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.division')->with($notification);
    }

    public function EditDivision($id)
    {
        $division = ShipDivision::findOrFail($id);
        return view('backend.ship.division.division_edit', ['division' => $division]);
    }

    public function UpdateDivision(Request $request)
    {
        $division_id = $request->id;

        $request->validate([
            'division_name' => 'required',
        ]);

        ShipDivision::findOrFail($division_id)->update([
            'division_name' => $request->division_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Division Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('all.division')->with($notification);
    }

    public function DeleteDivision($id)
    {
        ShipDivision::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function AllDistrict()
    {
        $district = ShipDistricts::latest()->get();
        return view('backend.ship.district.district_all', ['district' => $district]);
    }

    public function AddDistrict()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        return view('backend.ship.district.district_add', ['divisions' => $divisions]);
    }

    public function StoreDistrict(Request $request)
    {
        $request->validate([
            'division_id' => 'required',
            'districts_name' => 'required',
        ]);
        ShipDistricts::insert([
            'division_id' => $request->division_id,
            'districts_name' => $request->districts_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'District Added Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.district')->with($notification);
    }

    public function EditDistrict($id)
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::findOrFail($id);

        return view('backend.ship.district.district_edit', [
            'divisions' => $divisions,
            'district' => $district
        ]);
    }

    public function UpdateDistrict(Request $request)
    {
        $district_id = $request->id;

        $request->validate([
            'division_id' => 'required',
            'districts_name' => 'required',
        ]);

        ShipDistricts::findOrFail($district_id)->update([
            'division_id' => $request->division_id,
            'districts_name' => $request->districts_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'District Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('all.district')->with($notification);
    }

    public function DeleteDistrict($id)
    {
        ShipDistricts::findOrFail($id)->delete();

        $notification = array(
            'message' => 'District Deleted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    } // End Method

}
