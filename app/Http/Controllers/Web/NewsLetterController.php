<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Newsletter;

class NewsLetterController extends Controller
{
    //
    public function index(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'emailNewsletter' => 'required|email',
            ],
            [
                'emailNewsletter.required' => 'Please provide an email',
                'emailNewsletter.email' => 'Please provide a valid email'
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
        }

        try {
            if (Newsletter::isSubscribed($request->emailNewsletter)) {
                return response()->json(["message" => "You are already subscribed", "status" => 200]);
            } else {
                Newsletter::subscribe($request->emailNewsletter);
                return response()->json(["message" => "You are successfully subscribed", "status" => 200]);
            }
        } catch (Exception $e) {
            return response()->json(["message" => "Something went wrong", "status" => 400]);
        }
    }
}
