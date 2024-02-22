<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.auth.login');
        } else {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('admin.index');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'password' => 'required|min:5|same:cpassword',
                'cpassword' => 'required',
            ],
            [
                'password.required' => 'Password cannot be null',
                'password.min' => 'Please enter minimum 5 characters for password',
                'password.same' => 'Password not match',
                'cpassword.required' => 'Confirm password cannot be null',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
        }

        $id = Auth::id();
        $update = User::find($id)->update([
            'password' => Hash::make($request->password)
        ]);
        if (!$update) {
            return response()->json(['message' => 'Password updated failed', 'status' => 200]);
        }
        return response()->json(['message' => 'Password updated', 'status' => 200]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
