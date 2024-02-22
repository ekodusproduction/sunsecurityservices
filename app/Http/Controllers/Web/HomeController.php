<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Mail\JobApplyMail;
use App\Models\Blog;
use App\Models\Career;
use App\Models\Carousel;
use App\Models\Gallery;
use App\Models\LatestNews;
use App\Models\Notification;
use App\Models\Services;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //
    public function index()
    {
        $data['carousel'] = Carousel::where('status', 1)->orderBy('created_at', 'DESC')->get();
        $data['news'] = LatestNews::where('status', 1)->orderBy('updated_at', 'DESC')->take(5)->get();
        $data['notification'] = Notification::where('status', 1)->orderBy('created_at', 'DESC')->first();
        $data['blogs'] = Blog::where('status', 1)->orderBy('created_at', 'DESC')->take(5)->get();
        $data['testimonials'] = Testimonial::where('status', 1)->orderBy('created_at', 'DESC')->take(5)->get();
        return view('web.index')->with($data);
    }

    public function aboutUs()
    {
        return view('web.about.index');
    }

    public function services()
    {
        $data['commercial_security_service'] = Services::find(1);
        $data['residence_security_service'] = Services::find(2);
        $data['hotels_and_malls_security_service'] = Services::find(3);
        $data['gunman'] = Services::find(4);
        return view('web.services.index')->with($data);
    }

    public function securityTips()
    {
        return view('web.tips.index');
    }

    public function gallery()
    {
        $data['images'] = Gallery::where('status', 1)->orderBy('created_at', 'DESC')->paginate(20);
        return view('web.gallery.index')->with($data);
    }

    public function career($id = null)
    {
        if (!$id) {
            $data['jobs'] = Career::where('status', 1)->orderBy('created_at', 'DESC')->get();
            return view('web.career.index')->with($data);
        } else {
            $dec_id = Crypt::decrypt($id);
            $data['job'] = Career::find($dec_id);
            return view('web.career.careerDetails')->with($data);
        }
    }

    public function applyJob(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'email' => 'required|email',
                'phone' => 'required|integer',
                'dob' => 'required',
                'attachment' => 'required|mimes:pdf|max:1024',
                'address' => 'required|max:255',
            ],
            [
                'name.required' => 'Name cannot be null',
                'name.max' => 'Name cannot exceed 255 characters',
                'phone.required' => 'Phone number cannot be null',
                'phone.max' => 'Phone number only accepts number',
                'dob.required' => 'DOB cannot be null',
                'attachment.required' => 'Please upload Resume',
                'attachment.mimes' => 'Please upload only pdf file',
                'attachment.max' => 'Resume size not more than 1MB',
                'address.required' => 'Address cannot be null',
                'address.max' => 'Address cannot exceed 255 characters',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
        }

        $path = public_path('uploads/career');
        $cv = $request->file('attachment');

        $cv_name = time() . '.' . $cv->getClientOriginalExtension();

        // create folder
        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $cv->move($path, $cv_name);

        $filename = $path . '/' . $cv_name;

        $details = [
            'jobTitle' => $request->jobTitle,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'attachment' => $filename,
            'address' => $request->address,
        ];
        Mail::to(env('MAIL_TO'))->send(new JobApplyMail($details));

        if (Mail::failures()) {
            return response()->json(["message" => "Something went wrong !", "status" => 400]);
        }
        return response()->json(["message" => "Job applied successfully", "status" => 200]);
    }

    public function jobApplyForm($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data['job'] = Career::find($dec_id);
        return view('web.career.applyForm')->with($data);
    }

    public function jobApplyFormSubmit(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'post_title' => 'required|max:255',
                'name' => 'required|max:255',
                'father_name' => 'required|max:255',
                'mother_name' => 'required|max:255',
                'email' => 'required|email',
                'phone' => 'required|integer|digits:10',
                'dob' => 'required',
                'education_type' => 'required',
                'education' => 'required|max:255',
                'experience_field' => 'required',
                'experience' => 'required|max:255',
                'marital_status' => 'required',
                'attachment' => 'mimes:pdf|max:1024',
                'address' => 'required|max:255',
                'pin' => 'required|integer|digits:6',
            ],
            [
                'post_title.required' => 'Post title can not be null',
                'post_title.max' => 'Post title can not exceed 255 characters',

                'name.required' => 'Name cannot be null',
                'name.max' => 'Name can not exceed 255 characters',

                'father_name.required' => 'Father name cannot be null',
                'father_name.max' => 'Father name can not exceed 255 characters',

                'mother_name.required' => 'Mother name cannot be null',
                'mother_name.max' => 'Mother name can not exceed 255 characters',

                'email.required' => 'Email can not be null',
                'email.max' => 'Email only accepts number',

                'phone.required' => 'Phone number cannot be null',
                'phone.digits' => 'Phone number must be 10 digits',

                'dob.required' => 'DOB cannot be null',

                'education_type.required' => 'Select education',
                'education.required' => 'Education can not be null',
                'education.max' => 'Education can not exceed 255 characters',


                'experience_field.required' => 'Select experience',
                'experience.required' => 'Experience can not be null',
                'experience.max' => 'Experience can not exceed 255 characters',

                'marital_status.required' => 'Select marital status',

                'attachment.mimes' => 'Please upload only pdf file',
                'attachment.max' => 'Resume size not more than 1MB',

                'address.required' => 'Address cannot be null',
                'address.max' => 'Address cannot exceed 255 characters',

                'pin.required' => 'PIN code cannot be null',
                'pin.integer' => 'PIN code accepts only number',
                'pin.digits' => 'PIN code must be 6 digits',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'status' => 422]);
        }

        $filename = '';
        if ($request->hasFile('attachment')) {
            $path = public_path('uploads/career');
            $cv = $request->file('attachment');
            $cv_name = time() . '.' . $cv->getClientOriginalExtension();

            // create folder
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $cv->move($path, $cv_name);
            $filename = $path . '/' . $cv_name;
        }

        $details = [
            'post_title' => $request->post_title,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'education_qualification' => $request->education_type . "- " . $request->education,
            'work_experience' => $request->experience_field . "- " . $request->experience,
            'marital_status' => $request->marital_status,
            'attachment' => $filename,
            'address' => $request->address,
            'pin' => $request->pin,
        ];
        Mail::to(env('MAIL_TO'))->send(new JobApplyMail($details));

        if (Mail::failures()) {
            return response()->json(["message" => "Something went wrong !", "status" => 400]);
        }
        return response()->json(["message" => "Job applied successfully", "status" => 200]);
    }

    public function blog(Request $request, $id = null)
    {
        if (!$id) {
            $data['blogs'] = Blog::where('status', 1)->orderBy('created_at', 'DESC')->get();
            return view('web.blog.index')->with($data);
        } else {
            $dec_id = Crypt::decrypt($id);
            $data['blog'] = Blog::find($dec_id);
            return view('web.blog.read_blog')->with($data);
        }
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('web.contact.index');
        } else {
            $details = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            ];

            Mail::to(env('MAIL_TO'))->send(new ContactMail($details));

            if (Mail::failures()) {
                return response()->json(["message" => "Something went wrong !", "status" => 400]);
            }
            return response()->json(['message' => 'Contact form submitted', 'status' => 200]);
        }
    }
}
