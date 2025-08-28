<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exhibition;
use App\Models\MetaTag;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ExhibitionController extends Controller
{

    public function create()
    {
        return view('admin.exhibition-add', ['exhibition' => null]);
    }



    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'slug' => 'required|string|max:255|alpha_dash|unique:exhibitions,slug',
                'exhibition_name' => 'required|string',
                'exhibition_date' => 'required|date',
                'exhibition_location' => 'required|string',
                'exhibition_description' => 'nullable|string',
                'exhibition_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'exhibition_images' => 'nullable|array',
                'exhibition_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'breadcrumb_name' => 'required|string',
                'breadcrumb_description' => 'nullable|string',
                'breadcrumb_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'meta_keyword' => 'nullable|string',
                'meta_title' => 'nullable|string',
                'meta_description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $slug = Str::slug($request->input('slug'));

            // Handle single file upload: exhibition_photo
            $exhibitionPhotoPath = null;
            if ($request->hasFile('exhibition_photo')) {
                $exhibitionPhotoPath = $request->file('exhibition_photo')->store('exhibition', 'public');
            }

            // Handle multiple images: exhibition_images[]
            $images = [];
            if ($request->hasFile('exhibition_images')) {
                foreach ($request->file('exhibition_images') as $img) {
                    $stored = $img->store('exhibition', 'public');
                    $images[] = $stored;
                }
            }

            // Handle breadcrumb photo
            $breadcrumbPhotoPath = null;
            if ($request->hasFile('breadcrumb_photo')) {
                $breadcrumbPhotoPath = $request->file('breadcrumb_photo')->store('exhibition', 'public');
            }


            Exhibition::create([
                'slug' => $slug,
                'exhibition_name' => $request->exhibition_name,
                'exhibition_date' => $request->exhibition_date,
                'exhibition_location' => $request->exhibition_location,
                'exhibition_description' => $request->exhibition_description,
                'exhibition_photo' => $exhibitionPhotoPath,
                'exhibition_images' => json_encode($images),
                'breadcrumb_name' => $request->breadcrumb_name,
                'breadcrumb_description' => $request->breadcrumb_description,
                'breadcrumb_photo' => $breadcrumbPhotoPath,
                'meta_keyword' => $request->meta_keyword,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'status' => 'Active',
            ]);

            return response()->json(['success' => 'Exhibition added successfully.']);
        } catch (\Exception $e) {
            Log::error('Exhibition Store Error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }


    public function index()
    {
        $exhibitions = Exhibition::get()->all();
        return view('admin.exhibition-list', compact('exhibitions'));
    }

    public function edit($id)
    {
        $exhibition = Exhibition::findOrFail($id);
        $exhibition->decoded_images = json_decode($exhibition->exhibition_images ?? '[]');
        return view('admin.exhibition-add', compact('exhibition'));
    }

    public function update(Request $request, $id)
    {
        $exhibition = Exhibition::findOrFail($id);
        $request->validate([
            'slug' => 'required|string|max:255|alpha_dash|unique:exhibitions,slug,' . $exhibition->id,
            'exhibition_name' => 'required|string',
            'exhibition_date' => 'required|date',
            'exhibition_location' => 'required|string',
            'exhibition_description' => 'nullable|string',
            'exhibition_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'exhibition_images' => 'nullable|array',
            'exhibition_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'exhibition_images_existing.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'existing_exhibition_images' => 'nullable|array',
            'breadcrumb_name' => 'required|string',
            'breadcrumb_description' => 'nullable|string',
            'breadcrumb_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'meta_keyword' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        try {
            $exhibition = Exhibition::findOrFail($id);


            $data = $request->except([
                '_token',
                'exhibition_photo',
                'breadcrumb_photo',
                'exhibition_images',
                'exhibition_images_existing',
                'existing_exhibition_images',
            ]);

            $data['slug'] = Str::slug($request->input('slug'));


            if ($request->hasFile('exhibition_photo')) {
                if ($exhibition->exhibition_photo && Storage::disk('public')->exists($exhibition->exhibition_photo)) {
                    Storage::disk('public')->delete($exhibition->exhibition_photo);
                }
                $data['exhibition_photo'] = $request->file('exhibition_photo')->store('exhibition', 'public');
            }


            if ($request->hasFile('breadcrumb_photo')) {
                if ($exhibition->breadcrumb_photo && Storage::disk('public')->exists($exhibition->breadcrumb_photo)) {
                    Storage::disk('public')->delete($exhibition->breadcrumb_photo);
                }
                $data['breadcrumb_photo'] = $request->file('breadcrumb_photo')->store('exhibition', 'public');
            }


            $finalImages = [];


            $existingOldImages = $request->input('existing_exhibition_images', []);
            foreach ($existingOldImages as $index => $oldImagePath) {
                if ($request->hasFile("exhibition_images_existing.$index")) {

                    $newPath = $request->file("exhibition_images_existing.$index")->store('exhibition', 'public');
                    $finalImages[] = $newPath;


                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                } else {

                    $finalImages[] = $oldImagePath;
                }
            }


            if ($request->hasFile('exhibition_images')) {
                foreach ($request->file('exhibition_images') as $img) {
                    $finalImages[] = $img->store('exhibition', 'public');
                }
            }


            $data['exhibition_images'] = json_encode($finalImages);


            $exhibition->update($data);

            return response()->json(['success' => 'Exhibition updated successfully!']);
        } catch (\Exception $e) {
            \Log::error('Exhibition Update Error: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }


    public function showExhibitions()
    {
        $today = \Carbon\Carbon::today();

        $upcoming = Exhibition::where('status', 'Active')->whereDate('exhibition_date', '>', $today)->get();
        $present = Exhibition::where('status', 'Active')->whereDate('exhibition_date', '=', $today)->get();
        $past = Exhibition::where('status', 'Active')->whereDate('exhibition_date', '<', $today)->get();

        $metaTags = MetaTag::where('page', 'Exhibition')->first();

        $meta_title = $metaTags->meta_title ?? '';
        $meta_description = $metaTags->meta_description ?? '';
        $meta_keywords = $metaTags->meta_keyword ?? '';
        $breadcrumbName = $metaTags->breadcrumb_name ?? '';
        $breadcrumbDescription = $metaTags->breadcrumb_description ?? '';
        $breadcrumbImage = $metaTags->breadcrumb_image ?? '';

        return view('exhibitions', compact('upcoming', 'present', 'past', 'meta_title', 'meta_description', 'meta_keywords', 'breadcrumbName', 'breadcrumbDescription', 'breadcrumbImage'));
    }

    public function exhibitionDetails(string $slug)
    {
        $exhibition = DB::table('exhibitions')->where('slug', $slug)->where('status', 'Active')->first();
        $meta_title = $exhibition->meta_title;
        $meta_description = $exhibition->meta_description;
        $meta_keywords = $exhibition->meta_keyword;

        if (!$exhibition) {
            abort(404);
        }

        return view('exhibitions_details', compact('exhibition', 'meta_title', 'meta_description', 'meta_keywords'));
    }
}
