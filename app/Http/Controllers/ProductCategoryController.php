<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{

    public function create()
    {
        return view('admin.category-add');
    }
    public function store(Request $request)
    {
        // \Log::info('Store method called.');

        try {
            // \Log::info('Request Data:', $request->all());

            $validator = Validator::make($request->all(), [
                'slug' => 'required|string|max:255|alpha_dash|unique:product_categories,slug',
                'category_name' => 'required|string|max:255',
                'short_description' => 'required|string',
                'category_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
                'breadcrumb_name' => 'required|string|max:255',
                'breadcrumb_description' => 'nullable|string',
                'breadcrumb_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'meta_keyword' => 'nullable|string|max:255',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                // 'status' => 'required|in:Active,Inactive',
            ]);

            if ($validator->fails()) {
                \Log::warning('Validation failed:', $validator->errors()->toArray());
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $data = $request->all();            

            $data['slug'] = Str::slug($request->input('slug'));

            if ($request->hasFile('category_image')) {
                $data['category_image'] = $request->file('category_image')->store('category_images', 'public');
            }

            if ($request->hasFile('breadcrumb_image')) {
                $data['breadcrumb_image'] = $request->file('breadcrumb_image')->store('breadcrumb_images', 'public');
            }

            ProductCategory::create($data);

            // \Log::info('Category created successfully.');
            return response()->json(['success' => 'Category added successfully.']);
        } catch (\Exception $e) {
            \Log::error('Exception occurred: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
    }

    public function index()
    {
        $categories = ProductCategory::latest()->get();
        return view('admin.category-list', compact('categories'));
    }

    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('admin.category-add', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);
        $request->validate([
            'slug' => 'required|string|max:255|alpha_dash|unique:product_categories,slug,' . $category->id,
            'category_name' => 'required',
            'short_description' => 'required',
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'breadcrumb_name' => 'required|string|max:255',
            'breadcrumb_description' => 'nullable|string',
            'breadcrumb_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_keyword' => 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'status' => 'required|in:Active,Inactive',
        ]);

        $category = ProductCategory::findOrFail($id);
        $data = $request->all();
        
        $data['slug'] = Str::slug($request->input('slug'));

        if ($request->hasFile('category_image')) {
            $data['category_image'] = $request->file('category_image')->store('category_images', 'public');
        }

        if ($request->hasFile('breadcrumb_image')) {
            $data['breadcrumb_image'] = $request->file('breadcrumb_image')->store('breadcrumb_images', 'public');
        }
        $category->update($data);

        return response()->json(['success' => 'Category updated successfully.']);
    }

    public function toggleCheckbox(Request $request)
    {
        $category = ProductCategory::find($request->id);

        if (!$category) {
            return response()->json(['status' => false, 'message' => 'Category not found'], 404);
        }

        if ($request->has('is_menu')) {
            $category->is_menu = $request->is_menu;
        }

        if ($request->has('is_home')) {
            $category->is_home = $request->is_home;
        }

        $category->save();

        return response()->json(['status' => true, 'message' => 'Category updated successfully']);
    }


}

