<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>د. {{ $user->name }} - بطاقتي الطبية</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f0f9ff;
            /* خلفية زرقاء فاتحة جداً */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .medical-gradient {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
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
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden border border-blue-100 fade-in relative">

        <!-- الهيدر (الغلاف) -->
        <div class="relative h-44 w-full medical-gradient">
            <!-- زخرفة خلفية (Pattern) -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0,0 L100,0 L100,100 Z" fill="white" />
                </svg>
            </div>

            <!-- أيقونة طبية في الخلفية -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-20">
                <i class="fas fa-user-md text-white text-8xl"></i>
            </div>
        </div>

        <!-- محتوى البطاقة -->
        <div class="relative px-6 pb-8 text-center">

            <!-- الصورة الشخصية -->
            <div class="absolute -top-16 left-1/2 transform -translate-x-1/2">
                <div class="relative">
                    <div class="p-1 bg-white rounded-full shadow-lg">
                        <img src="{{ $user->img ? asset('storage/' . $user->img) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0ea5e9&color=fff&size=128' }}"
                            alt="{{ $user->name }}"
                            class="w-28 h-28 rounded-full object-cover border-4 border-white">
                    </div>

                    @if($user->is_active)
                    <span class="absolute bottom-0 right-0 w-6 h-6 bg-green-500 border-2 border-white rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-xs"></i>
                    </span>
                    @endif
                </div>
            </div>

            <!-- الاسم والوظيفة والبايو -->
            <div class="pt-16 mb-6">
                <h1 class="text-2xl font-bold text-slate-800 mb-1">د. {{ $user->name }}</h1>
                @if($user->job)
                <h2 class="text-sky-600 font-semibold text-sm mb-3 tracking-wide uppercase">
                    {{ $user->job }}
                </h2>
                @endif
                @if($user->bio)
                <p class="text-slate-500 text-sm leading-relaxed max-w-xs mx-auto">
                    {{ $user->bio }}
                </p>
                @endif
            </div>

            <!-- أزرار التواصل السريع -->
            <div class="flex justify-center gap-4 mb-8">
                @if($user->phone)
                <a href="tel:{{ $user->phone }}" class="flex-1 inline-flex items-center justify-center gap-2 bg-sky-50 hover:bg-sky-100 text-sky-700 font-bold py-3 px-4 rounded-xl transition group border border-sky-100">
                    <i class="fas fa-phone-alt group-hover:animate-pulse"></i>
                    <span class="text-sm">اتصل الآن</span>
                </a>
                @endif

                @if($user->whatsapp)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->whatsapp) }}" target="_blank" class="flex-1 inline-flex items-center justify-center gap-2 bg-green-50 hover:bg-green-100 text-green-700 font-bold py-3 px-4 rounded-xl transition group border border-green-100">
                    <i class="fab fa-whatsapp group-hover:animate-pulse"></i>
                    <span class="text-sm">واتساب</span>
                </a>
                @endif
            </div>

            <!-- زر حفظ جهة الاتصال -->
            <div class="mb-8">
                <a href="{{ route('vcard.download', $user->slug) }}"
                    class="inline-flex items-center justify-center gap-3 w-full bg-gradient-to-l from-sky-500 to-cyan-500 hover:from-sky-600 hover:to-cyan-600 text-white font-bold py-3 px-6 rounded-xl transition duration-300 btn-press shadow-lg shadow-sky-500/20">
                    <i class="fas fa-address-card"></i>
                    <span>حفظ جهة الاتصال</span>
                </a>
            </div>

            <!-- روابط السوشيال ميديا -->
            @if($user->socialLinks->count() > 0)
            <div class="border-t border-slate-100 pt-6">
                <div class="grid grid-cols-4 gap-3">
                    @foreach($user->socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank"
                        class="flex flex-col items-center justify-center p-3 rounded-xl transition duration-300 group hover:bg-slate-50">

                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-100 mb-2 group-hover:bg-sky-500 transition">
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
                        <span class="text-xs text-slate-500 group-hover:text-sky-600">{{ $link->platform->name }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <div class="text-center pb-4 border-t border-slate-100 pt-4 bg-slate-50">
            <a href="/" class="text-xs text-slate-400 hover:text-sky-500 transition">
                Powered by <span class="font-bold text-slate-500">AVORA</span>
            </a>
        </div>
    </div>

</body>

</html>
