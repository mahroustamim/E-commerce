<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\SettingUpdateRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Traits\UploadImage;

class SettingController extends Controller
{
    use UploadImage;
    
    public function index()
    {
        return view('dashboard.settings');
    }

    public function updateOrCreate(SettingUpdateRequest $request)
    {
        $validated = $request->validated();
        $attributes = ['id' => 1];  

        $setting = Setting::updateOrCreate($attributes, $validated);

        if ($request->file('logo')) {
            $oldLogoPath = public_path($setting->logo);
            $this->deleteFile($oldLogoPath);
            $setting->update(['logo' => $this->upload($request->logo)]);
        }

        if ($request->file('favicon')) {
            $oldFaviconPath = public_path($setting->favicon);
            $this->deleteFile($oldFaviconPath);
            $setting->update(['favicon' => $this->upload($request->favicon)]);
        }

        return redirect()->back()->with('success', 'تم بنجاح');
    }

}
