<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $data['notification'] = Notification::where('status', 1)->orderBy('created_at', 'desc')->get();
        return view('admin.index')->with($data);
    }

    public function addNotification(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:255'
            ],
            [
                'title.required' => 'News title is a required field',
                'title.max' => 'Notification title not more than 255 characters'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
        }

        $create = Notification::create([
            'title' => $request->title
        ]);

        if (!$create) {
            return response()->json(["message" => "Something went wrong!", "status" => 200]);
        }
        return response()->json(["message" => "Notification added", "status" => 200]);
    }

    public function deleteNotification(Request $request)
    {
        $dec_id = Crypt::decrypt($request->notification_id);
        $delete = Notification::find($dec_id)->delete();
        if (!$delete) {
            return response()->json(['message' => 'Something went wrong!', 'status' => 422]);
        }
        // If success delete
        return response()->json(['message' => 'Notification deleted successfully', 'status' => 200]);
    }
}
