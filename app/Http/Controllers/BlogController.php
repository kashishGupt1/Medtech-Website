<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Blog;
use Illuminate\Support\Str;
use App\Models\MetaTag;

class BlogController extends Controller
{
    public function create()
    {
        return view('admin.blog-add',['mode' => 'create','blog'=> null]);
    }

    public function store(Request $request)
    {
      //  Log::info('Blog form submitted.', $request->all());

        $validator = Validator::make($request->all(), [
            'slug' => 'required|string|max:255|alpha_dash|unique:blogs,slug',
            'blog_name' => 'required|string|max:255',
            'blog_date' => 'required|date',
            'blog_location' => 'required|string',
            'blog_description' => 'required|string',
            'blog_main_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'blog_images' => 'nullable|array',
            'blog_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'breadcrumb_name' => 'required|string|max:255',
            'breadcrumb_description' => 'nullable|string',
            'breadcrumb_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            // 'status' => 'required|in:Active,Inactive',
        ]);

        if ($validator->fails()) {
            Log::warning('Validation failed.', $validator->errors()->toArray());
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
          //  Log::info('Validation passed.');

            $blog = new Blog($request->except(['blog_main_image', 'blog_images', 'breadcrumb_photo']));
          //  Log::info('Blog model initialized.');
          
          $blog['slug'] = Str::slug($request->input('slug'));

            if ($request->hasFile('blog_main_image')) {
                $path = $request->file('blog_main_image')->store('blogs', 'public');
                $blog->blog_main_image = $path;
             //   Log::info('Blog main image uploaded.', ['path' => $path]);
            }

            if ($request->hasFile('blog_images')) {
                $images = [];
                foreach ($request->file('blog_images') as $img) {
                    $stored = $img->store('blogs', 'public');
                    $images[] = $stored;
                }
                $blog->blog_images = json_encode($images);
             //   Log::info('Multiple blog images uploaded.', ['paths' => $images]);
            }

            if ($request->hasFile('breadcrumb_photo')) {
                $breadcrumbPath = $request->file('breadcrumb_photo')->store('breadcrumbs', 'public');
                $blog->breadcrumb_photo = $breadcrumbPath;
              //  Log::info('Breadcrumb image uploaded.', ['path' => $breadcrumbPath]);
            }

            $blog->save();
          //  Log::info('Blog saved to database.');

            return response()->json(['success' => true, 'message' => 'Blog added successfully!']);

        } catch (\Exception $e) {
            Log::error('Exception occurred during blog save.', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function index()
    {
        $blogs = Blog::get()->all();

        return view('admin.blog-list', compact('blogs'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->decoded_images = json_decode($blog->blog_images ?? '[]');
        return view('admin.blog-add', [
            'mode' => 'edit',
            'blog' => $blog
        ]);
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validator = Validator::make($request->all(), [
        'slug' => 'required|string|max:255|alpha_dash|unique:blogs,slug,' . $blog->id,
            'blog_name' => 'required|string|max:255',
            'blog_date' => 'required|date',
            'blog_location' => 'required|string',
            'blog_description' => 'required|string',
            'blog_main_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'blog_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'blog_images_existing.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'breadcrumb_name' => 'required|string|max:255',
            'breadcrumb_description' => 'nullable|string',
            'breadcrumb_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_keyword' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $blog->fill($request->except([
                'blog_main_image',
                'blog_images',
                'blog_images_existing',
                'existing_blog_images',
                'breadcrumb_photo'
            ]));


            if ($request->hasFile('blog_main_image')) {
                $path = $request->file('blog_main_image')->store('blogs', 'public');
                $blog->blog_main_image = $path;
            }


            $finalImages = [];


            if ($request->has('existing_blog_images')) {
                $existingImages = $request->input('existing_blog_images');

                foreach ($existingImages as $index => $existingImage) {

                    if ($request->hasFile("blog_images_existing.$index")) {
                        $finalImages[] = $request->file("blog_images_existing.$index")->store('blogs', 'public');
                    } else {

                        $finalImages[] = $existingImage;
                    }
                }
            }


            if ($request->hasFile('blog_images')) {
                foreach ($request->file('blog_images') as $img) {
                    $finalImages[] = $img->store('blogs', 'public');
                }
            }


            $blog->blog_images = json_encode($finalImages);
            
            $blog['slug'] = Str::slug($request->input('slug'));


            if ($request->hasFile('breadcrumb_photo')) {
                $blog->breadcrumb_photo = $request->file('breadcrumb_photo')->store('breadcrumbs', 'public');
            }

            $blog->save();

            return response()->json(['success' => true, 'message' => 'Blog updated successfully!']);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    public function blogPage()
    {
        $blogs = Blog::where('status', 'Active')->paginate(6);
        $metaTags = MetaTag::where('page', 'Blog')->first();

        $meta_title = $metaTags->meta_title ?? '';
        $meta_description = $metaTags->meta_description ?? '';
        $meta_keywords = $metaTags->meta_keyword ?? '';
        $breadcrumbName = $metaTags->breadcrumb_name ?? '';
        $breadcrumbDescription = $metaTags->breadcrumb_description ?? '';
        $breadcrumbImage = $metaTags->breadcrumb_image ?? '';
        return view('blog', compact('blogs', 'meta_title', 'meta_description', 'meta_keywords', 'breadcrumbName', 'breadcrumbDescription', 'breadcrumbImage'));
    }

    public function blogDetails(string $slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 'Active')
            ->firstOrFail();

        $recentBlogs = Blog::where('status', 'Active')
            ->where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get();

        $meta_title = $blog->meta_title;
        $meta_description = $blog->meta_description;
        $meta_keywords = $blog->meta_keyword;

        return view('blog_details', compact(
            'blog','recentBlogs','meta_title','meta_description','meta_keywords'
        ));
    }
}
