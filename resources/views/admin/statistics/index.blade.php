<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('إدارة الإحصائيات') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 rounded-lg p-4 text-center">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-[#111] border border-[#1a1a1a] rounded-xl overflow-hidden shadow-2xl p-6">

                <!-- زر إضافة جديد -->
                <div class="flex justify-end mb-6">
                    <a href="{{ route('admin.statistics.create') }}" class="bg-[#E60914] hover:bg-red-700 text-white px-6 py-2 rounded-lg text-sm font-bold transition">
                        <i class="fas fa-plus ml-2"></i> إضافة إحصائية
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse stats-table">
                        <thead>
                            <tr>
                                <th class="p-4 text-gray-500 text-sm uppercase tracking-wider text-center">#</th>
                                <th class="p-4 text-gray-500 text-sm uppercase tracking-wider">الرقم</th>
                                <th class="p-4 text-gray-500 text-sm uppercase tracking-wider">العنوان (عربي)</th>
                                <th class="p-4 text-gray-500 text-sm uppercase tracking-wider text-left">العنوان (إنجليزي)</th>
                                <th class="p-4 text-gray-500 text-sm uppercase tracking-wider text-center">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#1a1a1a]">
                            @forelse($stats as $index => $item)
                            <tr class="hover:bg-[#1a1a1a] transition duration-200 group">
                                <!-- الترتيب -->
                                <td class="p-4 text-center text-gray-600 font-mono">
                                    {{ $index + 1 }}
                                </td>

                                <!-- الرقم -->
                                <td class="p-4 text-center border-l border-[#222]">
                                    <span class="text-2xl font-serif text-[#D4AF37] font-bold">
                                        {{ $item->number }}
                                    </span>
                                </td>

                                <!-- العنوان العربي -->
                                <td class="p-4">
                                    <span class="text-white font-medium text-lg">
                                        {{ $item->title_ar }}
                                    </span>
                                </td>

                                <!-- العنوان الإنجليزي -->
                                <td class="p-4 text-left dir-ltr" dir="ltr">
                                    <span class="text-gray-400 text-sm">
                                        {{ $item->title_en }}
                                    </span>
                                </td>

                                <!-- الأزرار -->
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center gap-3 opacity-100 lg:opacity-0 group-hover:opacity-100 transition">
                                        <a href="{{ route('admin.statistics.edit', $item->id) }}" class="text-gray-400 hover:text-[#D4AF37] transition">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.statistics.destroy', $item->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-400 hover:text-red-500 transition">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500 border-0">
                                    لا توجد إحصائيات مضافة حالياً.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .stats-table th {
            border-bottom: 1px solid #333;
            padding-bottom: 15px;
        }

        .stats-table td {
            padding-top: 20px;
            padding-bottom: 20px;
            vertical-align: middle;
        }

        .dir-ltr {
            direction: ltr;
            text-align: left;
        }
    </style>
</x-app-layout>
