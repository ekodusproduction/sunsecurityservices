<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    //
    public function index()
    {
        $data['blogs'] = Blog::where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);
        return view('admin.blog.index')->with($data);
    }

    public function addBlog(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.blog.create');
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'blogTitle' => 'required|max:255',
                    'blogImage' => 'required|image|mimes:jpeg,png,jpg|max:1024',
                    'blogDescription' => 'required',
                ],
                [
                    'blogTitle.required' => 'Blog title is a required field',
                    'blogDescription.required' => 'Blog description is a required field',
                    'blogImage.required' => 'Please upload an image',
                    'blogImage.image' => 'Upload only image',
                    'blogImage.mimes' => 'Accepts only jpg and png image',
                    'blogImage.max' => 'Max file size 1MB',
                ]
            );

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
            }

            $document = $request->blogImage;
            if ($request->hasFile('blogImage')) {
                $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();
                $document->move(public_path('uploads/blog/'), $new_name);
                $file = 'uploads/blog/' . $new_name;
            } else {
                return response()->json(["message" => "Something went wrong !", "status" => 400]);
            }

            $create = Blog::create([
                'title' => $request->blogTitle,
                'image' => $file,
                'description' => $request->blogDescription,
            ]);

            if (!$create) {
                return response()->json(["message" => "Something went wrong!", "status" => 400]);
            }
            return response()->json(["message" => "Blog added successfully", "status" => 200]);
        }
    }

    public function editBlog(Request $request, $id)
    {
        if ($request->isMethod('get')) {
            $data['blog'] = Blog::find(Crypt::decrypt($id));
            return view('admin.blog.edit')->with($data);
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'blogTitle' => 'required|max:255',
                    'blogDescription' => 'required',
                ],
                [
                    'blogTitle.required' => 'Blog title is a required field',
                    'blogDescription.required' => 'Blog description is a required field',
                ]
            );

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
            }

            $dec_id = Crypt::decrypt($request->blogId);

            $update = Blog::find($dec_id)->update([
                'title' => $request->blogTitle,
                'description' => $request->blogDescription,
            ]);

            if (!$update) {
                return response()->json(["message" => "Something went wrong!", "status" => 400]);
            }
            return response()->json(["message" => "Blog updated successfully", "status" => 200]);
        }
    }

    public function updateImage(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'blogImage' => 'required|image|mimes:jpeg,png,jpg|max:1024',
            ],
            [
                'blogImage.required' => 'Please upload an image',
                'blogImage.image' => 'Upload only image',
                'blogImage.mimes' => 'Accepts only jpg and png image',
                'blogImage.max' => 'Max file size 1MB',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
        }

        $dec_id = Crypt::decrypt($request->blogId);

        $document = $request->blogImage;
        if ($request->hasFile('blogImage')) {
            $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();
            $document->move(public_path('uploads/blog/'), $new_name);
            $file = 'uploads/blog/' . $new_name;

            // Get the previous image
            $blog = Blog::find($dec_id);
            $image_to_delete = $blog->image;
            File::delete($image_to_delete);
        } else {
            return response()->json(["message" => "Something went wrong !", "status" => 400]);
        }

        $create = Blog::find($dec_id)->update([
            'image' => $file,
        ]);

        if (!$create) {
            return response()->json(["message" => "Something went wrong!", "status" => 400]);
        }
        return response()->json(["message" => "Blog image updated successfully", "status" => 200]);
    }

    public function deleteBlog(Request $request)
    {
        $dec_id = Crypt::decrypt($request->id);
        $blog = Blog::find($dec_id);
        $delete = $blog->delete();
        if (!$delete) {
            return response()->json(["message" => "Something went wrong !", "status" => 400]);
        }
        $image_to_delete = $blog->image;
        File::delete($image_to_delete);
        return response()->json(["message" => "Blog deleted successfully", "status" => 200]);
    }
}
