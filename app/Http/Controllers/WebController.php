<?php

namespace App\Http\Controllers;

use App\Models\Careers;
use App\Models\ContactUs;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function createEnquiry(Request $request)
    {

        $data = $request->all();
        $this->validate($request, [
            'name' => "required",
            'email' => "required|email",
            'type' => "required",
            'description' => "required"
        ], [
            'name' => "required",
            'email' => "required",
            'type' => "required",
            'description' => "required"
        ]);
        $data['ip'] = $request->getClientIp();
        $create_enquiry = Enquiry::create($data);

        if (!$create_enquiry) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        $subject = 'Ezdat technology : Enquiry : ' . $data['type'] . ' - ' . date("Y-m-d");
        $to = env('MAIL_FROM_ADDRESS');
        $mail_data = ['mail_data' => $create_enquiry->fresh()];

        $send_mail = self::sendMail('mail_templates/enquiry', $mail_data, $to, $subject);
        return redirect()->back()->with('success', 'Your Enquiry Submitted');
    }

    public function contactUs(Request $request)
    {

        $data = $request->all();
        // dd($data);
        $this->validate($request, [
            'name' => "required",
            'email' => "required|email",
            'phone' => "required",
            'subject' => "required",
            'message' => "required"
        ], [
            'name' => "required",
            'email' => "required",
            'phone' => "required",
            'subject' => "required",
            'message' => "required"
        ]);
        $contact_us = ContactUs::create($data);

        if (!$contact_us) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        $subject = 'Ezdat technology : Contact Us : ' . $data['subject'] . ' - ' . date("Y-m-d");
        $to = env('MAIL_FROM_ADDRESS');
        $mail_data = ['mail_data' => $contact_us->fresh()];

        $send_mail = self::sendMail('mail_templates/contact_us', $mail_data, $to, $subject);
        return redirect()->back()->with('success', 'Submitted Successfully');
    }

    public function career(Request $request)
    {
        $data = $request->all();
        $this->validate($request, [
            'name' => "required",
            'email' => "required|email",
            'phone' => "required",
            'highest_qualification' => "required",
            'board_university' => "required",
            'year_of_experience' => "required",
            'position' => "required",
            'current_ctc' => "required",
            'expected_ctc' => "required",
            'resume' => "required",
        ], [
            'name' => "required",
            'email' => "required",
            'phone' => "required",
            'highest_qualification' => "required",
            'board_university' => "required",
            'year_of_experience' => "required",
            'position' => "required",
            'current_ctc' => "required",
            'expected_ctc' => "required",
            'resume' => "required",
        ]);

        $data['resume'] = self::uploadFile(config('constants.resume'), $data['resume']);
        $data['job_type'] = ucfirst(str_replace("-", " ", explode('/', $request->headers->get('referer'))[3]));

        $create_career = Careers::create($data);

        if (!$create_career) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        $subject = 'Ezdat technology : Apply Job : ' . $data['name'] . ' - ' . $data['job_type'] . ' - ' . date("Y-m-d");
        $to = env('MAIL_FROM_ADDRESS');
        $mail_data = ['mail_data' => $create_career->fresh()];

        $send_mail = self::sendMail('mail_templates/job_apply', $mail_data, $to, $subject);
        return redirect()->back()->with('success', 'Successfully applied');
    }


    public static function uploadFile($file_path, $image)
    {
        $file_name = time() . rand(11111, 99999) . "." . $image->getClientOriginalExtension();
        // dump($file_path, file_get_contents($image));
        $p = \Storage::disk('local')->put($file_path . $file_name, file_get_contents($image), 'public');
        return $file_name;
    }


    public static function getFile($file_path, $image)
    {

        $p = url('/') . \Storage::disk('local')->url($file_path . $image);
        return $p;
    }


    public static function sendMail($template_name, $data, $to = [], $subject,  $cc = [], $files = [])
    {
        $from_mail = env('MAIL_FROM_ADDRESS');
        $from_name = 'Ezdat Technology';

        \Mail::send($template_name, $data, function ($message) use ($from_mail, $from_name, $subject, $to, $files, $cc) {
            $message->from($from_mail, $from_name);
            $message->to($to);
            // $message->to($from_mail);
            if (count($files) > 0) {
                foreach ($files as $file) {
                    $message->attach($file);
                }
            }
            if (count($cc) != 0) {
                $message->cc($cc);
            }
            $message->subject($subject);
        });
        // Mail::to('nimukanjariya@ezdatechnology.com')->send(new TestAmazonSes('It works!'));
        return true;
    }
}
