<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function UserDashboard()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('index', ['userData' => $userData]);
    }
    public function UserProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    public function UserDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'message' => 'User Logout Successfully',
            'alert-type' => 'success'
        ];
        return redirect('/login')->with($notification);

    }

    public function UserUpdateChangePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        // if (!Hash::check($request->old_password, Auth::user()->password)) {
        //     return back()->with("error", "Old Password Doesn't match!");
        // }

        // Check if the old password matches
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            // Prepare error notification
            $notification = [
                'message' => "Old Password doesn't match!",
                'alert-type' => 'error'
            ];
            // Redirect back with error notification
            return redirect()->back()->with($notification);
        }

        // Update The New Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = [
            'message' => 'Password Changed Successfully',
            'alert-type' => 'success'
        ];
        return back()->with($notification);

        // return back()->with("status", "Password Changed Successfully!");
    }
}
