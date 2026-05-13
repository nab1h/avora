<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#111111] border border-[#1a1a1a] rounded-2xl shadow-2xl p-8 max-w-2xl mx-auto">

                <!-- Header -->
                <div class="mb-8 border-b border-[#1a1a1a] pb-4">
                    <h3 class="text-2xl font-bold text-white">تعديل الطلب #{{ $order->id }}</h3>
                    <p class="text-gray-400 text-sm mt-1">قم بتعديل بيانات العميل أو حالة الطلب.</p>
                </div>

                <!-- Form Start -->
                <form method="POST" action="{{ route('orders.update', $order->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Grid Layout for Inputs -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Customer Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">اسم العميل</label>
                            <input type="text" name="name" value="{{ old('customer_name', $order->name) }}" required
                                class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914] focus:ring-1 focus:ring-[#E60914] transition">
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">رقم الهاتف</label>
                            <input type="tel" name="phone" value="{{ old('phone', $order->phone) }}" required
                                class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914] focus:ring-1 focus:ring-[#E60914] transition">
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">البريد الإلكتروني</label>
                            <input type="email" name="email" value="{{ old('email', $order->email) }}"
                                class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914] focus:ring-1 focus:ring-[#E60914] transition">
                        </div>

                        <!-- Order Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">حالة الطلب</label>
                            <div class="relative">
                                <select name="status" required
                                    class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white appearance-none focus:outline-none focus:border-[#E60914] focus:ring-1 focus:ring-[#E60914] transition">
                                    <option value="preparation" {{ $order->status == 'preparation' ? 'selected' : '' }}>قيد التجهيز</option>
                                    <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>في الشحن</option>
                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>تم التسليم</option>
                                </select>
                                <!-- Dropdown Arrow Icon -->
                                <div class="absolute inset-y-0 left-0 flex items-center px-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Address (Full Width) -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">العنوان الكامل</label>
                        <textarea name="address" rows="3" required
                            class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914] focus:ring-1 focus:ring-[#E60914] transition resize-none">{{ old('address', $order->address) }}</textarea>
                    </div>

                    <!-- Notes (Full Width) -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">ملاحظات إضافية</label>
                        <textarea name="notes" rows="2"
                            class="w-full bg-[#0a0a0a] border border-[#1a1a1a] rounded-lg px-4 py-3 text-white focus:outline-none focus:border-[#E60914] focus:ring-1 focus:ring-[#E60914] transition resize-none">{{ old('notes', $order->notes) }}</textarea>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex items-center justify-end gap-4">
                        <!-- Cancel Button -->
                        <a href="{{ route('orders.index') }}" class="px-6 py-2.5 border border-gray-700 text-gray-400 rounded-lg hover:bg-gray-800 hover:text-white transition text-center">
                            إلغاء
                        </a>

                        <!-- Submit Button -->
                        <button type="submit" class="px-6 py-2.5 bg-[#E60914] hover:bg-red-700 text-white font-bold rounded-lg transition flex items-center gap-2 shadow-lg shadow-red-900/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            تحديث الطلب
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
