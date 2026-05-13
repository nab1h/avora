<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Profile Card') }}
        </h2>
    </x-slot>

    <!-- Form Tag Wrapper -->
    <form action="{{ route('profile.update.data') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="py-8">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <!-- 1. Profile Header Section -->
                <div class="bg-[#111111] border border-[#1a1a1a] rounded-2xl p-6">
                    <h3 class="text-lg font-bold text-white mb-6 border-b border-[#1a1a1a] pb-3">المعلومات الأساسية</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Profile Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">الصورة الشخصية</label>
                            <div class="flex items-center gap-4">
                                <img src=""
                                    class="w-16 h-16 rounded-full object-cover border-2 border-[#1a1a1a]">
                                <input type="file" name="img" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#E60914]/10 file:text-[#E60914] hover:file:bg-[#E60914]/20 cursor-pointer">
                            </div>
                        </div>

                        <!-- Cover Image -->
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">صورة الغلاف</label>

                            <input type="file" name="img_cover" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#E60914]/10 file:text-[#E60914] hover:file:bg-[#E60914]/20 cursor-pointer">

                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">الاسم الكامل</label>
                            <input type="text" name="name" value="" class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:border-[#E60914] focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">المسمى الوظيفي</label>
                            <input type="text" name="job" value="" class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:border-[#E60914] focus:outline-none transition">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">البايو (نبذة)</label>
                        <textarea name="bio" rows="3" class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:border-[#E60914] focus:outline-none transition resize-none"></textarea>
                    </div>
                </div>

                <!-- 2. Contact Info Section -->
                <div class="bg-[#111111] border border-[#1a1a1a] rounded-2xl p-6">
                    <h3 class="text-lg font-bold text-white mb-6 border-b border-[#1a1a1a] pb-3">معلومات الاتصال</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">رقم الهاتف</label>
                            <input type="tel" name="phone" value="" class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:border-[#E60914] focus:outline-none transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">رقم الواتساب</label>
                            <input type="text" name="whatsapp" value="" class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:border-[#E60914] focus:outline-none transition">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-2">البريد الإلكتروني</label>
                            <input type="email" name="email" value="" class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:border-[#E60914] focus:outline-none transition">
                        </div>
                    </div>
                </div>

                <!-- 3. Social Media Section (Dynamic) -->
                <div class="bg-[#111111] border border-[#1a1a1a] rounded-2xl p-6">
                    <h3 class="text-lg font-bold text-white mb-6 border-b border-[#1a1a1a] pb-3">حسابات التواصل الاجتماعي</h3>


    </form>
</x-app-layout>
