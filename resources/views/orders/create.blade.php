<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Create Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <!-- Display Errors -->
            @if ($errors->any())
            <div class="mb-4 bg-red-500/10 border border-red-500/20 text-red-400 rounded-lg p-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-[#111111] border border-[#1a1a1a] rounded-2xl shadow-2xl p-8">

                <!-- Header -->
                <div class="mb-8 border-b border-[#1a1a1a] pb-4">
                    <h3 class="text-2xl font-bold text-white">إضافة طلب جديد</h3>
                    <p class="text-gray-400 text-sm mt-1">أدخل بيانات العميل والطلب أدناه.</p>
                </div>

                <!-- Form Start -->
                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Customer Name -> name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">اسم العميل</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="الاسم الكامل" required
                                class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-[#E60914] focus:ring-1 focus:ring-[#E60914] transition">
                        </div>

                        <!-- Phone Number -> phone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">رقم الهاتف</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+966 5XX XXX XXXX" required
                                class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-[#E60914] focus:ring-1 focus:ring-[#E60914] transition">
                        </div>

                        <!-- Whatsup Number -> whatsup -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">رقم الواتساب</label>
                            <input type="tel" name="whatsup" value="{{ old('whatsup') }}" placeholder="+966 5XX XXX XXXX"
                                class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-[#E60914] focus:ring-1 focus:ring-[#E60914] transition">
                        </div>

                        <!-- Email -> email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">البريد الإلكتروني</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com"
                                class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-[#E60914] focus:ring-1 focus:ring-[#E60914] transition">
                        </div>

                        <!-- Order Status -> status -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300 mb-2">حالة الطلب</label>
                            <div class="relative">
                                <select name="status" required
                                    class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white appearance-none focus:outline-none focus:border-[#E60914] focus:ring-1 focus:ring-[#E60914] transition">
                                    <option value="preparation" {{ old('status') == 'preparation' ? 'selected' : '' }}>قيد التجهيز</option>
                                    <option value="shipping" {{ old('status') == 'shipping' ? 'selected' : '' }}>في الشحن</option>
                                    <option value="delivered" {{ old('status') == 'delivered' ? 'selected' : '' }}>تم التسليم</option>
                                </select>
                                <div class="absolute inset-y-0 left-0 flex items-center px-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address -> address -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">العنوان الكامل</label>
                        <textarea name="address" rows="3" placeholder="المدينة، الحي، الشارع، رقم المبنى..." required
                            class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-[#E60914] focus:ring-1 focus:ring-[#E60914] transition resize-none">{{ old('address') }}</textarea>
                    </div>

                    <!-- Notes -> msg -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">ملاحظات إضافية</label>
                        <textarea name="msg" rows="2" placeholder="تفاصيل إضافية خاصة بالطلب..."
                            class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-[#E60914] focus:ring-1 focus:ring-[#E60914] transition resize-none">{{ old('msg') }}</textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex items-center justify-end gap-4">
                        <a href="{{ route('orders.index') }}" class="px-6 py-2.5 border border-gray-700 text-gray-400 rounded-lg hover:bg-gray-800 hover:text-white transition text-center">
                            إلغاء
                        </a>

                        <button type="submit" class="px-6 py-2.5 bg-[#E60914] hover:bg-red-700 text-white font-bold rounded-lg transition flex items-center gap-2 shadow-lg shadow-red-900/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            حفظ الطلب
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
