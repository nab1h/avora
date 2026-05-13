<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - متجر إلكتروني</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #0f0f0f;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* تأثير الخلفية المشعورة */
        .store-bg {
            background: radial-gradient(circle at top right, #2a2a2a, #0f0f0f);
        }

        .gold-gradient {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        }

        .card-glow {
            box-shadow: 0 20px 50px rgba(255, 215, 0, 0.05);
        }

        .btn-press:active {
            transform: scale(0.98);
        }

        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-[#1a1a1a] rounded-3xl card-glow overflow-hidden border border-[#2a2a2a] fade-in relative">

        <!-- هيدر المتجر -->
        <div class="relative h-40 w-full store-bg overflow-hidden">
            @if($user->img_cover)
            <img src="{{ asset('storage/' . $user->img_cover) }}" alt="Store Cover" class="w-full h-full object-cover opacity-40">
            @endif

            <!-- شريط علوي مع شعار "متجر معتمد" -->
            <div class="absolute top-0 left-0 right-0 p-4 flex justify-between items-center bg-gradient-to-b from-black/70 to-transparent">
                <span class="text-xs text-gray-300 bg-black/50 px-2 py-1 rounded-full flex items-center gap-1">
                    <i class="fas fa-check-circle text-green-500"></i> متجر موثوق
                </span>
                <span class="text-xs text-gray-400"> <i class="far fa-clock"></i> مفتوح الآن</span>
            </div>

            <!-- اسم المتجر داخل الغلاف -->
            <div class="absolute bottom-4 left-0 right-0 text-center">
                <h1 class="text-3xl font-black text-white drop-shadow-lg uppercase tracking-wide">
                    {{ $user->name }}
                </h1>
            </div>
        </div>

        <!-- محتوى البطاقة -->
        <div class="relative px-6 pb-8 text-center">

            <!-- الشعار (Logo) -->
            <div class="absolute -top-10 left-1/2 transform -translate-x-1/2">
                <div class="p-1 rounded-full gold-gradient">
                    <div class="p-1 bg-[#1a1a1a] rounded-full">
                        <img src="{{ $user->img ? asset('storage/' . $user->img) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=FFA500&color=fff&size=128&font-size=0.4' }}"
                            alt="Logo"
                            class="w-20 h-20 rounded-full object-cover border-2 border-[#1a1a1a]">
                    </div>
                </div>
            </div>

            <!-- الوصف والنوع -->
            <div class="pt-14 mb-6">
                <p class="text-amber-400 text-xs font-bold tracking-widest uppercase mb-2">
                    {{ $user->job ?? 'Business Owner' }}
                </p>
                @if($user->bio)
                <p class="text-gray-500 text-xs leading-relaxed max-w-xs mx-auto border-t border-[#2a2a2a] pt-3 mt-3">
                    {{ $user->bio }}
                </p>
                @endif
            </div>

            <!-- أزرار الشراء (CTA) - المحدثة -->
            <div class="space-y-3 mb-8">
                <!-- زر الطلب الرئيسي (واتساب) -->
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone ?? $user->whatsapp) }}" target="_blank"
                    class="flex items-center justify-center gap-3 w-full gold-gradient text-black font-bold py-4 px-6 rounded-xl transition duration-300 btn-press shadow-lg">
                    <i class="fab fa-whatsapp text-xl"></i>
                    <span class="text-sm">اطلب الآن عبر واتساب</span>
                </a>

                <!-- صف أزرار ثانوي (اتصال + حفظ) -->
                <div class="grid grid-cols-2 gap-3">

                    <!-- زر الاتصال -->
                    <a href="tel:{{ $user->phone }}"
                        class="flex items-center justify-center gap-2 w-full bg-[#0a0a0a] border border-[#333] hover:border-amber-500 text-gray-300 font-bold py-3 px-4 rounded-xl transition duration-300 text-sm">
                        <i class="fas fa-phone-alt text-amber-500"></i>
                        <span>اتصل بنا</span>
                    </a>

                    <!-- زر حفظ جهة الاتصال (VCF) -->
                    <a href="{{ route('vcard.download', $user->slug) }}"
                        class="flex items-center justify-center gap-2 w-full bg-[#0a0a0a] border border-[#333] hover:border-amber-500 text-gray-300 font-bold py-3 px-4 rounded-xl transition duration-300 text-sm">
                        <i class="fas fa-address-card text-amber-500"></i>
                        <span>حفظ جهة الاتصال</span>
                    </a>

                </div>
            </div>

            <!-- روابط المتجر (Social) -->
            @if($user->socialLinks->count() > 0)
            <div class="border-t border-[#222] pt-6">
                <h3 class="text-xs text-gray-600 uppercase tracking-widest mb-4">تابعنا على</h3>
                <div class="flex justify-center gap-4">
                    @foreach($user->socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank"
                        class="w-12 h-12 bg-[#0a0a0a] border border-[#222] rounded-xl flex items-center justify-center hover:border-amber-500 hover:bg-amber-500 transition group">

                        @switch($link->platform->name)
                        @case('Instagram')
                        <i class="fab fa-instagram text-xl text-pink-500 group-hover:text-white"></i> @break
                        @case('Twitter')
                        <i class="fab fa-twitter text-xl text-sky-400 group-hover:text-white"></i> @break
                        @case('LinkedIn')
                        <i class="fab fa-linkedin text-xl text-blue-600 group-hover:text-white"></i> @break
                        @case('Facebook')
                        <i class="fab fa-facebook text-xl text-blue-500 group-hover:text-white"></i> @break
                        @case('Tiktok')
                        <i class="fab fa-tiktok text-xl text-blue-500 group-hover:text-white"></i> @break
                        @case('WhatsApp')
                        <i class="fab fa-whatsapp text-xl text-blue-500 group-hover:text-white"></i> @break
                        @case('TikTok')
                        <i class="fab fa-tiktok text-xl text-blue-500 group-hover:text-white"></i> @break
                        @case('Snapchat')
                        <i class="fab fa-snapchat text-xl text-blue-500 group-hover:text-white"></i> @break
                        @case('Telegram')
                        <i class="fab fa-telegram text-xl text-blue-500 group-hover:text-white"></i> @break
                        @case('Email')
                        <i class="fas fa-envelope text-xl text-blue-500 group-hover:text-white"></i> @break
                        @case('Website')
                        <i class="fas fa-globe text-xl text-blue-500 group-hover:text-white"></i> @break
                        @case('GitHub')
                        <i class="fab fa-github text-xl text-blue-500 group-hover:text-white"></i> @break
                        @default
                        <i class="fas fa-link text-xl text-slate-400 group-hover:text-white"></i>
                        @endswitch
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <!-- ذيل البطاقة -->
        <div class="text-center py-3 border-t border-[#222] bg-[#0f0f0f]">
            <span class="text-[10px] text-gray-600 tracking-widest uppercase">
                Powered by <span class="font-bold text-amber-600">AVORA</span>
            </span>
        </div>
    </div>

</body>

</html>
