<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }
    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view(
            'admin.admin_profile_view',
            [
                'adminData' => $adminData
            ]
        );
    }

    public function AdminProfileStore(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        // ]);

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_change_password', [
            'adminData' => $adminData
        ]);
    }

    public function AdminUpdateChangePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        // Update The New Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password Changed Successfully!");
    }

    public function InactiveVendor()
    {
        $inactiveVendor = User::where('status', 'inactive')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.inactive_vendor', ['inactiveVendor' => $inactiveVendor]);
    }

    public function ActiveVendor()
    {
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.active_vendor', ['activeVendor' => $activeVendor]);
    }

    public function InactiveVendorDetails($id)
    {
        $inactiveVendorDetails = User::find($id);
        return view('backend.vendor.inactive_vendor_details', ['inactiveVendorDetails' => $inactiveVendorDetails]);
    }

    public function ActiveVendorDetails($id)
    {
        $activeVendorDetails = User::find($id);
        return view('backend.vendor.active_vendor_details', ['activeVendorDetails' => $activeVendorDetails]);
    }

    public function ActiveVendorApprove(Request $request)
    {
        $vendor_id = $request->id;

        User::findOrFail($vendor_id)->update([
            'status' => 'active',
        ]);

        $notification = [
            'message' => 'Vendor Active Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('active.vendor')->with($notification);
    }
    public function InactiveVendorApprove(Request $request)
    {
        $vendor_id = $request->id;

        User::findOrFail($vendor_id)->update([
            'status' => 'inactive',
        ]);

        $notification = [
            'message' => 'Vendor Inactive Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('inactive.vendor')->with($notification);

    }



}
