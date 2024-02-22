<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    //
    public function index()
    {
        $data['images'] = Gallery::where('status', 1)->orderBy('created_at', 'DESC')->paginate(20);
        return view('admin.gallery.index')->with($data);
    }

    public function addGalleryImage(Request $request)
    {
        $document = $request->attachment;
        if ($request->hasFile('attachment')) {
            $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();
            $document->move(public_path('uploads/gallery/'), $new_name);
            $file = 'uploads/gallery/' . $new_name;
        } else {
            return response()->json(["message" => "Something went wrong !", "status" => 400]);
        }

        $create = Gallery::create([
            'image' => $file
        ]);

        if ($create) {
            return response()->json(["message" => "Image uploaded successfully", "status" => 200]);
        } else {
            return response()->json(["message" => "Something went wrong !", "status" => 400]);
        }
    }

    public function deleteGalleryImage(Request $request)
    {
        $decryptedId = Crypt::decrypt($request->id);
        $image = Gallery::find($decryptedId);
        if ($image) {
            $deleted = $image->delete();
            if ($deleted) {
                $image_to_delete = $image->image;
                File::delete($image_to_delete);
                return response()->json(["message" => "Successfully Deleted", "status" => 200]);
            } else {
                return response()->json(["message" => "Something went wrong !", "status" => 400]);
            }
        } else {
            return response()->json(["message" => "Something went wrong !", "status" => 400]);
        }
    }
}
