<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - مصمم جرافيك</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #080808;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* تأثير الدائرة المتوهجة خلف الصورة */
        .glow-circle {
            background: conic-gradient(from 180deg, #ff00cc, #3333ff, #00ffcc, #ff00cc);
            animation: rotate 5s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
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

        /* تأثير النيون للأيقونات */
        .neon-icon {
            text-shadow: 0 0 5px currentColor, 0 0 10px currentColor;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-[#111111] rounded-3xl shadow-2xl overflow-hidden border border-[#222] fade-in relative">

        <!-- هيدر بمساحة للغلاف مع باترن (نمط) خفيف -->
        <div class="relative h-40 w-full bg-[#0a0a0a] overflow-hidden">
            @if($user->img_cover)
            <img src="{{ asset('storage/' . $user->img_cover) }}" class="w-full h-full object-cover opacity-40">
            @else
            <!-- نمط هندسي افتراضي للمصممين -->
            <div class="absolute inset-0 opacity-20 bg-gradient-to-br from-purple-600 via-pink-500 to-red-500"></div>
            @endif

            <!-- زاوية دائرية علوية -->
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-[#111111]" style="border-radius: 50% 50% 0 0 / 100% 100% 0 0;"></div>
        </div>

        <!-- محتوى البطاقة -->
        <div class="relative px-6 pb-8 text-center">

            <!-- الصورة الشخصية مع إطار متدرج -->
            <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 p-1 rounded-full glow-circle">
                <div class="p-1 bg-[#111111] rounded-full">
                    <img src="{{ $user->img ? asset('storage/' . $user->img) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=random&color=fff&size=128' }}"
                        alt="{{ $user->name }}"
                        class="w-28 h-28 rounded-full object-cover border-2 border-[#111111]">
                </div>
            </div>

            <!-- الاسم والوظيفة -->
            <div class="pt-16 mb-6">
                <h1 class="text-2xl font-bold text-white tracking-wide">{{ $user->name }}</h1>
                <p class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600 font-bold text-sm mt-1 uppercase">
                    {{ $user->job ?? 'Graphic Designer' }}
                </p>

                @if($user->bio)
                <p class="text-gray-500 text-xs leading-relaxed max-w-xs mx-auto mt-3">
                    {{ $user->bio }}
                </p>
                @endif
            </div>

            <!-- قسم الخدمات (Services) - ثابت في التصميم لإضفاء طابع احترافي -->
            <div class="flex justify-center gap-2 mb-6 flex-wrap">
                <span class="px-3 py-1 text-xs bg-purple-500/10 text-purple-400 border border-purple-500/20 rounded-full">Logo Design</span>
                <span class="px-3 py-1 text-xs bg-pink-500/10 text-pink-400 border border-pink-500/20 rounded-full">Branding</span>
                <span class="px-3 py-1 text-xs bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-full">Social Media</span>
            </div>

            <!-- زر التواصل الرئيسي -->
            <div class="mb-6">
                <a href="mailto:{{ $user->email }}"
                    class="inline-flex items-center justify-center gap-3 w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-3 px-6 rounded-xl transition shadow-lg shadow-purple-500/20">
                    <i class="fas fa-paper-plane"></i>
                    <span>لنبدأ مشروعاً معاً</span>
                </a>
            </div>

            <!-- معرض الأعمال / الروابط المميزة -->
            @if($user->socialLinks->count() > 0)
            <div class="mb-6">
                <h3 class="text-xs text-gray-500 uppercase tracking-widest mb-3">Portfolio & Social</h3>
                <div class="grid grid-cols-2 gap-3">

                    @foreach($user->socialLinks as $link)
                    @php
                    // تمييز منصات التصميم لتأخذ شكلاً مميزاً
                    $isDesignPlatform = in_array($link->platform->name, ['Behance', 'Dribbble']);
                    @endphp

                    <a href="{{ $link->url }}" target="_blank"
                        class="flex items-center gap-3 p-3 rounded-xl transition duration-300 group
                                  {{ $isDesignPlatform ? 'col-span-2 bg-gradient-to-l from-[#1a1a1a] to-[#111] border border-[#333] hover:border-purple-500' : 'bg-[#0a0a0a] border border-[#1a1a1a] hover:border-gray-600' }}">

                        <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-[#222] group-hover:bg-purple-500 transition">
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

                        <div class="text-right flex-grow">
                            <span class="text-white text-sm font-medium group-hover:text-purple-300 transition">
                                {{ $link->platform->name }}
                            </span>
                            @if($isDesignPlatform)
                            <p class="text-[10px] text-gray-500 group-hover:text-gray-400">View Projects</p>
                            @endif
                        </div>

                        <i class="fas fa-arrow-left text-gray-600 group-hover:text-white transition transform group-hover:-translate-x-1"></i>
                    </a>
                    @endforeach

                </div>
            </div>
            @endif

            <!-- زر حفظ جهة الاتصال (ثانوي) -->
            <div class="text-center">
                <a href="{{ route('vcard.download', $user->slug) }}" class="text-xs text-gray-500 hover:text-white transition">
                    <i class="fas fa-download ml-1"></i> تحميل VCF
                </a>
            </div>

        </div>

        <div class="text-center py-3 border-t border-[#1a1a1a] bg-[#0a0a0a]">
            <span class="text-[10px] text-gray-700 tracking-widest uppercase">
                Designed by <span class="text-purple-500 font-bold">AVORA</span>
            </span>
        </div>
    </div>

</body>

</html>
