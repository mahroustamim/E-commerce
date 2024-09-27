<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index() {
        $this->authorize('is_admin');
        return view('dashboard.setting');
    }

    public function updateOrCreate(Request $request) {
        $this->authorize('is_admin');
        $request->validate([
            'logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'phone' => 'nullable|string|max:11',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
        ]);

        $existingSetting = Setting::find(1);

        // Handle file uploads
        if ($request->hasFile('logo')) {

            if ($existingSetting && $existingSetting->logo) {
                // Delete the old logo if it exists
                $oldLogoPath = public_path('images/settings/' . $existingSetting->logo);
                if (file_exists($oldLogoPath)) {
                    unlink($oldLogoPath);
                }
            }

            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $logoName = Str::uuid() .'.'.$extension;
            $file->move(public_path('images/settings'), $logoName);
        }

        if ($request->hasFile('favicon')) {

            if ($existingSetting && $existingSetting->favicon) {
                // Delete the old favicon if it exists
                $oldFaviconPath = public_path('images/settings/' . $existingSetting->favicon);
                if (file_exists($oldFaviconPath)) {
                    unlink($oldFaviconPath);
                }
            }
            
            $file = $request->file('favicon');
            $extension = $file->getClientOriginalExtension();
            $faviconName = Str::uuid() .'.'.$extension;
            $file->move(public_path('images/settings'), $faviconName);
        }

        $data = [
            'name_en' => $request->input('name_en'),
            'name_ar' => $request->input('name_ar'),
            'email' => $request->input('email'),
            'facebook' => $request->input('facebook'),
            'instagram' => $request->input('instagram'),
            'twitter' => $request->input('twitter'),
            'phone' => $request->input('phone'),
            'content_en' => $request->input('content_en'),
            'content_ar' => $request->input('content_ar'),
        ];

        if(isset($logoName)) {
            $data['logo'] = $logoName;
        }

        if(isset($faviconName)) {
            $data['favicon'] = $faviconName;
        }

        Setting::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', __('words.saveSucc'));

        }
}
