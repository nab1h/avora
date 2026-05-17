<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('الأرشيف') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 rounded-lg p-4 text-sm flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('status') }}
            </div>
            @endif

            <!-- Title & Actions -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h3 class="text-2xl font-bold text-white">سجل الحجوزات المؤرشفة</h3>
                    <p class="text-gray-400 text-sm mt-1">عرض الحجوزات المؤرشفة (المنتهية أو المحذوفة مؤقتاً).</p>
                </div>

                <div class="flex gap-3 items-center flex-wrap">

                    <!-- Filter & Search Form -->
                    <form action="{{ route('reservations.archive') }}" method="GET" class="flex gap-3 items-center">

                        <!-- Search by ID -->
                        <div class="relative group mx-5">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-search text-gray-500 group-focus-within:text-[#E60914] transition"></i>
                            </div>
                            <input type="number"
                                name="search_id"
                                value="{{ request('search_id') }}"
                                placeholder="بحث برقم ID"
                                class="bg-[#111] border border-[#1a1a1a] text-gray-300 rounded-lg pl-3 pr-10 py-2.5 focus:outline-none focus:border-[#E60914] w-40 transition text-sm placeholder-gray-600">
                        </div>

                        <!-- Status Filter -->
                        <select name="status" onchange="this.form.submit()"
                            class="bg-[#111] border border-[#1a1a1a] text-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:border-[#E60914] cursor-pointer text-sm">
                            <option value="">الكل (All)</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                            <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>مؤكد</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مكتمل</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>ملغي</option>
                        </select>

                        <button type="submit" class="bg-[#1a1a1a] text-gray-300 hover:text-white px-3 py-2.5 rounded-lg border border-[#1a1a1a] hover:border-gray-500 transition">
                            <i class="fas fa-filter"></i>
                        </button>
                    </form>

                    <!-- Back Button -->
                    <a href="{{ route('reservations.index') }}">
                        <button class="px-5 py-2.5 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition flex items-center gap-2">
                            <i class="fas fa-arrow-right"></i> العودة للقائمة
                        </button>
                    </a>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <div class="bg-[#111] p-4 rounded-xl border border-[#1a1a1a]">
                    <p class="text-gray-400 text-xs">إجمالي المؤرشف</p>
                    <h4 class="text-xl text-white font-bold">{{ $totalArchived ?? 0 }}</h4>
                </div>

                <div class="bg-[#111] p-4 rounded-xl border border-[#1a1a1a] flex items-center justify-center">
                    <p class="text-gray-400 text-sm text-center">
                        <i class="fas fa-info-circle text-gray-500 ml-2"></i>
                        يمكنك استعادة أي حجز من هنا لإعادته للعمل.
                    </p>
                </div>
            </div>

            <!-- Table -->
            <div class="bg-[#111] border border-[#1a1a1a] rounded-2xl overflow-hidden shadow-2xl opacity-90">

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-gray-300">
                        <thead class="bg-[#0a0a0a] text-gray-500 text-xs uppercase">
                            <tr>
                                <th class="px-6 py-4">#ID</th>
                                <th class="px-6 py-4">الاسم</th>
                                <th class="px-6 py-4">الهاتف</th>
                                <th class="px-6 py-4">الأفراد</th>
                                <th class="px-6 py-4">التاريخ</th>
                                <th class="px-6 py-4">الوقت</th>
                                <th class="px-6 py-4">الحالة</th>
                                <th class="px-6 py-4 text-center">إجراءات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($reservations as $reservation)
                            <tr class="border-b border-[#1a1a1a] hover:bg-[#141414] transition duration-200">

                                <td class="px-6 py-4 font-mono text-xs text-gray-500">#{{ $reservation->id }}</td>

                                <td class="px-6 py-4 text-white font-medium">
                                    {{ $reservation->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $reservation->phone }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $reservation->guests }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $reservation->reservation_date }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $reservation->reservation_time }}
                                </td>

                                <td class="px-6 py-4">
                                    @php
                                    $statusClasses = [
                                    'pending' => 'bg-yellow-500/10 text-yellow-400 border-yellow-500/20',
                                    'confirmed' => 'bg-blue-500/10 text-blue-400 border-blue-500/20',
                                    'cancelled' => 'bg-red-500/10 text-red-400 border-red-500/20',
                                    'completed' => 'bg-green-500/10 text-green-400 border-green-500/20',
                                    ];
                                    @endphp

                                    <span class="px-3 py-1 text-xs rounded-full border {{ $statusClasses[$reservation->status] ?? 'bg-gray-500/10 text-gray-400' }}">
                                        {{ $reservation->status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-3 items-center flex-wrap">

                                        <form action="{{ route('reservations.restore', $reservation->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="w-8 h-8 rounded-full bg-green-500/10 flex items-center justify-center text-green-400 hover:bg-green-500 hover:text-white transition" title="استعادة الحجز">
                                                <i class="fas fa-undo text-xs"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-8 h-8 rounded-full bg-red-500/10 flex items-center justify-center text-red-400 hover:bg-red-500 hover:text-white transition"
                                                title="حذف نهائي"
                                                onclick="return confirm('هل أنت متأكد من الحذف النهائي لهذا الحجز؟ لا يمكن التراجع عن هذا الإجراء.')">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-10 text-gray-500">
                                    لا توجد حجوزات مؤرشفة حالياً
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="p-4 border-t border-[#1a1a1a] text-gray-400 text-sm flex justify-between items-center bg-[#0a0a0a]">
                    <span>
                        عرض {{ $reservations->firstItem() ?? 0 }} إلى {{ $reservations->lastItem() ?? 0 }} من إجمالي {{ $reservations->total() }}
                    </span>
                    {{ $reservations->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
