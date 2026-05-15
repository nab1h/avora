<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all(); // سيتم ترتيبها تلقائياً بفضل الـ Global Scope
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_en' => 'required|string|max:255',
            'question_ar' => 'nullable|string|max:255',
            'answer_en' => 'required|string',
            'answer_ar' => 'nullable|string',
        ]);

        // محاولة إيجاد أكبر رقم ترتيب لوضع السؤال الجديد آخر القائمة تلقائياً
        $maxOrder = Faq::max('order_column');
        $request->merge(['order_column' => $maxOrder + 1, 'is_active' => true]);

        Faq::create($request->all());

        return redirect()->route('admin.faqs.index')->with('status', 'تم إضافة السؤال بنجاح');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question_en' => 'required|string|max:255',
            'question_ar' => 'nullable|string|max:255',
            'answer_en' => 'required|string',
            'answer_ar' => 'nullable|string',
            'is_active' => 'boolean',
            'order_column' => 'integer'
        ]);

        $faq->update($request->all());

        return redirect()->route('admin.faqs.index')->with('status', 'تم تعديل السؤال بنجاح');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->back()->with('status', 'تم حذف السؤال');
    }
}
