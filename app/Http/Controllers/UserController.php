<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'company_name' => 'required|string|max:255',
                'company_logo' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
                'company_footer_logo' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
                'company_video' => 'nullable|mimetypes:video/mp4,video/ogg,video/webm|max:51200',
                'mobile_company_video' => 'nullable|mimetypes:video/mp4,video/ogg,video/webm|max:51200',
                // 'email' => 'required|email',
                'contact_no1' => 'required|string|max:20',
                'contact_no2' => 'nullable|string|max:20',
                'address' => 'required|string|max:500',
                'facebook_link' => 'nullable|url',
                'twitter_link' => 'nullable|url',
                'youtube_link' => 'nullable|url',
                'linkedin_link' => 'nullable|url',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $user = Auth::user();

            if ($request->hasFile('company_logo')) {
                $logo = $request->file('company_logo');
                $logoName = time() . '.' . $logo->getClientOriginalExtension();

                // Save to: storage/app/public/company-logo
                $logo->storeAs('public/company-logo', $logoName);

                // Save path in DB as: company-logo/filename.jpg
                $user->company_logo = 'company-logo/' . $logoName;
            }
            
            if ($request->hasFile('company_footer_logo')) {
                $footer_logo = $request->file('company_footer_logo');
                $footerLogoName = time() . '.' . $footer_logo->getClientOriginalExtension();

                // Save to: storage/app/public/company-logo
                $footer_logo->storeAs('public/company-logo', $footerLogoName);

                // Save path in DB as: company-logo/filename.jpg
                $user->company_footer_logo = 'company-logo/' . $footerLogoName;
            }
            
            if ($request->hasFile('company_video')) {
                $video = $request->file('company_video');
            
                // Validate size manually in bytes (50MB = 52428800)
                if ($video->getSize() > 52428800) {
                    return response()->json(['errors' => ['company_video' => ['Video must not be greater than 50MB.']]], 422);
                }
            
                $videoName = time() . '.' . $video->getClientOriginalExtension();
                $video->storeAs('public/company-logo', $videoName);
               $user->company_video = 'company-logo/' . $videoName;
            }
            
            if ($request->hasFile('mobile_company_video')) {
                $mobileVideo = $request->file('mobile_company_video');
            
                // Validate size manually in bytes (50MB = 52428800)
                if ($mobileVideo->getSize() > 52428800) {
                    return response()->json(['errors' => ['mobile_company_video' => ['Video must not be greater than 50MB.']]], 422);
                }
            
                $mobileVideoName = time() . '.' . $mobileVideo->getClientOriginalExtension();
                $mobileVideo->storeAs('public/company-logo', $mobileVideoName);
               $user->mobile_company_video = 'company-logo/' . $mobileVideoName;
            }


            $user->name = $request->company_name;
            // $user->email = $request->email;
            $user->contact_no1 = $request->contact_no1;
            $user->contact_no2 = $request->contact_no2;
            $user->address = $request->address;
            $user->facebook_link = $request->facebook_link;
            $user->twitter_link = $request->twitter_link;
            $user->youtube_link = $request->youtube_link;
            $user->linkedin_link = $request->linkedin_link;

            $user->save();

            \Log::info('Company profile updated for user ID: ' . $user->id);

            return response()->json(['success' => 'Profile updated successfully']);
        } catch (\Exception $e) {
            \Log::error('Profile update failed: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
