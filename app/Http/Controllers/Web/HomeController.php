<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Banner;
use App\Models\MetaTag;
use Validator;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function homepage()
    {
        $banners = Banner::where('status','Active')->get();

        $menuCategories = ProductCategory::where('status', 'Active')
            ->where('is_menu', 1)
            ->get();


        $categories = ProductCategory::where('status', 'Active')
            ->where('is_home', 1)
            ->get();


        $products = Product::where('status', 'Active')
            ->where('is_home', 1)
            ->whereHas('category', function ($query) {
                $query->where('status', 'Active');
            })
            ->get();
            
        $metaTags = MetaTag::where('page', 'Homepage')->first();
        
        $meta_title = $metaTags->meta_title ?? '';
        $meta_description = $metaTags->meta_description ?? '';
        $meta_keywords = $metaTags->meta_keyword ?? '';

        return view('welcome', compact('categories', 'products', 'menuCategories','banners', 'meta_title', 'meta_description', 'meta_keywords'));
    }


    public function showActivecategory()
    {
        $categories = ProductCategory::where('status', 'Active')->get();
        return view('categories_list', compact('categories'));
    }

    public function bannerAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'desktop_banner_photo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'mobile_banner_photo'  => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            // 'status' => 'required|in:Active,Inactive',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $desktopPath = $request->file('desktop_banner_photo')->store('banners', 'public');
        $mobilePath  = $request->file('mobile_banner_photo')->store('banners', 'public');
    
        Banner::create([
            'desktop_banner_photo' => $desktopPath,
            'mobile_banner_photo'  => $mobilePath,
            // 'status' => $request->status,
        ]);
    
        return response()->json(['success' => 'Banner added successfully!']);
    }


    public function create(){
        return view('admin.home-banner');
    }

    public function index()
    {
        $banners = Banner::get()->all();
        return view('admin.home_banner_list', compact('banners'));
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.home-banner', compact('banner')); 
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'desktop_banner_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'mobile_banner_photo'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'               => 'required|in:Active,Inactive',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        
        if ($request->hasFile('desktop_banner_photo')) {
            if ($banner->desktop_banner_photo && Storage::disk('public')->exists($banner->desktop_banner_photo)) {
                Storage::disk('public')->delete($banner->desktop_banner_photo);
            }
    
            $desktopPath = $request->file('desktop_banner_photo')->store('banners', 'public');
            $banner->desktop_banner_photo = $desktopPath;
        }
    
       
        if ($request->hasFile('mobile_banner_photo')) {
            if ($banner->mobile_banner_photo && Storage::disk('public')->exists($banner->mobile_banner_photo)) {
                Storage::disk('public')->delete($banner->mobile_banner_photo);
            }
    
            $mobilePath = $request->file('mobile_banner_photo')->store('banners', 'public');
            $banner->mobile_banner_photo = $mobilePath;
        }
    
        $banner->status = $request->status;
        $banner->save();
    
        return response()->json(['success' => 'Banner updated successfully!']);
    }



}
