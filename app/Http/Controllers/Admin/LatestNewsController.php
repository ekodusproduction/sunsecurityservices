<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LatestNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class LatestNewsController extends Controller
{
    //
    public function index()
    {
        $data['news'] = LatestNews::where('status', 1)->orderBy('updated_at', 'desc')->paginate(10);
        return view('admin.latest-news.index')->with($data);
    }

    public function addLatestNews(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'news_title' => 'required|max:500'
            ],
            [
                'news_title.required' => 'News title is a required field'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
        }

        $create = LatestNews::create([
            'title' => $request->news_title
        ]);

        if (!$create) {
            return response()->json(["message" => "Something went wrong!", "status" => 200]);
        }

        return response()->json(["message" => "News added successfully", "status" => 200]);
    }

    public function getLatestNewsDetails(Request $request)
    {
        $id = Crypt::decrypt($request->enc_id);
        $getDetails = LatestNews::find($id);
        if (!$getDetails) {
            return response()->json(['message' => 'Something went wrong!', 'status' => 422]);
        }
        return response()->json([
            'news_id' => Crypt::encrypt($getDetails->id),
            'news_title' => $getDetails->title,
            'status' => 200
        ]);
    }

    public function updateLatestNewsDetails(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'edit_news_title' => 'required|max:500'
            ],
            [
                'edit_news_title.required' => 'News title is a required field'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
        }

        $dec_id = Crypt::decrypt($request->edit_news_id);
        $update = LatestNews::find($dec_id)->update([
            'title' => $request->edit_news_title,
        ]);

        if (!$update) {
            return response()->json(['message' => 'Something went wrong!', 'status' => 422]);
        }
        return response()->json(['message' => 'News updated successfully', 'status' => 200]);
    }

    public function deleteLatestNews(Request $request)
    {
        $dec_id = Crypt::decrypt($request->news_id);
        $delete = LatestNews::find($dec_id)->delete();
        if (!$delete) {
            return response()->json(['message' => 'Something went wrong!', 'status' => 422]);
        }
        // If success delete
        return response()->json(['message' => 'News deleted successfully', 'status' => 200]);
    }
}
