<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('تعديل السؤال') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-[#111] border border-[#1a1a1a] rounded-2xl p-8 shadow-2xl">
                <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Title Section -->
                    <div class="mb-8 border-b border-[#1a1a1a] pb-6">
                        <h3 class="text-2xl font-bold text-white mb-2">تعديل تفاصيل السؤال</h3>
                        <p class="text-gray-400 text-sm">قم بتعديل السؤال والإجابة أو حالة الظهور.</p>
                    </div>

                    <!-- Questions Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">السؤال (إنجليزي)</label>
                            <input type="text" name="question_en" required
                                value="{{ old('question_en', $faq->question_en) }}"
                                placeholder="مثال: What are your opening hours?"
                                class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914] transition placeholder-gray-600">
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">السؤال (عربي)</label>
                            <input type="text" name="question_ar" required
                                value="{{ old('question_ar', $faq->question_ar) }}"
                                placeholder="مثال: ما هي ساعات العمل؟"
                                class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914] transition placeholder-gray-600" dir="rtl">
                        </div>
                    </div>

                    <!-- Answers Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">الإجابة (إنجليزي)</label>
                            <textarea name="answer_en" rows="5" required
                                class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914] transition placeholder-gray-600 resize-y">{{ old('answer_en', $faq->answer_en) }}</textarea>
                        </div>
                        <div>
                            <label class="block text-gray-400 text-sm mb-2">الإجابة (عربي)</label>
                            <textarea name="answer_ar" rows="5" required
                                class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914] transition placeholder-gray-600 resize-y" dir="rtl">{{ old('answer_ar', $faq->answer_ar) }}</textarea>
                        </div>
                    </div>

                    <!-- Settings Section -->
                    <div class="bg-[#0a0a0a] p-6 rounded-xl border border-[#1a1a1a] mb-8">
                        <h4 class="text-lg font-bold text-white mb-4">إعدادات العرض</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">الترتيب (Order)</label>
                                <input type="number" name="order_column" value="{{ $faq->order_column }}"
                                    class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded px-3 py-2 text-white focus:outline-none focus:border-gray-600">
                                <p class="text-xs text-gray-500 mt-1">رقم لترتيب ظهور السؤال في الموقع</p>
                            </div>

                            <div class="flex items-center mt-6 pt-2 md:pt-0">
                                <input type="checkbox" name="is_active" value="1" {{ $faq->is_active ? 'checked' : '' }}
                                    class="w-5 h-5 accent-[#E60914] border-gray-600 bg-gray-800 rounded">
                                <label class="text-gray-300 ml-3 text-sm">نشط (مظهر في الموقع)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-[#E60914] hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg transition shadow-lg shadow-red-900/20 flex items-center gap-2">
                            <i class="fas fa-save"></i> حفظ التغييرات
                        </button>
                        <a href="{{ route('admin.faqs.index') }}" class="text-gray-400 hover:text-white transition">
                            إلغاء
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
