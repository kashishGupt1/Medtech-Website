<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AboutUsController extends Controller
{
    public function create(){
        return view('admin.about_us');
    }
    
    public function index()
    {
        $about = AboutUs::first();
    
        if (!$about) {
            
            $about = (object) [
                'breadcrumb_name' => '',
                'breadcrumb_description' => '',
                'title' => '',
                'we_description' => '',
                'main_image' => '',
                'v_title' => '',
                'v_description' => '',
                'm_title' => '',
                'm_description' => '',
                'why_choose_title' => '',
                'why_choose_description' => '',
                'why_choose' => []
            ];
        }
    
        return view('about_us', compact('about'));
    }
    
    public function edit()
    {
        $about = AboutUs::first(); 
        return view('admin.about_us', compact('about'));
    }

    // public function store(Request $request)
    // {
    //     try {
           
    //         $validator = Validator::make($request->all(), [
    //             'title' => 'required|string|max:255',
    //             'we_description' => 'required|string',
    //             'main_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    
    //             'v_title' => 'required|string|max:255',
    //             'v_description' => 'required|string',
    //             'm_title' => 'required|string|max:255',
    //             'm_description' => 'required|string',
    
    //             'breadcrumb_name' => 'required|string|max:255',
    //             'breadcrumb_description' => 'nullable|string',
    //             'breadcrumb_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    
    //             'meta_keyword' => 'nullable|string|max:255',
    //             'meta_title' => 'nullable|string|max:255',
    //             'meta_description' => 'nullable|string',
    //             'why_choose_title' => 'required|string|max:255',
    //             'why_choose_description' => 'required|string',
    
    //             'why_choose' => 'required|array|min:1',
    //             'why_choose.*.title' => 'required|string|max:255',
    //             'why_choose.*.description' => 'required|string',
    //         ]);
    
    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'errors' => $validator->errors()
    //             ], 422);
    //         }
    
           
    //         $data = $request->except(['_token', 'main_image', 'breadcrumb_photo', 'why_choose']);
    
    //         if ($request->hasFile('main_image')) {
    //             $data['main_image'] = $request->file('main_image')->store('about', 'public');
    //         }
    
    //         if ($request->hasFile('breadcrumb_photo')) {
    //             $data['breadcrumb_photo'] = $request->file('breadcrumb_photo')->store('about', 'public');
    //         }
    
           
    //         $whyChooseRaw = $request->input('why_choose', []);
    //         $whyChooseClean = [];
    
    //         foreach ($whyChooseRaw as $item) {
    //             $whyChooseClean[] = [
    //                 'title' => $item['title'],
    //                 'description' => $item['description'],
    //             ];
    //         }
    
    //         $data['why_choose'] = $whyChooseClean;
    
            
    //         $about = AboutUs::first();
    //         if ($about) {
    //             $about->update($data);
    //         } else {
    //             AboutUs::create($data);
    //         }
    
    //         return response()->json(['message' => 'About Us updated successfully.']);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Something went wrong!',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }
    
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'we_description' => 'required|string',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    
                'v_title' => 'required|string|max:255',
                'v_description' => 'required|string',
                'm_title' => 'required|string|max:255',
                'm_description' => 'required|string',
    
                'breadcrumb_name' => 'required|string|max:255',
                'breadcrumb_description' => 'nullable|string',
                'breadcrumb_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    
                'meta_keyword' => 'nullable|string|max:255',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'why_choose_title' => 'required|string|max:255',
                'why_choose_description' => 'nullable|string',
    
                'why_choose' => 'required|array|min:1',
                'why_choose.*.title' => 'required|string|max:255',
                'why_choose.*.description' => 'nullable|string',
                'why_choose.*.image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
    
            $data = $request->except(['_token', 'main_image', 'breadcrumb_photo', 'why_choose']);
    
            if ($request->hasFile('main_image')) {
                $data['main_image'] = $request->file('main_image')->store('about', 'public');
            }
    
            if ($request->hasFile('breadcrumb_photo')) {
                $data['breadcrumb_photo'] = $request->file('breadcrumb_photo')->store('about', 'public');
            }
    
            $whyChooseRaw = $request->input('why_choose', []);
            $whyChooseClean = [];
    
            foreach ($whyChooseRaw as $index => $item) {
                $imagePath = null;
                if ($request->hasFile("why_choose.$index.image")) {
                    $imagePath = $request->file("why_choose.$index.image")->store('about', 'public');
                }
    
                $whyChooseClean[] = [
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'image' => $imagePath,
                ];
            }
    
            $data['why_choose'] = $whyChooseClean;
    
            $about = AboutUs::first();
            if ($about) {
                $about->update($data);
            } else {
                AboutUs::create($data);
            }
    
            return response()->json(['message' => 'About Us updated successfully.']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong!',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // public function update(Request $request, $id)
    // {
    //     try {
            
    //         $validator = Validator::make($request->all(), [
    //             'title' => 'required|string|max:255',
    //             'we_description' => 'required|string',
    //             'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    
    //             'v_title' => 'required|string|max:255',
    //             'v_description' => 'required|string',
    //             'm_title' => 'required|string|max:255',
    //             'm_description' => 'required|string',
    
    //             'breadcrumb_name' => 'required|string|max:255',
    //             'breadcrumb_description' => 'nullable|string',
    //             'breadcrumb_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    //             'why_choose_title' => 'required|string|max:255',
    //             'why_choose_description' => 'required|string',
    
    //             'meta_keyword' => 'nullable|string|max:255',
    //             'meta_title' => 'nullable|string|max:255',
    //             'meta_description' => 'nullable|string',
    
    //             'why_choose' => 'required|array|min:1',
    //             'why_choose.*.title' => 'required|string|max:255',
    //             'why_choose.*.description' => 'required|string',
    //         ]);
    
    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'errors' => $validator->errors()
    //             ], 422);
    //         }
    
            
    //         $about = AboutUs::findOrFail($id);
    
            
    //         $data = $request->except(['_token', 'main_image', 'breadcrumb_photo', 'why_choose']);
    
    //         if ($request->hasFile('main_image')) {
    //             $data['main_image'] = $request->file('main_image')->store('about', 'public');
    //         }
    
    //         if ($request->hasFile('breadcrumb_photo')) {
    //             $data['breadcrumb_photo'] = $request->file('breadcrumb_photo')->store('about', 'public');
    //         }
    
           
    //         $whyChooseClean = [];
    //         foreach ($request->input('why_choose', []) as $item) {
    //             $whyChooseClean[] = [
    //                 'title' => $item['title'],
    //                 'description' => $item['description'],
    //             ];
    //         }
    
    //         $data['why_choose'] = $whyChooseClean;
    
            
    //         $about->update($data);
    
    //         return response()->json(['message' => 'About Us updated successfully.']);
    
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Something went wrong.',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'we_description' => 'required|string',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    
                'v_title' => 'required|string|max:255',
                'v_description' => 'required|string',
                'm_title' => 'required|string|max:255',
                'm_description' => 'required|string',
    
                'breadcrumb_name' => 'required|string|max:255',
                'breadcrumb_description' => 'nullable|string',
                'breadcrumb_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    
                'why_choose_title' => 'required|string|max:255',
                'why_choose_description' => 'nullable|string',
    
                'meta_keyword' => 'nullable|string|max:255',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
    
                'why_choose' => 'required|array|min:1',
                'why_choose.*.title' => 'required|string|max:255',
                'why_choose.*.description' => 'nullable|string',
                'why_choose.*.image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
    
            $about = AboutUs::findOrFail($id);
    
            $data = $request->except(['_token', 'main_image', 'breadcrumb_photo', 'why_choose']);
    
            
            if ($request->hasFile('main_image')) {
                $data['main_image'] = $request->file('main_image')->store('about', 'public');
            }
    
            
            if ($request->hasFile('breadcrumb_photo')) {
                $data['breadcrumb_photo'] = $request->file('breadcrumb_photo')->store('about', 'public');
            }
    
           
            $whyChooseRaw = $request->input('why_choose', []);
            $whyChooseClean = [];
    
            foreach ($whyChooseRaw as $index => $item) {
                $imagePath = null;
    
                if ($request->hasFile("why_choose.$index.image")) {
                    $imagePath = $request->file("why_choose.$index.image")->store('about', 'public');
                }
    
                $whyChooseClean[] = [
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'image' => $imagePath ?? ($about->why_choose[$index]['image'] ?? null)
                ];
            }
    
            $data['why_choose'] = $whyChooseClean;
    
            $about->update($data);
    
            return response()->json(['message' => 'About Us updated successfully.']);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



}
