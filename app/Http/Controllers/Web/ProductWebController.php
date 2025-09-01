<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductCategory;

class ProductWebController extends Controller
{
public function show(Request $request, ?string $slug = null)
{
    
    if (!$slug && $request->filled('category')) {
        $cat = ProductCategory::find($request->get('category'));
        if ($cat) {
            return redirect()->route('category.show', ['slug' => $cat->slug]);
        }
        abort(404);
    }    
    abort_unless($slug, 404);
   
    $currentCategory = ProductCategory::where('slug', $slug)
        ->where('status', 'Active')
        ->firstOrFail();

    
    $products = Product::where('category_id', $currentCategory->id)
        ->where('status', 'Active')
        ->orderBy('sort_order', 'asc')
        ->get();

    
    $activeCategories = ProductCategory::where('status', 'Active')->get();
    
    $meta_title = $currentCategory->meta_title ?? '';
    $meta_description = $currentCategory->meta_description ?? '';
    $meta_keywords = $currentCategory->meta_keyword ?? '';

    return view(
        'category',
        compact('products', 'currentCategory', 'activeCategories', 'meta_title', 'meta_description', 'meta_keywords')
    );
}

    public function showProductDetail(string $categorySlug, string $productSlug)
  {
      $category = ProductCategory::where('slug', $categorySlug)
          ->where('status', 'Active')
          ->firstOrFail();
  
      $product = Product::where('slug', $productSlug)
          ->where('category_id', $category->id)
          ->where('status', 'Active')
          ->firstOrFail();
  
      $features = json_decode($product->features);
      $relatedProductIds = json_decode($product->related_products, true) ?? [];
      $relatedProducts = Product::whereIn('id', $relatedProductIds)
          ->where('status', 'Active')->get();
  
      $meta_title = $product->meta_title;
      $meta_description = $product->meta_description;
      $meta_keywords = $product->meta_keyword;
  
      return view('product_details', compact(
          'product', 'features', 'relatedProducts',
          'meta_title', 'meta_description', 'meta_keywords', 'category'
      ));
  }

    public function search(Request $request)
    {
        $searchTerm = $request->input('s');

        $products = Product::where('product_name', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('product_description', 'LIKE', '%' . $searchTerm . '%')
            ->get();

        $categories = ProductCategory::where('category_name', 'LIKE', '%' . $searchTerm . '%')->get();

        return view('search', compact('searchTerm', 'products', 'categories'));
    }

    
    public function requestQuoteThankYou()
    {
        $user = User::first();
        
        return view('request_quote_thank_you', compact('user'));
    }
}
