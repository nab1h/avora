<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - بطاقتي الرقمية</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome للأيقونات -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #000000;
            /* خلفية سوداء تماماً */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* تأثير التدرج للغلاف */
        .cover-gradient {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.9) 100%);
        }

        /* تأثير الزر عند الضغط */
        .btn-press:active {
            transform: scale(0.96);
        }

        /* أنيميشن ظهور العناصر */
        .fade-in {
            animation: fadeIn 0.8s ease-in-out;
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

<body class="text-white min-h-screen flex items-center justify-center p-4">

    <!-- بطاقة البروفايل الرئيسية -->
    <div class="w-full max-w-md bg-[#111111] rounded-3xl shadow-2xl overflow-hidden border border-[#1a1a1a] fade-in relative">

        <!-- غلاف البروفايل (Cover) -->
        <div class="relative h-48 w-full">
            @if($user->img_cover)
            <img src="{{ asset('storage/' . $user->img_cover) }}" alt="Cover" class="w-full h-full object-cover opacity-70">
            @else
            <!-- غلاف افتراضي بتدرج لوني -->
            <div class="w-full h-full bg-gradient-to-br from-[#E60914] to-black"></div>
            @endif
            <!-- طبقة التدرج السفلي لدمج الغلاف مع الخلفية -->
            <div class="absolute inset-0 cover-gradient"></div>
        </div>

        <!-- محتوى البطاقة -->
        <div class="relative px-6 pb-8 text-center">

            <!-- الصورة الشخصية -->
            <div class="absolute -top-16 left-1/2 transform -translate-x-1/2">
                <div class="relative">
                    <img src="{{ $user->img ? asset('storage/' . $user->img) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=E60914&color=fff&size=128' }}"
                        alt="{{ $user->name }}"
                        class="w-32 h-32 rounded-full border-4 border-[#111111] object-cover shadow-lg">

                    <!-- علامة صح خضراء (اختياري) -->
                    @if($user->is_active)
                    <span class="absolute bottom-2 right-2 w-5 h-5 bg-green-500 border-2 border-[#111111] rounded-full"></span>
                    @endif
                </div>
            </div>

            <!-- الاسم والوظيفة والبايو -->
            <div class="pt-20 mb-6">
                <h1 class="text-2xl font-bold text-white mb-1">{{ $user->name }}</h1>
                @if($user->job)
                <h2 class="text-[#E60914] font-medium text-sm mb-3">{{ $user->job }}</h2>
                @endif
                @if($user->bio)
                <p class="text-gray-400 text-sm leading-relaxed max-w-xs mx-auto">
                    {{ $user->bio }}
                </p>
                @endif
            </div>

            <div class="mb-8">
                <a href="{{ route('vcard.download', $user->slug) }}"
                    class="inline-flex items-center justify-center gap-3 w-full bg-[#E60914] hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl transition duration-300 btn-press shadow-lg shadow-red-900/20">
                    <i class="fas fa-address-book"></i>
                    <span>حفظ جهة الاتصال</span>
                </a>
            </div>

            <!-- روابط التواصل الاجتماعي -->
            @if($user->socialLinks->count() > 0)
            <div class="grid grid-cols-3 gap-4">
                @foreach($user->socialLinks as $link)
                <a href="{{ $link->url }}" target="_blank"
                    class="flex flex-col items-center justify-center p-4 bg-[#0a0a0a] rounded-xl border border-[#1a1a1a] hover:border-[#E60914] transition duration-300 group">

                    <!-- أيقونة المنصة -->
                    <div class="w-10 h-10 flex items-center justify-center rounded-full bg-[#1a1a1a] mb-2 group-hover:bg-[#E60914] transition">
                        @switch($link->platform->name)
                        @case('Instagram')
                        <i class="fab fa-instagram text-xl text-pink-500 group-hover:text-white"></i>
                        @break
                        @case('Twitter')
                        <i class="fab fa-twitter text-xl text-blue-400 group-hover:text-white"></i>
                        @break
                        @case('WhatsApp')
                        <i class="fab fa-whatsapp text-xl text-green-500 group-hover:text-white"></i>
                        @break
                        @case('LinkedIn')
                        <i class="fab fa-linkedin text-xl text-blue-600 group-hover:text-white"></i>
                        @break
                        @case('Facebook')
                        <i class="fab fa-facebook text-xl text-blue-500 group-hover:text-white"></i>
                        @break
                        @case('TikTok')
                        <i class="fab fa-tiktok text-xl text-white group-hover:text-white"></i>
                        @break
                        @default
                        <i class="fas fa-link text-xl text-gray-400 group-hover:text-white"></i>
                        @endswitch
                    </div>
                    <span class="text-xs text-gray-500 group-hover:text-gray-300">{{ $link->platform->name }}</span>
                </a>
                @endforeach
            </div>
            @endif

        </div>

        <div class="text-center pb-4 border-t border-[#1a1a1a] pt-4 mt-4">
            <a href="/" class="text-xs text-gray-600 hover:text-[#E60914] transition">
                Powered by <span class="font-bold">NFC System</span>
            </a>
        </div>
    </div>

</body>

</html>
