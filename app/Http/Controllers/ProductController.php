<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
public function updateOrder(Request $request)
{
    try {
        $orderedIds = $request->input('ordered_ids');

        if (!is_array($orderedIds)) {
            return response()->json(['message' => 'Invalid data format'], 400);
        }

        foreach ($orderedIds as $index => $id) {
            Product::where('id', $id)->update([
                'sort_order' => $index + 1
            ]);
        }

        return response()->json(['message' => 'Order updated successfully.']);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}
    public function create()
    {
        $categories = ProductCategory::where('status', 'Active')->get();
        $allProducts = Product::all();

        return view('admin.product-add', compact('categories', 'allProducts'));
    }

    public function index()
    {
        try {
            $products = Product::with('category')
            ->orderBy('id', 'asc')
            ->get();

            return view('admin.product-list', compact('products'));

        } catch (\Exception $e) {
            Log::error('Failed to load product list: ' . $e->getMessage());
            return back()->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function store(Request $request)
    {
        try {
            // Manual validation (in case you skip StoreProductRequest)
            $validator = Validator::make($request->all(), [
                'slug' => 'required|string|max:255|alpha_dash|unique:products,slug',
                'category_id' => 'required|exists:product_categories,id',
                'product_name' => 'required|string|max:255',
                'product_size' => 'nullable|string|max:255',
                'product_description' => 'required|string',
                'product_technical_specifications_information' => 'nullable|string',

                'product_main_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
                'product_image_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'product_image_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'product_image_3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'product_heading_1' => 'nullable|string|max:255',
                'product_heading_2' => 'nullable|string|max:255',
                'product_heading_3' => 'nullable|string|max:255',

                'related_products' => 'nullable|array',
                'related_products.*' => 'string',

                'breadcrumb_name' => 'required|string|max:255',
                'meta_keyword' => 'nullable|string',
                'meta_title' => 'nullable|string',
                'meta_description' => 'nullable|string',

                'features' => 'nullable|array',
                'features.*' => 'nullable|string',

            ]);


            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $validator->validated();
            $data['slug'] = Str::slug($request->input('slug'));

            // Handle images
            $mainImage = $request->file('product_main_image');
            list($width, $height) = getimagesize($mainImage);
            
            if ($width !== 400 || $height !== 265) {
                return response()->json([
                    'status' => false,
                    'errors' => ['product_main_image' => ['Image must be exactly 400px by 265px.']]
                ], 422);
            }
            
            $data['product_main_image'] = $mainImage->store('products', 'public');

            foreach (['product_image_1', 'product_image_2', 'product_image_3'] as $field) {
                if ($request->hasFile($field)) {
                    $data[$field] = $request->file($field)->store('products', 'public');
                } else {
                    $data[$field] = null;
                }
            }

            // Convert arrays to JSON
            $data['features'] = json_encode($request->features);
            $data['specifications'] = json_encode($request->specs);
            $data['related_products'] = json_encode($request->related_products);


            Product::create($data);

            Log::info('Product created successfully.', ['product_name' => $data['product_name']]);

            return response()->json([
                'status' => true,
                'message' => 'Product created successfully.'
            ]);
        } catch (\Exception $e) {
            Log::error('Product creation failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Something went wrong. Please try again later.'
            ], 500);
        }
    }


    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);
            $categories = ProductCategory::all();
            $allProducts = Product::where('id', '!=', $id)->get(); // Related products dropdown

            return view('admin.product-add', compact('product', 'categories', 'allProducts'));
        } catch (\Exception $e) {
            Log::error('Product edit load failed: ' . $e->getMessage());
            return back()->with('error', 'Product not found.');
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'slug' => 'required|string|max:255|alpha_dash|unique:products,slug,' . $product->id,
                'category_id' => 'required|exists:product_categories,id',
                'product_name' => 'required|string|max:255',
                'product_size' => 'nullable|string|max:255',
                'product_description' => 'required|string',
                'product_technical_specifications_information' => 'nullable|string',
                'product_main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'product_image_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'product_image_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'product_image_3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'product_heading_1' => 'nullable|string|max:255',
                'product_heading_2' => 'nullable|string|max:255',
                'product_heading_3' => 'nullable|string|max:255',
                'related_products' => 'nullable|array',
                'related_products.*' => 'string',
                'breadcrumb_name' => 'required|string|max:255',
                'meta_keyword' => 'nullable|string',
                'meta_title' => 'nullable|string',
                'meta_description' => 'nullable|string',
                'features' => 'nullable|array',
                'features.*' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
            }

            $data = $validator->validated();
            $data['slug'] = Str::slug($request->input('slug'));
            $product = Product::findOrFail($id);

            if ($request->hasFile('product_main_image')) {
                $mainImage = $request->file('product_main_image');
                list($width, $height) = getimagesize($mainImage);
            
                if ($width !== 400 || $height !== 265) {
                    return response()->json([
                        'status' => false,
                        'errors' => ['product_main_image' => ['Image must be exactly 400px by 265px.']]
                    ], 422);
                }
            
                $data['product_main_image'] = $mainImage->store('products', 'public');
            }

            foreach (['product_image_1', 'product_image_2', 'product_image_3'] as $field) {
                if ($request->hasFile($field)) {
                    $data[$field] = $request->file($field)->store('products', 'public');
                }
            }

            $data['features'] = json_encode($request->features);
            $data['related_products'] = json_encode($request->related_products ?? []);
            $data['status'] = $request->status ?? 'Active';

            $product->update($data);

            Log::info('Product updated.', ['product_id' => $product->id]);

            return response()->json(['status' => true, 'message' => 'Product updated successfully.']);
        } catch (\Exception $e) {
            Log::error('Product update failed: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Something went wrong.'], 500);
        }
    }


    public function toggleCheckbox(Request $request)
    {
        $product = Product::find($request->id);

        if (!$product) {
            return response()->json(['status' => false, 'message' => 'Product not found'], 404);
        }

        if ($request->has('is_menu')) {
            $product->is_menu = $request->is_menu;
        }

        if ($request->has('is_home')) {
            $product->is_home = $request->is_home;
        }

        $product->save();

        return response()->json(['status' => true, 'message' => 'Product updated successfully']);
    }


}
