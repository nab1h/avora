<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    // عرض جدول الإحصائيات
    public function index()
    {
        $stats = Statistic::orderBy('sort_order')->get();
        return view('admin.statistics.index', compact('stats'));
    }

    // صفحة الإضافة
    public function create()
    {
        return view('admin.statistics.create');
    }

    // حفظ الإحصائية الجديدة
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:50',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        Statistic::create($request->all());
        return redirect()->route('admin.statistics.index')->with('status', 'تمت الإضافة بنجاح');
    }

    // صفحة التعديل
    public function edit($id)
    {
        $stat = Statistic::findOrFail($id);
        return view('admin.statistics.edit', compact('stat'));
    }

    // تحديث الإحصائية
    public function update(Request $request, $id)
    {
        $stat = Statistic::findOrFail($id);

        $request->validate([
            'number' => 'required|string|max:50',
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $stat->update($request->all());
        return redirect()->route('admin.statistics.index')->with('status', 'تم التعديل بنجاح');
    }

    // حذف الإحصائية
    public function destroy($id)
    {
        $stat = Statistic::findOrFail($id);
        $stat->delete();
        return redirect()->back()->with('status', 'تم الحذف بنجاح');
    }
}
