<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Orders Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 rounded-lg p-4 text-sm">
                {{ session('status') }}
            </div>
            @endif

            <!-- Page Title -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-white">سجل الطلبات</h3>
                    <p class="text-gray-400 text-sm mt-1">متابعة وتنفيذ طلبات العملاء.</p>
                </div>

                <!-- Add Order Button -->
                <a href="{{ route('orders.create') }}">
                    <button class="px-5 py-2.5 bg-[#E60914] hover:bg-red-700 text-white rounded-lg transition flex items-center gap-2 shadow-lg shadow-red-900/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        إضافة طلب جديد
                    </button>
                </a>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
                <!-- Total Orders -->
                <div class="bg-[#111111] border border-[#1a1a1a] p-4 rounded-xl flex items-center gap-4">
                    <div class="p-3 bg-blue-500/10 rounded-lg text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">إجمالي الطلبات</p>
                        <h4 class="text-xl font-bold text-white">{{ $totalOrders }}</h4>
                    </div>
                </div>
                <!-- Preparation -->
                <div class="bg-[#111111] border border-[#1a1a1a] p-4 rounded-xl flex items-center gap-4">
                    <div class="p-3 bg-yellow-500/10 rounded-lg text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">قيد التجهيز</p>
                        <h4 class="text-xl font-bold text-white">{{ $preparation }}</h4>
                    </div>
                </div>
                <!-- Shipping -->
                <div class="bg-[#111111] border border-[#1a1a1a] p-4 rounded-xl flex items-center gap-4">
                    <div class="p-3 bg-blue-500/10 rounded-lg text-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M8 17h8M8 17v4h8v-4M8 17H5a2 2 0 01-2-2V7c0-1.1.9-2 2-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3m-8 0V5a2 2 0 012-2h4a2 2 0 012 2v12" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">في الشحن</p>
                        <h4 class="text-xl font-bold text-white">{{ $shipping }}</h4>
                    </div>
                </div>
                <!-- Delivered -->
                <div class="bg-[#111111] border border-[#1a1a1a] p-4 rounded-xl flex items-center gap-4">
                    <div class="p-3 bg-green-500/10 rounded-lg text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs">تم التسليم</p>
                        <h4 class="text-xl font-bold text-white">{{ $delivered }}</h4>
                    </div>
                </div>
                <!-- Archived -->
                <a href="{{ route('orders.archived') }}" class="block hover:border-purple-500/50 transition">
                    <div class="bg-[#111111] border border-[#1a1a1a] p-4 rounded-xl flex items-center gap-4 h-full">
                        <div class="p-3 bg-purple-500/10 rounded-lg text-purple-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">الأرشيف</p>
                            <h4 class="text-xl font-bold text-white">{{ $archived }}</h4>
                        </div>
                    </div>
                </a>

                <!-- Recently Deleted -->
                <a href="{{ route('orders.deleted') }}" class="block hover:border-red-500/50 transition">
                    <div class="bg-[#111111] border border-[#1a1a1a] p-4 rounded-xl flex items-center gap-4 h-full">
                        <div class="p-3 bg-red-500/10 rounded-lg text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">المحذوف مؤخراً</p>
                            <h4 class="text-xl font-bold text-white">{{ $deleted }}</h4>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Table Card -->
            <div class="bg-[#111111] border border-[#1a1a1a] rounded-2xl shadow-2xl overflow-hidden">

                <!-- The Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-300">
                        <thead class="text-xs uppercase bg-[#0a0a0a] text-gray-500 border-b border-[#1a1a1a]">
                            <tr>
                                <th scope="col" class="px-6 py-4">#ID</th>
                                <th scope="col" class="px-6 py-4">اسم العميل</th>
                                <th scope="col" class="px-6 py-4">العنوان</th>
                                <th scope="col" class="px-6 py-4">التواصل</th>
                                <th scope="col" class="px-6 py-4">حالة الطلب</th>
                                <th scope="col" class="px-6 py-4">من طلب</th>
                                <th scope="col" class="px-6 py-4 text-center">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr class="bg-[#111111] hover:bg-[#141414] transition border-b border-[#1a1a1a]">
                                <td class="px-6 py-4 font-mono text-gray-500">#{{ $order->id }}</td>
                                <td class="px-6 py-4 font-medium whitespace-nowrap text-white">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-[#E60914]/20 flex items-center justify-center text-[#E60914] font-bold text-xs">
                                            {{ \Str::limit($order->name, 1, '') }}
                                        </div>
                                        {{ $order->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 max-w-xs truncate">{{ $order->address }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        @if($order->whatsup)
                                        <a href="https://wa.me/{{ $order->whatsup }}" target="_blank" class="text-gray-400 hover:text-green-500 transition p-1">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                            </svg>
                                        </a>
                                        @endif
                                        @if($order->phone)
                                        <a href="tel:{{ $order->phone }}" class="text-gray-400 hover:text-blue-400 transition p-1">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                        </a>
                                        @endif
                                        @if($order->email)
                                        <a href="mailto:{{ $order->email }}" class="text-gray-400 hover:text-red-400 transition p-1">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                                            </svg>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                    $statusClasses = [
                                    'preparation' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                                    'shipping' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    'delivered' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                    ];
                                    $statusLabels = [
                                    'preparation' => 'قيد التجهيز',
                                    'shipping' => 'في الشحن',
                                    'delivered' => 'تم التسليم',
                                    ];
                                    @endphp
                                    <span class="px-3 py-1 text-xs rounded-full border font-medium {{ $statusClasses[$order->status] ?? 'bg-gray-500/10 text-gray-400' }}">
                                        {{ $statusLabels[$order->status] ?? $order->status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    @php
                                    $inUserClasses = [
                                    0 => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    1 => 'bg-green-500/10 text-green-400 border-green-500/20',
                                    ];
                                    $inUserLabels = [
                                    0 => 'المندوب',
                                    1 => 'العميل',
                                    ];
                                    @endphp
                                    <span class="px-3 py-1 text-xs rounded-full border font-medium
                                     {{ $inUserClasses[$order->in_user] ?? 'bg-gray-500/10 text-gray-400' }}">

                                        {{ $inUserLabels[$order->in_user] ?? $order->in_user }}
                                    </span>
                                </td>


                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <a href="{{ route('orders.edit', $order->id) }}" title="تعديل">
                                            <button class="p-2 hover:bg-blue-500/10 rounded-lg transition text-gray-400 hover:text-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </button>
                                        </a>

                                        <form action="{{ route('orders.archive', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من أرشيفة هذا الطلب؟');">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="p-2 hover:bg-yellow-500/10 rounded-lg transition text-gray-400 hover:text-yellow-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 4h16v4H4V4zm0 4l1 12h14l1-12M10 12h4" />
                                                </svg>
                                            </button>
                                        </form>

                                        @if(auth()->user()->role === "admin")
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من حذف هذا الطلب؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="حذف" class="p-2 hover:bg-red-500/10 rounded-lg transition text-gray-400 hover:text-[#E60914]">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            @if ($orders->count() == 0)
                            <tr>
                                <td colspan="6" class="text-center py-10 text-gray-500">
                                    لا توجد طلبات حالياً.
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-4 border-t border-[#1a1a1a] flex justify-between items-center text-sm text-gray-400">
                    <span>عرض {{ $orders->firstItem() ?? 0 }} إلى {{ $orders->lastItem() ?? 0 }} من {{ $orders->total() }} نتيجة</span>
                    {{ $orders->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
