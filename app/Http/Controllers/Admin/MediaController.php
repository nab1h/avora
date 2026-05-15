<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $heroVideo = Media::where('type', 'hero_video')->first();
        $heroImage = Media::where('type', 'hero_image')->first();
        $galleryImages = Media::where('type', 'gallery_image')->ordered()->get();

        return view('admin.media.index', compact('heroVideo', 'heroImage', 'galleryImages'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'type' => 'required|in:hero_video,hero_image,gallery_image',
    //         'file' => 'nullable|mimes:mp4,webm,png,jpg,jpeg|max:10240',
    //         'title' => 'nullable|string|max:255',
    //     ]);

    //     $data = [
    //         'type' => $request->type,
    //         'title' => $request->title,
    //         'is_active' => true,
    //     ];

    //     $existingMedia = Media::where('type', $request->type)->first();

    //     if ($request->hasFile('file')) {
    //         if ($existingMedia) {
    //             if ($existingMedia->path) Storage::disk('public')->delete($existingMedia->path);
    //             if ($existingMedia->thumbnail) Storage::disk('public')->delete($existingMedia->thumbnail);
    //             $existingMedia->delete();
    //         }

    //         $path = $request->file->store('media', 'public');
    //         $data['path'] = $path;
    //         $data['thumbnail'] = $path;

    //         Media::create($data);
    //     } else {
    //         if ($existingMedia) {
    //             $existingMedia->update($request->only(['title']));
    //         }
    //     }

    //     return redirect()->back()->with('status', 'تم رفع/تحديث الوسائط بنجاح');
    // }


    public function store(Request $request)
    {
        // تحديد النوع (Hero Video, Hero Image, or Gallery Image)
        $request->validate([
            'type' => 'required|in:hero_video,hero_image,gallery_image',
            'file' => 'required_if:type,hero_video,mimes:mp4,webm|max:10240|required_if:type,hero_image,mimes:png,jpg,jpeg|max:2048|required_if:type,gallery_image,mimes:png,jpg,jpeg|max:2048',
            'title' => 'nullable|string|max:255',
        ]);

        $data = [
            'type' => $request->type,
            'title' => $request->title,
            'is_active' => true,
        ];

        // إذا كان المعرض، حدد ترتيب تلقائي
        if ($request->type === 'gallery_image') {
            $maxOrder = Media::where('type', 'gallery_image')->max('order_column');
            $data['order_column'] = $maxOrder + 1;
        }

        // رفع الملف
        if ($request->file) {
            $file = $request->file;

            // حذف القديم إذا كان يوجد (لأننا نستخدم سجل واحد لكل نوع في هذا المثال البسيط)
            if ($request->type === 'hero_video' && $heroVideo = Media::where('type', 'hero_video')->first()) {
                if ($heroVideo->path) Storage::disk('public')->delete($heroVideo->path);
                if ($heroVideo->thumbnail) Storage::disk('public')->delete($heroVideo->thumbnail);
                $heroVideo->delete();
            } elseif ($request->type === 'hero_image' && $heroImage = Media::where('type', 'hero_image')->first()) {
                if ($heroImage->path) Storage::disk('public')->delete($heroImage->path);
                $heroImage->delete();
            }

            // حفظ الملف
            $path = $file->store('media', 'public');
            $data['path'] = $path;

            // إذا كان فيديو، لا نحتاج صورة مصغرة هنا (تأكد أن الـ Frontend يتعامل معه)
            // أو يمكننا حفظ المسار نفسه كـ thumbnail للتبسيط
            $data['thumbnail'] = $path;
        }

        Media::create($data);

        return redirect()->back()->with('status', 'تم رفع الوسائط بنجاح');
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);

        $request->validate([
            'file' => 'nullable|mimes:mp4,webm,png,jpg,jpeg|max:10240',
            'title' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file')) {
            if ($media->path) Storage::disk('public')->delete($media->path);

            $path = $request->file->store('media', 'public');
            $media->path = $path;
            $media->thumbnail = $path;
        }

        if ($request->filled('title')) {
            $media->title = $request->title;
        }

        $media->save();

        return redirect()->back()->with('status', 'تم تحديث الوسائط بنجاح');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        if ($media->path) {
            Storage::disk('public')->delete($media->path);
        }

        $media->delete();

        return redirect()->back()->with('status', 'تم حذف الوسائط');
    }
}
