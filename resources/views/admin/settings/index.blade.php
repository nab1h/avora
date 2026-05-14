<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('إعدادات النظام') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 rounded-lg p-4 text-center">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-[#111] border border-[#1a1a1a] rounded-2xl overflow-hidden shadow-2xl">

                <div class="flex border-b border-[#1a1a1a] bg-[#0a0a0a]">
                    <button type="button" onclick="openTab(event, 'general')" id="btn-general" class="px-6 py-4 text-sm font-medium text-white border-b-2 border-[#E60914] focus:outline-none">
                        عام (General)
                    </button>
                    <button type="button" onclick="openTab(event, 'contact')" id="btn-contact" class="px-6 py-4 text-sm font-medium text-gray-400 border-b-2 border-transparent hover:text-white focus:outline-none">
                        التواصل (Contact)
                    </button>
                    <button type="button" onclick="openTab(event, 'social')" id="btn-social" class="px-6 py-4 text-sm font-medium text-gray-400 border-b-2 border-transparent hover:text-white focus:outline-none">
                        السوشيال ميديا (Social)
                    </button>
                </div>

                <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf

                    <!-- تبويب عام -->
                    <div id="general" class="tab-content block">
                        <h3 class="text-xl font-bold text-white mb-6">معلومات الموقع الأساسية</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">اسم الموقع (Site Name)</label>
                                <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name) }}"
                                    class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]">
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">عنوان الصفحة (Title Tag)</label>
                                <input type="text" name="site_title" value="{{ old('site_title', $setting->site_title) }}"
                                    class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="block text-gray-400 text-sm mb-2">وصف الميتا (SEO Description)</label>
                            <textarea name="meta_description" rows="3"
                                class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]">{{ old('meta_description', $setting->meta_description) }}</textarea>
                        </div>

                        <hr class="border-[#1a1a1a] my-6">

                        <!-- استبدل قسم الصور والأيقونات القديم بهذا الكود كاملاً -->

                        <hr class="border-[#1a1a1a] my-6">
                        <h3 class="text-xl font-bold text-white mb-4">الصور والأيقونات</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                            <!-- Logo -->
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">اللوجو (Logo)</label>

                                <!-- Custom Upload Box -->
                                <div class="relative w-full border-2 border-dashed border-[#1a1a1a] rounded-xl h-32 flex items-center justify-center hover:border-[#E60914] transition bg-[#0a0a0a] cursor-pointer group">

                                    @if($setting->logo)
                                    <img src="{{ asset('storage/' . $setting->logo) }}" class="h-full w-full object-contain p-2 rounded-lg" alt="Logo">
                                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                        <span class="text-white text-xs border border-white px-2 py-1 rounded">تغيير الصورة</span>
                                    </div>
                                    @else
                                    <div class="text-center">
                                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-600 mb-2 group-hover:text-[#E60914] transition"></i>
                                        <p class="text-xs text-gray-500">اضغط لرفع اللوجو</p>
                                    </div>
                                    @endif

                                    <!-- الحقل الحقيقي مخفي ومغطي للمنطقة بالكامل -->
                                    <input type="file" name="logo" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="this.parentElement.querySelector('img') ? this.parentElement.querySelector('img').src = URL.createObjectURL(this.files[0]) : null">
                                </div>
                            </div>

                            <!-- Icon 180 -->
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">أيقونة (180x180)</label>

                                <div class="relative w-full border-2 border-dashed border-[#1a1a1a] rounded-xl h-32 flex items-center justify-center hover:border-[#E60914] transition bg-[#0a0a0a] cursor-pointer group">

                                    @if($setting->icon_180)
                                    <img src="{{ asset('storage/' . $setting->icon_180) }}" class="h-full w-full object-contain p-2 rounded-lg" alt="Icon">
                                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                        <span class="text-white text-xs border border-white px-2 py-1 rounded">تغيير</span>
                                    </div>
                                    @else
                                    <div class="text-center">
                                        <i class="fas fa-image text-3xl text-gray-600 mb-2 group-hover:text-[#E60914] transition"></i>
                                        <p class="text-xs text-gray-500">رفع أيقونة</p>
                                    </div>
                                    @endif

                                    <input type="file" name="icon_180" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                </div>
                            </div>

                            <!-- Icon 32 -->
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">أيقونة (32x32)</label>

                                <div class="relative w-full border-2 border-dashed border-[#1a1a1a] rounded-xl h-24 flex items-center justify-center hover:border-[#E60914] transition bg-[#0a0a0a] cursor-pointer group">
                                    @if($setting->icon_32)
                                    <img src="{{ asset('storage/' . $setting->icon_32) }}" class="h-12 w-12 object-contain" alt="Icon">
                                    @else
                                    <div class="text-center">
                                        <i class="fas fa-icons text-2xl text-gray-600 group-hover:text-[#E60914] transition"></i>
                                    </div>
                                    @endif
                                    <input type="file" name="icon_32" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                </div>
                            </div>

                            <!-- Icon 16 -->
                            <div>
                                <label class="block text-gray-400 text-sm mb-2">أيقونة (16x16)</label>

                                <div class="relative w-full border-2 border-dashed border-[#1a1a1a] rounded-xl h-24 flex items-center justify-center hover:border-[#E60914] transition bg-[#0a0a0a] cursor-pointer group">
                                    @if($setting->icon_16)
                                    <img src="{{ asset('storage/' . $setting->icon_16) }}" class="h-12 w-12 object-contain" alt="Icon">
                                    @else
                                    <div class="text-center">
                                        <i class="fas fa-icons text-2xl text-gray-600 group-hover:text-[#E60914] transition"></i>
                                    </div>
                                    @endif
                                    <input type="file" name="icon_16" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                </div>
                            </div>

                            <!-- Manifest -->
                            <div class="md:col-span-2 lg:col-span-1">
                                <label class="block text-gray-400 text-sm mb-2">ملف Manifest (.json)</label>

                                <div class="relative w-full border-2 border-dashed border-[#1a1a1a] rounded-xl h-24 flex items-center justify-center hover:border-[#E60914] transition bg-[#0a0a0a] cursor-pointer group">
                                    @if($setting->manifest)
                                    <div class="text-center">
                                        <i class="fas fa-file-code text-2xl text-purple-500 mb-1"></i>
                                        <p class="text-xs text-white truncate max-w-[200px]">{{ basename($setting->manifest) }}</p>
                                    </div>
                                    @else
                                    <div class="text-center">
                                        <i class="fas fa-file-code text-2xl text-gray-600 group-hover:text-purple-500 transition"></i>
                                        <p class="text-xs text-gray-500">رفع Manifest</p>
                                    </div>
                                    @endif
                                    <input type="file" name="manifest" accept=".json" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- تبويب التواصل -->
                    <div id="contact" class="tab-content hidden">
                        <h3 class="text-xl font-bold text-white mb-6">بيانات التواصل</h3>

                        <div class="space-y-6">

                            <!-- العنوان باللغتين -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">العنوان (إنجليزي)</label>
                                    <input type="text" name="address_en" value="{{ old('address_en', $setting->address_en) }}"
                                        class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]">
                                </div>
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">العنوان (عربي)</label>
                                    <input type="text" name="address_ar" value="{{ old('address_ar', $setting->address_ar) }}"
                                        class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]" dir="rtl">
                                </div>
                            </div>

                            <!-- المواعيد باللغتين -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">أوقات العمل (إنجليزي)</label>
                                    <input type="text" name="hours_en" value="{{ old('hours_en', $setting->hours_en) }}"
                                        placeholder="Daily: 6:00 PM - 11:30 PM"
                                        class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]">
                                </div>
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">أوقات العمل (عربي)</label>
                                    <input type="text" name="hours_ar" value="{{ old('hours_ar', $setting->hours_ar) }}"
                                        placeholder="يومياً: 6:00 مساءً - 11:30 مساءً"
                                        class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]" dir="rtl">
                                </div>
                            </div>

                            <hr class="border-[#1a1a1a] my-4">

                            <!-- أرقام التواصل والخريطة -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <!-- رقم الموبايل -->
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">رقم الموبايل</label>
                                    <input type="text" name="mobile" value="{{ old('mobile', $setting->mobile) }}"
                                        class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]">
                                </div>

                                <!-- رقم الواتساب -->
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">رقم الواتساب</label>
                                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $setting->whatsapp) }}"
                                        placeholder="9665xxxxxxxx"
                                        class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]">
                                </div>

                                <!-- الايميل -->
                                <div>
                                    <label class="block text-gray-400 text-sm mb-2">البريد الإلكتروني</label>
                                    <input type="email" name="email" value="{{ old('email', $setting->email) }}"
                                        class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914]">
                                </div>

                                <!-- رابط الخريطة (يأخذ كامل العرض) -->
                                <div class="md:col-span-2">
                                    <label class="block text-gray-400 text-sm mb-2">كود خريطة جوجل (Iframe Embed Code)</label>
                                    <textarea name="map_link" rows="3"
                                        class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914] text-sm font-mono">{{ old('map_link', $setting->map_link) }}</textarea>
                                    <p class="text-xs text-gray-600 mt-1">انسخ كود الـ Embed من Google Maps وضعه هنا.</p>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- تبويب السوشيال ميديا -->
                    <div id="social" class="tab-content hidden">
                        <h3 class="text-xl font-bold text-white mb-6">روابط السوشيال ميديا</h3>
                        <p class="text-gray-500 text-sm mb-6">اترك الحقل فارغاً إذا كنت لا تريد عرض الرابط.</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Facebook -->
                            <div class="flex items-center gap-4 bg-[#0a0a0a] p-3 rounded-lg border border-[#1a1a1a]">
                                <div class="w-10 h-10 rounded bg-blue-600 flex items-center justify-center text-white shrink-0">
                                    <i class="fab fa-facebook-f"></i>
                                </div>
                                <input type="url" name="facebook" value="{{ old('facebook', $setting->facebook) }}" placeholder="https://facebook.com/..."
                                    class="flex-1 bg-transparent border-none text-white focus:ring-0 placeholder-gray-600">
                            </div>

                            <!-- Twitter -->
                            <div class="flex items-center gap-4 bg-[#0a0a0a] p-3 rounded-lg border border-[#1a1a1a]">
                                <div class="w-10 h-10 rounded bg-sky-500 flex items-center justify-center text-white shrink-0">
                                    <i class="fab fa-twitter"></i>
                                </div>
                                <input type="url" name="twitter" value="{{ old('twitter', $setting->twitter) }}" placeholder="https://twitter.com/..."
                                    class="flex-1 bg-transparent border-none text-white focus:ring-0 placeholder-gray-600">
                            </div>

                            <!-- Instagram -->
                            <div class="flex items-center gap-4 bg-[#0a0a0a] p-3 rounded-lg border border-[#1a1a1a]">
                                <div class="w-10 h-10 rounded bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 flex items-center justify-center text-white shrink-0">
                                    <i class="fab fa-instagram"></i>
                                </div>
                                <input type="url" name="instagram" value="{{ old('instagram', $setting->instagram) }}" placeholder="https://instagram.com/..."
                                    class="flex-1 bg-transparent border-none text-white focus:ring-0 placeholder-gray-600">
                            </div>

                            <!-- Snapchat -->
                            <div class="flex items-center gap-4 bg-[#0a0a0a] p-3 rounded-lg border border-[#1a1a1a]">
                                <div class="w-10 h-10 rounded bg-yellow-500 flex items-center justify-center text-white shrink-0">
                                    <i class="fab fa-snapchat-ghost"></i>
                                </div>
                                <input type="url" name="snapchat" value="{{ old('snapchat', $setting->snapchat) }}" placeholder="https://snapchat.com/..."
                                    class="flex-1 bg-transparent border-none text-white focus:ring-0 placeholder-gray-600">
                            </div>

                            <!-- TikTok -->
                            <div class="flex items-center gap-4 bg-[#0a0a0a] p-3 rounded-lg border border-[#1a1a1a] md:col-span-2">
                                <div class="w-10 h-10 rounded bg-black flex items-center justify-center text-white shrink-0 border border-gray-700">
                                    <i class="fab fa-tiktok"></i>
                                </div>
                                <input type="url" name="tiktok" value="{{ old('tiktok', $setting->tiktok) }}" placeholder="https://tiktok.com/..."
                                    class="flex-1 bg-transparent border-none text-white focus:ring-0 placeholder-gray-600">
                            </div>

                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-[#1a1a1a] flex justify-end">
                        <button type="submit" class="bg-[#E60914] hover:bg-red-700 text-white font-bold py-3 px-8 rounded-lg transition shadow-lg shadow-red-900/20">
                            حفظ التغييرات
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.querySelectorAll("button[onclick^='openTab']");
            tablinks.forEach(function(btn) {
                btn.classList.remove("border-[#E60914]", "text-white");
                btn.classList.add("border-transparent", "text-gray-400");
            });

            document.getElementById(tabName).style.display = "block";

            evt.currentTarget.classList.remove("border-transparent", "text-gray-400");
            evt.currentTarget.classList.add("border-[#E60914]", "text-white");
        }
    </script>
</x-app-layout>
