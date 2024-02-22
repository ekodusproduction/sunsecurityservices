<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class CarouselController extends Controller
{
    //
    public function index()
    {
        $data['images'] = Carousel::where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('admin.carousel.index')->with($data);
    }

    public function addCarouselImage(Request $request)
    {
        $document = $request->attachment;
        if ($request->hasFile('attachment')) {
            $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();
            $document->move(public_path('uploads/carousel/'), $new_name);
            $file = 'uploads/carousel/' . $new_name;
        } else {
            return response()->json(["message" => "Something went wrong !", "status" => 400]);
        }

        $create = Carousel::create([
            'image' => $file
        ]);

        if ($create) {
            return response()->json(["message" => "Successfully Uploaded", "status" => 200]);
        } else {
            return response()->json(["message" => "Something went wrong !", "status" => 400]);
        }
    }

    public function updateCarouselImage(Request $request)
    {
        $decryptedId = Crypt::decrypt($request->id);
        $document = $request->attachment;
        if ($request->hasFile('attachment')) {
            $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();
            $document->move(public_path('uploads/carousel/'), $new_name);
            $file = 'uploads/carousel/' . $new_name;
        } else {
            return response()->json(["message" => "Something went wrong !", "status" => 400]);
        }

        // Delete the previous image file from storage
        $get_image = Carousel::find($decryptedId);
        $previous_delete = $get_image->image;
        File::delete($previous_delete);

        // Update the image
        $update = Carousel::find($decryptedId)->update(['image' => $file]);
        if ($update) {
            return response()->json(["message" => "Image updated successfully", "status" => 200]);
        } else {
            return response()->json(["message" => "Something went wrong !", "status" => 400]);
        }
    }

    public function deleteCarouselImage(Request $request){
        $decryptedId = Crypt::decrypt($request->id);
        $image = Carousel::find($decryptedId);
        $deleted = $image->delete();
        if($deleted){
            $image_to_delete = $image->image;
            File::delete($image_to_delete);
            return response()->json(["message" => "Image deleted successfully", "status" => 200]);            
        } else{
            return response()->json(["message" => "Something went wrong !", "status" => 400]);
        }
    }
}
