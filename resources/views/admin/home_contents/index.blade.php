<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('إدارة المحتوى الرئيسي') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 rounded-lg p-4 text-center">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-[#111] border border-[#1a1a1a] rounded-2xl overflow-hidden shadow-2xl">

                <div class="flex border-b border-[#1a1a1a] bg-[#0a0a0a]">
                    <button type="button" onclick="openTab(event, 'hero')" id="btn-hero" class="px-6 py-4 text-sm font-medium text-white border-b-2 border-[#E60914] focus:outline-none">
                        القسم العلوي (Hero Section)
                    </button>
                    <button type="button" onclick="openTab(event, 'about')" id="btn-about" class="px-6 py-4 text-sm font-medium text-gray-400 border-b-2 border-transparent hover:text-white focus:outline-none">
                        من نحن (About Section)
                    </button>
                </div>

                <!-- النموذج -->
                <form action="{{ route('admin.home-contents.update', $content->id) }}" method="POST" class="p-8">
                    @csrf
                    <!-- تبويب Hero -->
                    <div id="hero" class="tab-content block">
                        <h3 class="text-xl font-bold text-white mb-6">نصوص البانر الرئيسي</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- العنوان الرئيسي -->
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">العنوان الرئيسي (إنجليزي)</label>
                                <input type="text" name="hero_title_en" value="{{ old('hero_title_en', $content->hero_title_en) }}"
                                    class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]">
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">العنوان الرئيسي (عربي)</label>
                                <input type="text" name="hero_title_ar" value="{{ old('hero_title_ar', $content->hero_title_ar) }}"
                                    class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]" dir="rtl">
                            </div>

                            <!-- العنوان الفرعي -->
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">العنوان الفرعي / الوصف المختصر (إنجليزي)</label>
                                <input type="text" name="hero_subtitle_en" value="{{ old('hero_subtitle_en', $content->hero_subtitle_en) }}"
                                    class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]">
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">العنوان الفرعي / الوصف المختصر (عربي)</label>
                                <input type="text" name="hero_subtitle_ar" value="{{ old('hero_subtitle_ar', $content->hero_subtitle_ar) }}"
                                    class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]" dir="rtl">
                            </div>
                        </div>
                    </div>

                    <!-- تبويب About -->
                    <div id="about" class="tab-content hidden">
                        <h3 class="text-xl font-bold text-white mb-6">قصة المطعم (About Us)</h3>

                        <div class="space-y-6">
                            <!-- عنوان القسم -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">عنوان القسم (إنجليزي)</label>
                                    <input type="text" name="about_title_en" value="{{ old('about_title_en', $content->about_title_en) }}"
                                        class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]">
                                </div>
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">عنوان القسم (عربي)</label>
                                    <input type="text" name="about_title_ar" value="{{ old('about_title_ar', $content->about_title_ar) }}"
                                        class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]" dir="rtl">
                                </div>
                            </div>

                            <!-- نص القصة -->
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">وصف القصة (إنجليزي)</label>
                                <textarea name="about_desc_en" rows="5"
                                    class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]">{{ old('about_desc_en', $content->about_desc_en) }}</textarea>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">وصف القصة (عربي)</label>
                                <textarea name="about_desc_ar" rows="5"
                                    class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]" dir="rtl">{{ old('about_desc_ar', $content->about_desc_ar) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- زر الحفظ -->
                    <div class="mt-8 pt-6 border-t border-[#1a1a1a] flex justify-end">
                        <button type="submit" class="bg-[#E60914] hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg transition shadow-lg shadow-red-900/20">
                            حفظ المحتوى
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- كود التبويبات -->
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
                tabcontent[i].classList.remove("block");
                tabcontent[i].classList.add("hidden");
            }

            tablinks = document.querySelectorAll("button[onclick^='openTab']");
            tablinks.forEach(function(btn) {
                btn.classList.remove("border-[#E60914]", "text-white", "bg-[#0a0a0a]");
                btn.classList.add("border-transparent", "text-gray-400");
            });

            document.getElementById(tabName).style.display = "block";
            document.getElementById(tabName).classList.remove("hidden");
            document.getElementById(tabName).classList.add("block");

            evt.currentTarget.classList.remove("border-transparent", "text-gray-400");
            evt.currentTarget.classList.add("border-[#E60914]", "text-white", "bg-[#0a0a0a]");
        }

        document.getElementById("btn-hero").click();
    </script>
</x-app-layout>
