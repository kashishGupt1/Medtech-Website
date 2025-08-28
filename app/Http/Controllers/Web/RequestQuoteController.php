<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestQuote;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Mail\RequestQuoteUserMail;
use App\Mail\RequestQuoteAdminMail;
use Illuminate\Support\Facades\Mail;
use Validator;

class RequestQuoteController extends Controller
{
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:3'],
        'company_name' => ['required', 'string'],
        'email' => ['required', 'regex:/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/'],
        'phone' => ['required', 'digits:10'],
        'country' => ['required', 'string'],
        'designation' => ['required', 'string'],
        'role' => ['required', 'string'],
        'message' => ['required', 'string', 'min:5', 'max:255'],
        'product_name' => ['required', 'string'],
        'captcha' => 'required|captcha',
    ], [
        'name.regex' => 'The name may only contain letters and spaces.',
        'phone.digits_between' => 'The phone number must be exactly 10 digits.',
        'captcha.required' => 'Captcha is required.',
        'captcha.captcha' => 'Invalid captcha. Please try again.',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $quote = RequestQuote::create($request->all());
    Mail::to($quote->email)->send(new RequestQuoteUserMail($quote));
    Mail::to(env('MAIL_USERNAME'))->send(new RequestQuoteAdminMail($quote));

    return response()->json(['success' => 'Request submitted successfully!']);
}


public function create(){
    $categories = ProductCategory::all();
    $products = Product::all();
    $requested_quotes = RequestQuote::with(['product.category'])
    ->whereNotNull('product_name')
    ->whereNull('exhibition')
    ->get();
    return view('admin.request_quote', compact('requested_quotes', 'categories','products'));
}


public function exhibitionAppointmentstore(Request $request)
{
    $validator = Validator::make($request->all(), [
        'exhibition' => ['required', 'string'],
        'name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:3'],        
        'email' => ['required', 'regex:/^[\w\.-]+@[\w\.-]+\.[a-zA-Z]{2,}$/'],
        'phone' => ['required', 'regex:/^[0-9]{10}$/'],
        'country' => ['required', 'string'],        
        'role' => ['required', 'string'],
        'subject' => ['required', 'string'],
        'message' => ['required', 'string', 'min:5', 'max:255'],        
        'captcha' => 'required|captcha',
    ], [
        'name.regex' => 'The name may only contain letters and spaces.',
        'phone.regex' => 'The phone number must be exactly 10 digits.',
        'captcha.required' => 'Captcha is required.',
        'captcha.captcha' => 'Invalid captcha. Please try again.',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $quote = RequestQuote::create($request->all());
  //  Mail::to($quote->email)->send(new RequestQuoteUserMail($quote));
 //   Mail::to(env('MAIL_USERNAME'))->send(new RequestQuoteAdminMail($quote));

    return response()->json(['success' => 'Request submitted successfully!']);
}

public function getExhibitionAppointments()
{
        $categories = ProductCategory::all();
    $products = Product::all();
    $exhibitions = RequestQuote::whereNotNull('exhibition')->get();

    return view('admin.exhibition_booking_appointment', compact('exhibitions', 'categories','products'));
}


}
