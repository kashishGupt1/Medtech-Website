<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Broucher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BroucherController extends Controller
{
        public function create(){
            $brouchers = Broucher::latest()->first();
            return view('admin.broucher', compact('brouchers'));
        }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'broucher_pdf' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

       
        $path = $request->file('broucher_pdf')->store('brouchers', 'public');

        Broucher::create([
            'broucher_pdf' => $path, 
        ]);

        return response()->json(['message' => 'Broucher uploaded successfully']);
    }


    public function index(){
        $brouchers = Broucher::get()->all();
        return view('admin.broucher_list',compact('brouchers'));
    }

        public function edit($id)
        {
            $brouchers = Broucher::findOrFail($id);
            return view('admin.broucher', compact('brouchers'));
        }


    public function update(Request $request, $id)
    {
        $brouchers = Broucher::findOrFail($id);

        $validated = $request->validate([
            'broucher_pdf' => 'nullable|mimes:pdf',
        ]);

        if ($request->hasFile('broucher_pdf')) {
            if ($brouchers->broucher_pdf && Storage::disk('public')->exists($brouchers->broucher_pdf)) {
                Storage::disk('public')->delete($brouchers->broucher_pdf);
            }
            $validated['broucher_pdf'] = $request->file('broucher_pdf')->store('brouchers', 'public');
        }

        $brouchers->update($validated);

        return response()->json(['message' => 'Broucher updated successfully.']);
    }

    public function downloadLatest()
    {
        $broucher = Broucher::latest()->first();

        if ($broucher && Storage::exists('public/' . $broucher->broucher_pdf)) {
            return response()->download(storage_path('app/public/' . $broucher->broucher_pdf));
        }

        return redirect()->back()->with('error', 'No file available for download.');
    }

}
