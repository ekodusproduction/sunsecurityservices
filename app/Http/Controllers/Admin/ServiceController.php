<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    //
    public function index()
    {
        $data['services'] = Services::get();
        return view('admin.services.index')->with($data);
    }

    public function uploadImage(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'service_id' => 'required'
            ],
            [
                'service_id.required' => 'ID cannot be null'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
        }

        $dec_id = Crypt::decrypt($request->service_id);

        $document = $request->attachment;
        if ($request->hasFile('attachment')) {
            $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();
            $document->move(public_path('uploads/services/'), $new_name);
            $file = 'uploads/services/' . $new_name;
        } else {
            return response()->json(["message" => "Image not found", "status" => 422]);
        }

        $update = Services::find($dec_id)->update([
            'image' => $file
        ]);

        if (!$update) {
            return response()->json(["message" => "Something went wrong!", "status" => 200]);
        }
        return response()->json(["message" => "Image updated successfully", "status" => 200]);
    }
}
