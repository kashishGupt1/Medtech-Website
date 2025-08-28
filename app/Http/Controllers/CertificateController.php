<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\MetaTag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'certificate_name' => 'required|string',
            'certificate_photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            // 'breadcrumb_name' => 'nullable|string',
            // 'breadcrumb_description' => 'nullable|string',
            // 'meta_keyword' => 'nullable|string',
            // 'meta_title' => 'nullable|string',
            // 'meta_description' => 'nullable|string',
        ]);

        $path = $request->file('certificate_photo')->store('certificates', 'public');

        Certificate::create(array_merge($validated, [
            'certificate_photo' => $path,
            'status' => 'Active'
        ]));

        return response()->json(['success' => 'Certificate added successfully.']);
    }

    public function index()
    {
        $certificates = Certificate::get()->all();
        return view('admin.certificate-list', compact('certificates'));
    }

    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('admin.certificate-add', compact('certificate'));
    }


    public function update(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);

        $validated = $request->validate([
            'certificate_name' => 'required|string',
            'certificate_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            // 'breadcrumb_name' => 'nullable|string',
            // 'breadcrumb_description' => 'nullable|string',
            // 'meta_keyword' => 'nullable|string',
            // 'meta_title' => 'nullable|string',
            // 'meta_description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        if ($request->hasFile('certificate_photo')) {
            if ($certificate->certificate_photo && Storage::disk('public')->exists($certificate->certificate_photo)) {
                Storage::disk('public')->delete($certificate->certificate_photo);
            }
            $validated['certificate_photo'] = $request->file('certificate_photo')->store('certificates', 'public');
        }

        $certificate->update($validated);

        return response()->json(['success' => 'Certificate updated successfully.']);
    }


    public function show(){
        $certificates = Certificate::where('status', 'active')->get();
        $metaTags = MetaTag::where('page', 'Certificate')->first();

        $meta_title = $metaTags->meta_title ?? '';
        $meta_description = $metaTags->meta_description ?? '';
        $meta_keywords = $metaTags->meta_keyword ?? '';        $breadcrumbName = $metaTags->breadcrumb_name ?? '';
        $breadcrumbDescription = $metaTags->breadcrumb_description ?? '';
        $breadcrumbImage = $metaTags->breadcrumb_image ?? '';
        return view('certifications', compact('certificates', 'meta_title', 'meta_description', 'meta_keywords', 'breadcrumbName', 'breadcrumbDescription', 'breadcrumbImage'));
    }


}
