<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('is_delete', 0)
            ->where('is_archive', 0)
            ->latest()
            ->paginate(10);

        $totalOrders = Order::where('is_delete', 0)->where('is_archive', 0)->count();
        $preparation = Order::where('is_delete', 0)->where('is_archive', 0)->where('status', 'preparation')->count();
        $shipping    = Order::where('is_delete', 0)->where('is_archive', 0)->where('status', 'shipping')->count();
        $delivered   = Order::where('is_delete', 0)->where('is_archive', 0)->where('status', 'delivered')->count();
        $archived    = Order::where('is_delete', 0)->where('is_archive', 1)->count();
        $deleted     = Order::where('is_delete', 1)->count();

        return view('orders.index', compact(
            'orders',
            'totalOrders',
            'preparation',
            'shipping',
            'delivered',
            'archived',
            'deleted'
        ));
    }

    // ** Create Orders ** --
    public function create()
    {
        return view('orders.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'nullable|email|max:255',
            'whatsup' => 'nullable|string|max:20',
            'status'  => 'required|in:preparation,shipping,delivered',
            'address' => 'required|string',
            'msg'     => 'nullable|string',
        ]);

        $validated['is_archive'] = 0;
        $validated['is_delete']  = 0;
        $validated['in_user']  = 0;


        Order::create($validated);

        return redirect()->route('orders.index')->with('status', 'تم إضافة الطلب بنجاح!');
    }

    public function storeInUser(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'nullable|email|max:255',
            'whatsup' => 'nullable|string|max:20',
            'address' => 'required|string',
            'msg'     => 'nullable|string',
        ]);

        $validated['is_archive'] = 0;
        $validated['is_delete']  = 0;
        $validated['in_user']  = 1;


        Order::create($validated);

        return redirect()->route('home')->with('status', 'تم إضافة الطلب بنجاح!');
    }


    // ** Edit Orders ** --
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'email'   => 'nullable|email|max:255',
            'whatsup' => 'nullable|string|max:20',
            'status'  => 'required|in:preparation,shipping,delivered',
            'address' => 'required|string',
            'msg'     => 'nullable|string',
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')->with('status', 'تم تحديث الطلب بنجاح!');
    }



    // ** Destroy Orders ** --
    public function destroy($id)
    {
        $order = Order::where('is_delete', 0)->findOrFail($id);
        $order->update(['is_delete' => 1]);
        return redirect()->route('orders.index')->with('status', 'تم حذف الطلب بنجاح!');
    }

    public function archive($id)
    {
        $order = Order::where('is_archive', 0)->findOrFail($id);
        $order->update(['is_archive' => 1]);
        return redirect()->route('orders.index')->with('status', 'تم أرشيف الطلب بنجاح!');
    }

    public function unarchive($id)
    {
        $order = Order::where('is_archive', 1)->findOrFail($id);
        $order->update(['is_archive' => 0]);
        return redirect()->route('orders.archived')->with('status', 'تم إلغاء أرشفة الطلب بنجاح!');
    }



    // ** Archived Orders ** --
    public function archived()
    {
        $orders = Order::where('is_archive', 1)
            ->where('is_delete', 0)
            ->latest()
            ->get();

        return view('orders.archived', compact('orders'));
    }


    // ** Delete Orders ** --

    public function deleted()
    {
        $orders = Order::where('is_delete', 1)->latest()->get();

        return view('orders.deleted', compact('orders'));
    }

    // ** ResceDelete Orders ** --

    public function restore($id)
    {
        $order = Order::where('is_delete', 1)->findOrFail($id);
        $order->update(['is_delete' => 0]);
        $order->update(['is_archive' => 0]);

        return redirect()->route('orders.deleted')->with('status', 'تم استعادة الطلب بنجاح');
    }

    // ** ForceDelete Orders ** --
    public function forceDelete($id)
    {
        $order = Order::where('is_delete', 1)->findOrFail($id);
        $order->delete();

        return redirect()->route('orders.deleted')->with('status', 'تم حذف الطلب نهائياً');
    }

    public function deleteAllOrder(){
        Order::where('is_delete', 1)->delete();
        return redirect()->route('orders.deleted')->with('status', 'تم تفريغ السلة بنجاح');
    }


}
