<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Recently Deleted') }}
            </h2>
            <!-- تم تعديل الرابط ليوجه لصفحة الطلبات الرئيسية -->
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

            <!-- Warning Message -->
            <div class="mb-6 bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 rounded-lg p-4 flex items-center gap-3 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <span>العناصر المحذوفة سيتم حذفها نهائياً تلقائياً بعد 30 يوماً.</span>
            </div>

            <!-- Table Card -->
            <div class="bg-[#111111] border border-[#1a1a1a] rounded-2xl shadow-2xl overflow-hidden">

                <!-- Table Header Info -->
                <div class="p-6 border-b border-[#1a1a1a] flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-bold text-white">سلة المحذوفات</h3>
                        <!-- عرض العدد الحقيقي -->
                        <p class="text-gray-500 text-sm mt-1">{{ $orders->count() }} طلب محذوف</p>
                    </div>

                    <div class="flex gap-2">
                        <form action="{{ route('orders.deleteAllOrder') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="px-4 py-2 bg-red-900/20 text-red-500 hover:bg-red-900/40 border border-red-900/30 rounded-lg text-sm font-medium transition flex items-center gap-2 {{ auth()->user()->role !== 'admin' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                @if(auth()->user()->role !== 'admin') disabled @endif
                                >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                إفراغ السلة
                            </button>
                        </form>
                    </div>
                </div>

                <!-- The Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-300">
                        <thead class="text-xs uppercase bg-[#0a0a0a] text-gray-500 border-b border-[#1a1a1a]">
                            <tr>
                                <th scope="col" class="px-6 py-4">#ID</th>
                                <th scope="col" class="px-6 py-4">اسم العميل</th>
                                <th scope="col" class="px-6 py-4">الهاتف</th>
                                <th scope="col" class="px-6 py-4">تاريخ الحذف</th>
                                <th scope="col" class="px-6 py-4 text-center">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orders as $order)
                            <tr class="bg-[#111111] hover:bg-[#141414] transition border-b border-[#1a1a1a]">
                                <td class="px-6 py-4 font-mono text-gray-500">#{{ $order->id }}</td>
                                <td class="px-6 py-4 font-medium whitespace-nowrap text-white">{{ $order->name }}</td>
                                <td class="px-6 py-4">{{ $order->phone }}</td>
                                <td class="px-6 py-4 text-gray-400">
                                    {{-- نستخدم updated_at كتاريخ تقريبي للحذف لأنه تم تعديل الحالة --}}
                                    {{ $order->updated_at->diffForHumans() }}
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">

                                        <!-- Restore Button -->
                                        <form action="{{ route('orders.restore', $order->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" title="استعادة" class="p-2 bg-green-500/10 hover:bg-green-500/20 rounded-lg transition text-green-500 flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- Delete Permanently Button -->
                                        <form action="{{ route('orders.force-delete', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من الحذف النهائي؟ لا يمكن التراجع عن هذا الإجراء.');">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="px-4 py-2 bg-red-900/20 text-red-500 hover:bg-red-900/40 border border-red-900/30 rounded-lg text-sm font-medium transition flex items-center gap-2 {{ auth()->user()->role !== 'admin' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                                @if(auth()->user()->role !== 'admin') disabled @endif
                                                >
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
                                <td colspan="5" class="text-center py-12 text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    سلة المحذوفات فارغة.
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
