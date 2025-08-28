<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;
use App\Models\Product;
use App\Models\MetaTag;
use App\Models\NewsLetter;
use Illuminate\Support\Facades\Log;
use App\Mail\ContactUsAdminMail;
use App\Mail\ContactUsUserMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function create(){
        $metaTags = MetaTag::where('page', 'Contact us')->first();

        $meta_title = $metaTags->meta_title ?? '';
        $meta_description = $metaTags->meta_description ?? '';
        $meta_keywords = $metaTags->meta_keyword ?? '';
        $breadcrumbName = $metaTags->breadcrumb_name ?? '';
        $breadcrumbDescription = $metaTags->breadcrumb_description ?? '';
        $breadcrumbImage = $metaTags->breadcrumb_image ?? '';
        return view('contact_us', compact('meta_title', 'meta_description', 'meta_keywords', 'breadcrumbName', 'breadcrumbDescription', 'breadcrumbImage'));
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => ['required', 'regex:/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/'],
                'phone' => 'required|digits:10',
                'product_id' => 'required|exists:products,id',
                'country' => 'required|string',
                'subject' => 'required|string|max:255',
                'message' => 'required|string||max:255',
                'captcha' => 'required|captcha',
            ], [
                'captcha.captcha' => 'Invalid captcha. Please try again.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            ContactUs::create($request->all());

            $data = $request->only([
                'name', 'email', 'phone', 'product_id', 'country', 'subject', 'message'
            ]);
            $product = Product::find($request->product_id);

            $data['product_name'] = $product ? $product->product_name : 'N/A';

            Mail::to(env('MAIL_USERNAME'))->send(new ContactUsAdminMail($data));        
            Mail::to($data['email'])->send(new ContactUsUserMail($data));        

          //  Log::info('Contact form submitted and email sent successfully');

            return response()->json(['success' => 'Message sent successfully']);
        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function index()
    {
        $contacts = ContactUs::with('product')->get();
        return view('admin.contact-us_details', compact('contacts'));
    }

    public function add(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email_address' => 'required|email',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            NewsLetter::create($request->all());

            // Mail::to('neerajkaushik205@gmail.com')->send(new ContactUsMail($request->all()));

          //  Log::info('NewsLetter form submitted successfully');

            return response()->json(['success' => 'Message sent successfully']);
        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    public function newsLetterList(){
        $newsletters = NewsLetter::get()->all();
        return view('admin.news_letter', compact('newsletters'));
    }
}
