<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('إدارة الوسائط') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('status'))
            <div class="mb-6 bg-green-500/10 border border-green-500/20 text-green-400 rounded-lg p-4 text-center">
                {{ session('status') }}
            </div>
            @endif

            <div class="bg-[#111] border border-[#1a1a1a] rounded-2xl overflow-hidden shadow-2xl min-h-[600px]">

                <!-- Tabs Header -->
                <div class="flex border-b border-[#1a1a1a] bg-[#0a0a0a]">
                    <button onclick="openMediaTab(event, 'hero-video')" id="btn-hero-video" class="px-6 py-4 text-sm font-medium text-white border-b-2 border-[#E60914] bg-[#0a0a0a] focus:outline-none transition">
                        فيديو البانر
                    </button>
                    <button onclick="openMediaTab(event, 'hero-image')" id="btn-hero-image" class="px-6 py-4 text-sm font-medium text-gray-400 border-b-2 border-transparent hover:text-white focus:outline-none transition">
                        صورة البديل
                    </button>
                    <button onclick="openMediaTab(event, 'gallery')" id="btn-gallery" class="px-6 py-4 text-sm font-medium text-gray-400 border-b-2 border-transparent hover:text-white focus:outline-none transition">
                        معرض الصور
                    </button>
                </div>

                <div class="p-8">

                    <div id="hero-video" class="tab-content block animate-fade">
                        <h3 class="text-xl font-bold text-white mb-6">فيديو الخلفية</h3>
                        <p class="text-gray-400 text-sm mb-6">قم برفع فيديو ليظهر كخلفية للبطل.</p>

                        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="border-2 border-dashed border-[#1a1a1a] rounded-xl p-10 text-center hover:border-[#E60914] transition bg-[#0a0a0a]">
                            @csrf
                            <input type="hidden" name="type" value="hero_video">

                            @if($heroVideo)
                            <div class="mb-4">
                                <video src="{{ asset('storage/' . $heroVideo->path) }}" class="w-full h-48 object-cover rounded-lg" controls></video>
                            </div>
                            @endif

                            <input type="file" name="file" accept="video/mp4,video/webm" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#E60914] file:text-white hover:file:bg-red-700 mb-4 cursor-pointer">
                            <button type="submit" class="mt-4 bg-white text-black px-6 py-2 rounded font-bold hover:bg-gray-200 transition">حفظ / تحديث الفيديو</button>
                        </form>
                    </div>

                    <div id="hero-image" class="tab-content hidden animate-fade">
                        <h3 class="text-xl font-bold text-white mb-6">صورة البديل</h3>
                        <p class="text-gray-400 text-sm mb-6">صورة تظهر إذا لم يتم تحميل الفيديو.</p>

                        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="border-2 border-dashed border-[#1a1a1a] rounded-xl p-10 text-center hover:border-[#E60914] transition bg-[#0a0a0a]">
                            @csrf
                            <input type="hidden" name="type" value="hero_image">

                            @if($heroImage)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $heroImage->path) }}" class="max-h-48 mx-auto rounded-lg shadow-lg">
                            </div>
                            @endif

                            <input type="file" name="file" accept="image/*" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 mb-4 cursor-pointer">
                            <button type="submit" class="mt-4 bg-white text-black px-6 py-2 rounded font-bold hover:bg-gray-200 transition">حفظ / تحديث الصورة</button>
                        </form>
                    </div>

                    <div id="gallery" class="tab-content hidden animate-fade">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-white">معرض الصور</h3>

                            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="flex gap-4 items-end">
                                @csrf
                                <input type="hidden" name="type" value="gallery_image">
                                <input type="text" name="title" placeholder="وصف الصورة (اختياري)" class="bg-[#0a0a0a] border border-[#1a1a1a] rounded px-4 py-2 text-white text-sm focus:outline-none focus:border-[#E60914]">
                                <input type="file" name="file" accept="image/*" class="block text-sm text-gray-400 file:mr-4 file:py-2 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-600 file:text-white hover:file:bg-purple-700">
                                <button type="submit" class="px-4 py-2 bg-[#E60914] text-white text-xs rounded font-bold hover:bg-red-700 transition">إضافة صورة</button>
                            </form>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @forelse($galleryImages as $image)
                            <div class="group relative rounded-xl overflow-hidden border border-[#1a1a1a] bg-[#0a0a0a]">
                                <img src="{{ asset('storage/' . $image->path) }}" class="w-full h-40 object-cover">
                                <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                                    <form action="{{ route('admin.media.destroy', $image) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button title="حذف" onclick="return confirm('حذف هذه الصورة؟')" class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 transition">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="absolute top-2 left-2 bg-black/70 text-white text-xs px-2 py-1 rounded">{{ $image->order_column }}</div>
                            </div>
                            @empty
                            <div class="col-span-full py-10 text-center border-2 border-dashed border-[#1a1a1a] rounded-xl text-gray-600">
                                لا توجد صور في المعرض
                            </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script>
        function openMediaTab(evt, tabName) {
            var i, tabcontent, tablinks;

            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
                tabcontent[i].classList.remove("block");
                tabcontent[i].classList.add("hidden");
            }

            tablinks = document.querySelectorAll("button[onclick^='openMediaTab']");
            tablinks.forEach(function(btn) {
                btn.classList.remove("border-[#E60914]", "text-white", "bg-[#0a0a0a]");
                btn.classList.add("border-transparent", "text-gray-400");
            });

            var targetTab = document.getElementById(tabName);
            targetTab.style.display = "block";
            targetTab.classList.remove("hidden");
            targetTab.classList.add("block");

            evt.currentTarget.classList.remove("border-transparent", "text-gray-400");
            evt.currentTarget.classList.add("border-[#E60914]", "text-white", "bg-[#0a0a0a]");
        }
    </script>
</x-app-layout>
