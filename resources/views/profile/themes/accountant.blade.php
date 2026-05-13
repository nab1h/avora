<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - محاسب قانوني</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f0fdf4;
            /* أخضر فاتح جداً */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .accountant-gradient {
            background: linear-gradient(135deg, #14532d 0%, #166534 100%);
            /* أخضر داكن عميق */
        }

        .gold-accent {
            color: #ca8a04;
        }

        .card-shadow {
            box-shadow: 0 20px 25px -5px rgba(20, 83, 45, 0.1), 0 8px 10px -6px rgba(20, 83, 45, 0.1);
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

        /* نمط دفتر الحسابات */
        .ledger-lines {
            background-image: linear-gradient(#e5e7eb 1px, transparent 1px);
            background-size: 100% 20px;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-3xl card-shadow overflow-hidden border border-green-100 fade-in relative">

        <!-- الهيدر (الغلاف) -->
        <div class="relative h-36 w-full accountant-gradient overflow-hidden">
            <!-- زخرفة العملات (رمزية) -->
            <div class="absolute top-0 right-0 w-32 h-32 opacity-10 transform translate-x-8 -translate-y-8">
                <i class="fas fa-coins text-white text-8xl"></i>
            </div>
            <div class="absolute bottom-0 left-0 w-24 h-24 opacity-10 transform -translate-x-4 translate-y-4">
                <i class="fas fa-chart-line text-white text-6xl"></i>
            </div>

            <!-- شريط علوي ذهبي -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-amber-500"></div>
        </div>

        <!-- محتوى البطاقة -->
        <div class="relative px-6 pb-8 text-center">

            <!-- الصورة الشخصية -->
            <div class="absolute -top-12 left-1/2 transform -translate-x-1/2">
                <div class="relative">
                    <!-- إطار ذهبي -->
                    <div class="p-1 bg-amber-500 rounded-full shadow-lg">
                        <img src="{{ $user->img ? asset('storage/' . $user->img) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=14532d&color=fff&size=128' }}"
                            alt="{{ $user->name }}"
                            class="w-24 h-24 rounded-full object-cover border-4 border-white">
                    </div>
                    <span class="absolute bottom-0 right-0 w-5 h-5 bg-green-600 border-2 border-white rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-[8px]"></i>
                    </span>
                </div>
            </div>

            <!-- الاسم والمنصب -->
            <div class="pt-16 mb-4">
                <h1 class="text-xl font-bold text-gray-800">{{ $user->name }}</h1>
                <p class="text-green-700 font-bold text-sm mt-1 uppercase tracking-wide">
                    {{ $user->job ?? 'Chartered Accountant' }}
                </p>
                @if($user->bio)
                <p class="text-gray-500 text-xs leading-relaxed max-w-xs mx-auto mt-3 border-t border-green-50 pt-3">
                    {{ $user->bio }}
                </p>
                @endif
            </div>

            <!-- خدمات المحاسبة (Badges) -->
            <div class="flex flex-wrap justify-center gap-2 mb-6">
                <span class="bg-green-50 text-green-800 text-[10px] font-bold px-3 py-1 rounded-full border border-green-100 flex items-center gap-1">
                    <i class="fas fa-file-invoice-dollar text-green-600"></i> ضرائب
                </span>
                <span class="bg-green-50 text-green-800 text-[10px] font-bold px-3 py-1 rounded-full border border-green-100 flex items-center gap-1">
                    <i class="fas fa-balance-scale text-green-600"></i> ميزانيات
                </span>
                <span class="bg-green-50 text-green-800 text-[10px] font-bold px-3 py-1 rounded-full border border-green-100 flex items-center gap-1">
                    <i class="fas fa-book text-green-600"></i> دفاتر
                </span>
            </div>

            <!-- أزرار التواصل -->
            <div class="space-y-3 mb-8">

                <!-- زر واتساب (للاستشارات) -->
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone ?? $user->whatsapp) }}" target="_blank"
                    class="flex items-center justify-center gap-3 w-full bg-green-700 hover:bg-green-800 text-white font-bold py-3.5 px-6 rounded-xl transition btn-press shadow-md">
                    <i class="fab fa-whatsapp text-xl"></i>
                    <span>احجز موعد استشارة</span>
                </a>

                <!-- زر الاتصال -->
                @if($user->phone)
                <a href="tel:{{ $user->phone }}"
                    class="flex items-center justify-center gap-3 w-full bg-green-50 hover:bg-green-100 text-green-800 font-bold py-3.5 px-6 rounded-xl transition border border-green-100">
                    <i class="fas fa-phone-alt text-green-600"></i>
                    <span>تواصل هاتفي</span>
                </a>
                @endif

                <!-- زر حفظ البطاقة -->
                <a href="{{ route('vcard.download', $user->slug) }}"
                    class="flex items-center justify-center gap-2 w-full bg-white border-2 border-gray-200 hover:border-amber-500 text-gray-600 font-bold py-3 px-6 rounded-xl transition text-sm">
                    <i class="fas fa-address-card text-amber-500"></i>
                    <span>حفظ جهة الاتصال</span>
                </a>
            </div>

            <!-- روابط السوشيال ميديا -->
            @if($user->socialLinks->count() > 0)
            <div class="border-t border-green-50 pt-6">
                <div class="grid grid-cols-4 gap-2">
                    @foreach($user->socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank"
                        class="flex flex-col items-center justify-center p-2 rounded-xl transition duration-300 group hover:bg-green-50">

                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-green-50 mb-1 group-hover:bg-green-700 transition">

                            @php $platform = strtolower($link->platform->name); @endphp

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
                        </div>
                        <span class="text-[10px] text-gray-400 group-hover:text-green-800">{{ $link->platform->name }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <!-- ذيل البطاقة -->
        <div class="text-center py-3 border-t border-green-50 bg-green-50">
            <span class="text-[10px] text-green-600 uppercase tracking-wider">
                Financial Consultant <span class="font-bold">•AVORA</span>
            </span>
        </div>
    </div>

</body>

</html>
