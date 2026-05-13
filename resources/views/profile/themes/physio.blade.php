<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - علاج طبيعي</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f0fdfa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .wave-bg {
            background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        }

        .card-shadow {
            box-shadow: 0 20px 25px -5px rgba(20, 184, 166, 0.1), 0 8px 10px -6px rgba(20, 184, 166, 0.1);
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

    <div class="w-full max-w-md bg-white rounded-3xl card-shadow overflow-hidden border border-teal-50 fade-in relative">

        <div class="relative h-40 w-full wave-bg overflow-hidden">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-white opacity-10 rounded-full"></div>

            <div class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-20">
                <i class="fas fa-walking text-white text-7xl"></i>
            </div>

            <svg class="absolute bottom-0 w-full" viewBox="0 0 1440 320" xmlns="http://www.w3.org/2000/svg">
                <path fill="#ffffff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,224C672,245,768,267,864,250.7C960,235,1056,181,1152,165.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>

        <div class="relative px-6 pb-8 text-center">

            <div class="absolute -top-16 left-1/2 transform -translate-x-1/2">
                <div class="relative">
                    <div class="p-1 bg-white rounded-full shadow-md">
                        <img src="{{ $user->img ? asset('storage/' . $user->img) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0d9488&color=fff&size=128' }}"
                            alt="{{ $user->name }}"
                            class="w-28 h-28 rounded-full object-cover border-4 border-white">
                    </div>
                    @if($user->is_active)
                    <span class="absolute bottom-0 right-0 w-6 h-6 bg-teal-500 border-2 border-white rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-xs"></i>
                    </span>
                    @endif
                </div>
            </div>

            <div class="pt-16 mb-4">
                <h1 class="text-xl font-bold text-teal-900">{{ $user->name }}</h1>
                <p class="text-teal-600 font-medium text-sm mt-1">
                    {{ $user->job ?? 'أخصائي علاج طبيعي' }}
                </p>
                @if($user->bio)
                <p class="text-gray-500 text-xs leading-relaxed max-w-xs mx-auto mt-3">
                    {{ $user->bio }}
                </p>
                @endif
            </div>

            <div class="flex justify-center gap-4 mb-6 text-xs">
                <div class="flex items-center gap-1 text-gray-500 bg-teal-50 px-3 py-2 rounded-full">
                    <i class="fas fa-user-md text-teal-600"></i>
                    <span>زيارة منزلية</span>
                </div>
                <div class="flex items-center gap-1 text-gray-500 bg-teal-50 px-3 py-2 rounded-full">
                    <i class="fas fa-dumbbell text-teal-600"></i>
                    <span>تأهيل رياضي</span>
                </div>
            </div>

            <div class="space-y-3 mb-9">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone ?? $user->whatsapp) }}" target="_blank"
                    class="inline-flex items-center justify-center gap-3 w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-6 rounded-xl transition duration-300 btn-press shadow-lg shadow-teal-200">
                    <i class="fab fa-whatsapp text-xl"></i>
                    <span>احجز موعدك الآن</span>
                </a>


                <div class="grid grid-cols-2 gap-3 mt-9">
                    <a href="tel:{{ $user->phone }}"
                        class="flex items-center justify-center gap-2 w-full bg-teal-50 hover:bg-teal-100 text-teal-700 font-bold py-3 px-4 rounded-xl transition duration-300 text-sm border border-teal-100">
                        <i class="fas fa-phone-alt"></i>
                        <span>اتصل الآن</span>
                    </a>

                    <!-- زر حفظ جهة الاتصال الجديد -->
                    <a href="{{ route('vcard.download', $user->slug) }}"
                        class="flex items-center justify-center gap-2 w-full bg-teal-50 hover:bg-teal-100 text-teal-700 font-bold py-3 px-4 rounded-xl transition duration-300 text-sm border border-teal-100">
                        <i class="fas fa-address-card"></i>
                        <span>حفظ الاتصال</span>
                    </a>
                </div>
            </div>

            @if($user->socialLinks->count() > 0)
            <div class="border-t border-teal-50 pt-6">
                <div class="grid grid-cols-3 gap-3">
                    @foreach($user->socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank"
                        class="flex flex-col items-center justify-center p-3 rounded-xl transition duration-300 group hover:bg-teal-50">

                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-teal-50 mb-2 group-hover:bg-teal-600 transition">

                            @php
                            $platform = strtolower($link->platform->name);
                            @endphp

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
                        <span class="text-xs text-gray-500 group-hover:text-teal-800">{{ $link->platform->name }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <div class="text-center pb-4 pt-4 bg-teal-50 border-t border-teal-100">
            <span class="text-xs text-teal-400">
                Powered by <span class="font-bold text-teal-600">AVORA</span>
            </span>
        </div>
    </div>

</body>

</html>
