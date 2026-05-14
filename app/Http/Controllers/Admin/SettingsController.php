<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * عرض صفحة الإعدادات
     */
    public function index()
    {
        $setting = Setting::firstOrCreate(['id' => 1]);

        return view('admin.settings.index', compact('setting'));
    }

    /**
     * تحديث الإعدادات
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        // التحقق من صحة البيانات
        $request->validate([
            // البيانات الأساسية
            'site_name' => 'required|string|max:255',
            'site_title' => 'required|string|max:255',
            'meta_description' => 'nullable|string',

            // الصور والأيقونات
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'icon_180' => 'nullable|image|mimes:png,jpg,jpeg|max:1024',
            'icon_32' => 'nullable|image|mimes:png,ico|max:512',
            'icon_16' => 'nullable|image|mimes:png,ico|max:512',
            'manifest' => 'nullable|file|mimes:json|max:512',

            // العنوان والمواعيد (باللغتين)
            'address_en' => 'nullable|string',
            'address_ar' => 'nullable|string',
            'hours_en' => 'nullable|string',
            'hours_ar' => 'nullable|string',

            // بيانات التواصل
            'mobile' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'email' => 'nullable|email',
            'map_link' => 'nullable|string',

            // السوشيال ميديا (روابط)
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'snapchat' => 'nullable|url',
            'tiktok' => 'nullable|url',
        ]);

        // جمع البيانات النصية والروابط
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

        // دالة مساعدة لرفع الصور وحذف القديمة
        $uploadImage = function ($file, $folder, $oldValue) use (&$data) {
            if ($file) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($oldValue && Storage::disk('public')->exists($oldValue)) {
                    Storage::disk('public')->delete($oldValue);
                }
                // رفع الصورة الجديدة وحفظ المسار
                $path = $file->store($folder, 'public');
                $data[$folder] = $path;
            }
        };

        // رفع الصور
        $uploadImage($request->logo, 'logo', $setting->logo);
        $uploadImage($request->icon_180, 'icon_180', $setting->icon_180);
        $uploadImage($request->icon_32, 'icon_32', $setting->icon_32);
        $uploadImage($request->icon_16, 'icon_16', $setting->icon_16);

        // رفع ملف Manifest
        if ($request->manifest) {
            if ($setting->manifest && Storage::disk('public')->exists($setting->manifest)) {
                Storage::disk('public')->delete($setting->manifest);
            }
            $manifestPath = $request->manifest->store('manifest', 'public');
            $data['manifest'] = $manifestPath;
        }

        // حفظ البيانات
        $setting->update($data);

        return redirect()->back()->with('status', 'تم تحديث الإعدادات بنجاح!');
    }
}
