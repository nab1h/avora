<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('تعديل الإحصائية') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-[#111] border border-[#1a1a1a] rounded-2xl overflow-hidden shadow-2xl p-8">
                <!-- ملاحظة: تم تغيير الـ action ليشير إلى رابط التحديث مع معرف العنصر -->
                <form action="{{ route('admin.statistics.update', $stat->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- مهم جداً: تحديد طريقة التحديث -->

                    <!-- عرض الأخطاء إن وجدت -->
                    @if ($errors->any())
                    <div class="mb-6 bg-red-500/10 border border-red-500/20 text-red-400 rounded-lg p-4">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- حقل الرقم -->
                    <div class="mb-6">
                        <label class="block text-gray-400 text-sm mb-2">الرقم (مثال: 500+)</label>
                        <!-- ملاحظة: القيمة الافتراضية تأتي من قاعدة البيانات ($stat->number) -->
                        <input type="text" name="number" value="{{ old('number', $stat->number) }}"
                            class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]"
                            placeholder="أدخل الرقم أو القيمة" required autofocus>
                        @error('number') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- حقل العنوان بالعربية -->
                    <div class="mb-6">
                        <label class="block text-gray-400 text-sm mb-2">العنوان بالعربية</label>
                        <input type="text" name="title_ar" value="{{ old('title_ar', $stat->title_ar) }}"
                            class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]"
                            dir="rtl" placeholder="مثال: سنة خبرة" required>
                        @error('title_ar') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- حقل العنوان بالإنجليزية -->
                    <div class="mb-6">
                        <label class="block text-gray-400 text-sm mb-2">العنوان بالإنجليزية</label>
                        <input type="text" name="title_en" value="{{ old('title_en', $stat->title_en) }}"
                            class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]"
                            dir="ltr" placeholder="Example: Years of Experience" required>
                        @error('title_en') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- حقل الترتيب (اختياري) -->
                    <div class="mb-8">
                        <label class="block text-gray-400 text-sm mb-2">الترتيب (للعرض)</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', $stat->sort_order) }}"
                            class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]">
                    </div>

                    <!-- أزرار التحكم -->
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('admin.statistics.index') }}" class="text-gray-400 hover:text-white px-4 py-2 transition">
                            إلغاء
                        </a>
                        <button type="submit" class="bg-[#E60914] hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg transition shadow-lg shadow-red-900/20">
                            حفظ التعديلات
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
