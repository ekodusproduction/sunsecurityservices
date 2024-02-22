<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class CareerController extends Controller
{
    //
    public function index()
    {
        $data['jobs'] = Career::orderBy('created_at', 'DESC')->get();
        return view('admin.career.index')->with($data);
    }

    public function addCareer(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.career.add');
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'jobTitle' => 'required|max:255',
                    'location' => 'required|max:255',
                    'totalPost' => 'required|integer',
                    'jobDescription' => 'required',
                ],
                [
                    'jobTitle.required' => 'Job title cannot be null',
                    'jobTitle.max' => 'Job title cannot exceed 255 characters',
                    'location.required' => 'Location cannot be null',
                    'location.max' => 'Location cannot exceed 255 characters',
                    'totalPost.required' => 'No of vacancy cannot be null',
                    'totalPost.integer' => 'No of vacancy only number',
                    'jobDescription.required' => 'Job description cannot be null'
                ]
            );

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
            }

            $create = Career::create([
                'title' => $request->jobTitle,
                'location' => $request->location,
                'no_of_post' => $request->totalPost,
                'no_of_post' => $request->totalPost,
                'description' => $request->jobDescription,
            ]);
            if (!$create) {
                return response()->json(["message" => "Something went wrong!", "status" => 400]);
            }
            return response()->json(["message" => "Job posted successfully", "status" => 200]);
        }
    }

    public function editCareer(Request $request, $id)
    {
        $dec_id = Crypt::decrypt($id);

        if ($request->isMethod('get')) {
            $data['job'] = Career::find($dec_id);
            return view('admin.career.edit')->with($data);
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    'jobTitle' => 'required|max:255',
                    'location' => 'required|max:255',
                    'totalPost' => 'required|integer',
                    'jobDescription' => 'required',
                ],
                [
                    'jobTitle.required' => 'Job title cannot be null',
                    'jobTitle.max' => 'Job title cannot exceed 255 characters',
                    'location.required' => 'Location cannot be null',
                    'location.max' => 'Location cannot exceed 255 characters',
                    'totalPost.required' => 'No of vacancy cannot be null',
                    'totalPost.integer' => 'No of vacancy only number',
                    'jobDescription.required' => 'Job description cannot be null'
                ]
            );

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
            }

            $update = Career::find($dec_id)->update([
                'title' => $request->jobTitle,
                'location' => $request->location,
                'no_of_post' => $request->totalPost,
                'no_of_post' => $request->totalPost,
                'description' => $request->jobDescription,
            ]);
            if (!$update) {
                return response()->json(["message" => "Something went wrong!", "status" => 400]);
            }
            return response()->json(["message" => "Job updated successfully", "status" => 200]);
        }
    }

    public function deleteCareer(Request $request)
    {
        $dec_id = Crypt::decrypt($request->id);
        $job = Career::find($dec_id);
        $delete = $job->delete();
        if (!$delete) {
            return response()->json(["message" => "Something went wrong !", "status" => 400]);
        }
        return response()->json(["message" => "Job deleted successfully", "status" => 200]);
    }

    public function changeStatus(Request $request)
    {
        $dec_id = Crypt::decrypt($request->job_id);
        $job = Career::find($dec_id);
        $job->status = $request->active;
        $job->save();
        return response()->json(['message' => 'Success', 'status' => 200]);
    }
}
