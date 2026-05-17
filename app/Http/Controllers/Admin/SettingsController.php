<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{

    public function index()
    {
        $setting = Setting::firstOrCreate(['id' => 1]);

        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_title' => 'required|string|max:255',
            'meta_description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'icon_180' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
            'icon_32' => 'nullable|image|mimes:png,ico|max:512',
            'icon_16' => 'nullable|image|mimes:png,ico|max:512',
            'manifest' => 'nullable|file|mimes:json|max:512',

            'address_en' => 'nullable|string',
            'address_ar' => 'nullable|string',
            'hours_en' => 'nullable|string',
            'hours_ar' => 'nullable|string',

            'mobile' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'email' => 'nullable|email',
            'map_link' => 'nullable|string',

            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'snapchat' => 'nullable|url',
            'tiktok' => 'nullable|url',
        ]);

        $data = $request->only([
            'site_name',
            'site_title',
            'meta_description',
            'address_en',
            'address_ar',
            'hours_en',
            'hours_ar',
            'mobile',
            'whatsapp',
            'email',
            'map_link',
            'facebook',
            'twitter',
            'instagram',
            'snapchat',
            'tiktok'
        ]);

        $uploadImage = function ($file, $folder, $oldValue) use (&$data) {
            if ($file) {
                if ($oldValue && Storage::disk('public')->exists($oldValue)) {
                    Storage::disk('public')->delete($oldValue);
                }
                $path = $file->store($folder, 'public');
                $data[$folder] = $path;
            }
        };

        $uploadImage($request->logo, 'logo', $setting->logo);
        $uploadImage($request->icon_180, 'icon_180', $setting->icon_180);
        $uploadImage($request->icon_32, 'icon_32', $setting->icon_32);
        $uploadImage($request->icon_16, 'icon_16', $setting->icon_16);

        if ($request->manifest) {
            if ($setting->manifest && Storage::disk('public')->exists($setting->manifest)) {
                Storage::disk('public')->delete($setting->manifest);
            }
            $manifestPath = $request->manifest->store('manifest', 'public');
            $data['manifest'] = $manifestPath;
        }

        $setting->update($data);

        return redirect()->back()->with('status', 'تم تحديث الإعدادات بنجاح!');
    }
}
