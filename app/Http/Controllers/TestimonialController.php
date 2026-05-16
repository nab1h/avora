<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{

    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * حفظ الرأي الجديد في قاعدة البيانات
     */
    public function store(Request $request)
    {
        // التحقق من البيانات
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'role'    => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating'  => 'required|integer|min:1|max:5',
        ]);

        // إذا فشل التحقق
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // الحفظ في قاعدة البيانات
        Testimonial::create([
            'name'       => $request->name,
            'role'       => $request->role,
            'message'    => $request->message,
            'rating'     => $request->rating,
            'is_active'  => false, // جعله غير نشط افتراضياً حتى يوافق الأدمن
        ]);

        // إرجاع استجابة نجاح JSON
        return response()->json([
            'success' => true,
            'message' => 'تم الإرسال بنجاح'
        ]);
    }

    /**
     * عرض صفحة تعديل رأي معين
     */
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * تحديث بيانات الرأي
     */
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'name'    => 'required|string|max:255',
            'role'    => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating'  => 'required|integer|min:1,max:5',
            'is_active' => 'nullable|boolean',
        ]);

        $testimonial->update([
            'name'       => $request->name,
            'role'       => $request->role,
            'message'    => $request->message,
            'rating'     => $request->rating,
            'is_active'  => $request->has('is_active'),
        ]);

        return redirect()->route('admin.testimonials.index')->with('status', 'تم تحديث الرأي بنجاح');
    }

    /**
     * تغيير حالة الرأي (تفعيل / تعطيل) - تستخدم في الجدول مباشرة
     */
    public function updateStatus($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->is_active = !$testimonial->is_active;
        $testimonial->save();

        return redirect()->back()->with('status', 'تم تغيير حالة الرأي بنجاح');
    }

    /**
     * حذف الرأي
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->back()->with('status', 'تم حذف الرأي بنجاح');
    }
}
