<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\ShipState;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Models\ShipDistricts;
use App\Http\Controllers\Controller;

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

    public function AllState()
    {
        $division = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistricts::orderBy('districts_name', 'ASC')->get();
        $state = ShipState::latest()->get();

        return view('backend.ship.state.state_all', [
            'division' => $division,
            'district' => $district,
            'state' => $state,
        ]);
    }

    public function AddState()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistricts::orderBy('districts_name', 'ASC')->get();
        return view('backend.ship.state.state_add', [
            'divisions' => $divisions,
            'districts' => $districts
        ]);
    }

    public function StoreState(Request $request)
    {
        $request->validate([
            'division_id' => 'required',
            'districts_id' => 'required',
            'states_name' => 'required',
        ]);
        ShipState::insert([
            'division_id' => $request->division_id,
            'districts_id' => $request->districts_id,
            'states_name' => $request->states_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'State Added Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->route('all.state')->with($notification);
    }

    public function EditState($id)
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistricts::orderBy('districts_name', 'ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.ship.state.state_edit', [
            'divisions' => $divisions,
            'districts' => $districts,
            'state' => $state
        ]);
    }

    public function UpdateState(Request $request)
    {
        $state_id = $request->id;

        $request->validate([
            'division_id' => 'required',
            'districts_id' => 'required',
            'states_name' => 'required',
        ]);

        ShipState::findOrFail($state_id)->update([
            'division_id' => $request->division_id,
            'districts_id' => $request->districts_id,
            'states_name' => $request->states_name,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'State Updated Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('all.state')->with($notification);
    }

    public function DeleteState($id)
    {
        ShipState::findOrFail($id)->delete();
        $notification = array(
            'message' => 'State Deleted Successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function GetDistrict($division_id){
        $dist = ShipDistricts::where('division_id',$division_id)->orderBy('districts_name','ASC')->get();
            return json_encode($dist);

    }// End Method kalau guna AJAX
}
