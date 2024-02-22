<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    //
    public function index()
    {
        $data['testimonials'] = Testimonial::where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('admin.testimonial.index')->with($data);
    }

    public function addTestimonial(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'rating' => 'required',
                'message' => 'required',
                'attachment' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            ],
            [
                'name.required' => 'Name cannot be null',
                'name.max' => 'Name cannot contain more than 255 characters',
                'rating.required' => 'Please select one Rating value',
                'message.required' => 'Message cannot be null',
                'attachment.required' => 'Please upload an image',
                'attachment.image' => 'Upload only image',
                'attachment.mimes' => 'Accepts only jpg and png image',
                'attachment.max' => 'Max file size 1MB',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
        }

        $document = $request->attachment;
        if ($request->hasFile('attachment')) {
            $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();
            $document->move(public_path('uploads/testimonial/'), $new_name);
            $file = 'uploads/testimonial/' . $new_name;
        } else {
            return response()->json(["message" => "File not uploaded", "status" => 400]);
        }

        $create = Testimonial::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'message' => $request->message,
            'image' => $file
        ]);
        if (!$create) {
            return response()->json(["message" => "Something went wrong!", "status" => 200]);
        }
        return response()->json(["message" => "Testimonial added successfully", "status" => 200]);
    }

    public function deleteTestimonial(Request $request)
    {
        $dec_id = Crypt::decrypt($request->id);
        $get_data = Testimonial::find($dec_id);
        File::delete($get_data->image);
        $delete = $get_data->delete();
        if (!$delete) {
            return response()->json(['message' => 'Something went wrong!', 'status' => 422]);
        }
        // If success delete
        return response()->json(["message" => "Testimonial deleted successfully", "status" => 200]);
    }
}
