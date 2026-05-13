<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Archived Orders') }}
            </h2>
            <a href="{{ route('orders.index') }}" class="text-sm text-gray-400 hover:text-white flex items-center gap-2 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                العودة للطلبات
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Info Message -->
            <div class="mb-6 bg-purple-500/10 border border-purple-500/20 text-purple-400 rounded-lg p-4 flex items-center gap-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                <span>هذه الطلبات تم أرشفتها ولا تظهر في القائمة الرئيسية. يمكنك استعادتها أو حذفها.</span>
            </div>

            <!-- Table Card -->
            <div class="bg-[#111111] border border-[#1a1a1a] rounded-2xl shadow-2xl overflow-hidden">

                <!-- Table Header Info -->
                <div class="p-6 border-b border-[#1a1a1a] flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold text-white">الطلبات المؤرشفة</h3>
                        <p class="text-gray-500 text-sm mt-1">{{ $orders->count() }} طلب مؤرشف</p>
                    </div>
                </div>

                <!-- The Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-300">
                        <thead class="text-xs uppercase bg-[#0a0a0a] text-gray-500 border-b border-[#1a1a1a]">
                            <tr>
                                <th scope="col" class="px-6 py-4">#ID</th>
                                <th scope="col" class="px-6 py-4">اسم العميل</th>
                                <th scope="col" class="px-6 py-4">العنوان</th>
                                <th scope="col" class="px-6 py-4">الهاتف</th>
                                <th scope="col" class="px-6 py-4">تاريخ الأرشفة</th>
                                <th scope="col" class="px-6 py-4 text-center">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orders as $order)
                            <tr class="bg-[#111111] hover:bg-[#141414] transition border-b border-[#1a1a1a]">
                                <td class="px-6 py-4 font-mono text-gray-500">#{{ $order->id }}</td>
                                <td class="px-6 py-4 font-medium whitespace-nowrap text-white">{{ $order->name }}</td>
                                <td class="px-6 py-4 max-w-xs truncate">{{ $order->address }}</td>
                                <td class="px-6 py-4">{{ $order->phone }}</td>
                                <td class="px-6 py-4 text-gray-400">{{ $order->updated_at->format('Y-m-d') }}</td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">

                                        <!-- Unarchive Button -->
                                        <form action="{{ route('orders.unarchive', $order->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" title="إلغاء الأرشفة" class="p-2 bg-purple-500/10 hover:bg-purple-500/20 rounded-lg transition text-purple-400 hover:text-purple-300 flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- Delete Button (Move to Trash) -->
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من نقل الطلب للمحذوفات؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="حذف" class="p-2 bg-red-500/10 hover:bg-red-500/20 rounded-lg transition text-red-500 flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            @if ($orders->count() == 0)
                            <tr>
                                <td colspan="6" class="text-center py-12 text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                    لا توجد طلبات مؤرشفة.
                                </td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
