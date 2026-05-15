<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('إدارة الأسئلة الشائعة') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 rounded-lg p-4 text-sm flex items-center gap-2">
                <i class="fas fa-check-circle"></i> {{ session('status') }}
            </div>
            @endif

            <!-- Header Actions -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h3 class="text-2xl font-bold text-white">قائمة الأسئلة الشائعة</h3>
                    <p class="text-gray-400 text-sm mt-1">إدارة الأسئلة والإجابات المتعلقة بالمطعم.</p>
                </div>

                <a href="{{ route('admin.faqs.create') }}">
                    <button class="px-5 py-2.5 bg-[#E60914] hover:bg-red-700 text-white rounded-lg transition flex items-center gap-2 shadow-lg shadow-red-900/20">
                        <i class="fas fa-plus"></i> إضافة سؤال
                    </button>
                </a>
            </div>

            <!-- Table -->
            <div class="bg-[#111] border border-[#1a1a1a] rounded-2xl overflow-hidden shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-gray-300">
                        <thead class="bg-[#0a0a0a] text-gray-500 text-xs uppercase">
                            <tr>
                                <th class="px-6 py-4">#ID</th>
                                <th class="px-6 py-4">السؤال</th>
                                <th class="px-6 py-4">الحالة</th>
                                <th class="px-6 py-4 text-center">الترتيب</th>
                                <th class="px-6 py-4 text-center">إجراءات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($faqs as $faq)
                            <tr class="border-b border-[#1a1a1a] hover:bg-[#141414] transition duration-200">

                                <td class="px-6 py-4 font-mono text-xs text-gray-500">#{{ $faq->id }}</td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-white font-medium mb-1">{{ Str::limit($faq->question_en, 50) }}...</span>
                                        <span class="text-xs text-gray-500 truncate" dir="rtl">{{ $faq->question_ar }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    @if($faq->is_active)
                                    <span class="px-3 py-1 text-xs rounded-full border border-green-500/20 bg-green-500/10 text-green-400">
                                        نشط
                                    </span>
                                    @else
                                    <span class="px-3 py-1 text-xs rounded-full border border-red-500/20 bg-red-500/10 text-red-400">
                                        مخفي
                                    </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <span class="bg-[#1a1a1a] px-2 py-1 rounded text-xs text-gray-400">
                                        {{ $faq->order_column }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-3 items-center">

                                        <!-- Edit -->
                                        <a href="{{ route('admin.faqs.edit', $faq) }}"
                                            class="w-8 h-8 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400 hover:bg-blue-500 hover:text-white transition">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-8 h-8 rounded-full bg-red-500/10 flex items-center justify-center text-red-400 hover:bg-red-500 hover:text-white transition"
                                                onclick="return confirm('هل أنت متأكد من حذف هذا السؤال؟')">
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-gray-500">
                                    لا توجد أسئلة حالياً.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
