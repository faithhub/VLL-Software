<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\FAQ;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{

    public function index()
    {
        $data['title'] = "Home";
        $data['banner'] = true;
        $data['materials'] = Material::with(['type', 'cover', 'folder:name'])->where('status', 'active')->inRandomOrder()->limit(6)->get();
        return View('web.index', $data);
    }

    public function privacy()
    {
        # code...
        $data['title'] = "Privacy Policy";
        return View('web.privacy', $data);
    }

    public function about_us()
    {
        # code...
        $data['title'] = "About Us";
        return View('web.about-us', $data);
    }

    public function faq()
    {
        # code...
        $data['title'] = "FAQ";
        $data['sec'] = 2;
        $data['faqs'] = FAQ::orderBy('created_at', 'DESC')->get();
        return View('web.faq', $data);
    }

    public function contact(Request $request)
    {
        # code...
        $data['title'] = "Contact Us";

        if ($request->isMethod('post')) {  // Use of isMethod to check if it is a POST request

            $rules = [
                'name' => ['required', 'string', 'max:50'],
                'email' => ['required', 'email', 'string'],
                'subject' => ['required', 'string', 'max:80'],
                'message' => ['required', 'string'],
            ];

            $messages = [];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                Session::flash('warning', __('All fields are required'));
                return back()->withErrors($validator)->withInput();;
            }

            // dd($request->all());

            $object = new \stdClass();
            $object->name = $request->name;
            $object->email = $request->email;
            $object->message = $request->message;
            $object->subject = $request->subject;

            Mail::to($request->email)->send(new Contact($object));
            Session::flash('success', __('Your message was sent, thank you!'));
            return redirect()->back();
        }
        return View('web.contact-us', $data);
    }
}