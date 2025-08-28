<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetaTag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class MetaTagController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        try {
          //  Log::info('Starting MetaTag update for page: ' . $request->page);

            $validator = Validator::make($request->all(), [
                'page' => 'required|string|max:255',
                'breadcrumb_name' => 'required|string|max:255',
                'breadcrumb_description' => 'nullable|string',
                'breadcrumb_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'meta_keyword' => 'nullable|string|max:255',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                Log::error('Validation failed', $validator->errors()->toArray());
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $path = $request->file('breadcrumb_image')->store('meta-tags', 'public');

            $data = $request->only([
                'page', 'breadcrumb_name', 'breadcrumb_description',
                'meta_keyword', 'meta_title', 'meta_description'
            ]);

            $meta = MetaTag::updateOrCreate(
                ['page' => $request->page],
                ['breadcrumb_image' => $path],
                $data
            );

          //  Log::info('MetaTag updated successfully for page: ' . $request->page);

            return response()->json(['message' => 'Meta Tags updated successfully.']);

        } catch (\Exception $e) {
            Log::error('MetaTag update error: ' . $e->getMessage());
            return response()->json(['message' => 'Something went wrong!', 'error' => $e->getMessage()], 500);
        }
    }

    public function getMetaTag(Request $request)
    {
        $meta = MetaTag::where('page', $request->page)->first();
        return response()->json(['data' => $meta]);
    }
}