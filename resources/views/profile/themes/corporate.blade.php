<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Corporate Profile</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8fafc;
            /* رمادي فاتح جداً */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .corporate-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #172554 100%);
            /* أزرق كحلي (Navy) */
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .card-shadow {
            box-shadow: 0 20px 25px -5px rgba(30, 58, 138, 0.1), 0 8px 10px -6px rgba(30, 58, 138, 0.1);
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

    <div class="w-full max-w-md glass-effect rounded-3xl card-shadow overflow-hidden border border-gray-100 fade-in relative">

        <!-- الهيدر الرسمي -->
        <div class="relative h-32 w-full corporate-gradient flex items-center justify-center">
            <!-- زخرفة هندسية بسيطة -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 right-0 w-48 h-48 bg-white rounded-full translate-x-1/3 -translate-y-1/2"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 border-4 border-white rounded-full -translate-x-1/4 translate-y-1/4"></div>
            </div>

            <!-- الشعار أو اسم الشركة (يمكن استبداله بلوجو الشركة) -->
            <div class="relative z-10 text-center">
                <i class="fas fa-building text-white/30 text-5xl"></i>
            </div>
        </div>

        <!-- محتوى البطاقة -->
        <div class="relative px-6 pb-8 text-center">

            <!-- الصورة الشخصية (إطار رسمي مربع الشكل قليلاً) -->
            <div class="absolute -top-14 left-1/2 transform -translate-x-1/2">
                <div class="relative">
                    <div class="p-1 bg-white rounded-2xl shadow-lg">
                        <img src="{{ $user->img ? asset('storage/' . $user->img) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=1e3a8a&color=fff&size=128' }}"
                            alt="{{ $user->name }}"
                            class="w-28 h-28 rounded-xl object-cover border-4 border-white">
                    </div>
                    <span class="absolute bottom-1 right-1 w-4 h-4 bg-blue-600 border-2 border-white rounded-full"></span>
                </div>
            </div>

            <!-- الاسم والمنصب -->
            <div class="pt-16 mb-6">
                <h1 class="text-2xl font-bold text-slate-800">{{ $user->name }}</h1>
                <p class="text-blue-700 font-semibold text-sm mt-1 uppercase tracking-wide">
                    {{ $user->job ?? 'HR Manager' }}
                </p>

                @if($user->bio)
                <p class="text-gray-500 text-xs leading-relaxed max-w-xs mx-auto mt-3">
                    {{ $user->bio }}
                </p>
                @endif
            </div>

            <div class="space-y-3 mb-8">

                <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $user->email }}"
                    class="flex items-center justify-center gap-3 w-full bg-slate-800 hover:bg-slate-900 text-white font-bold py-3.5 px-6 rounded-xl transition btn-press shadow-md">
                    <i class="fas fa-envelope text-lg"></i>
                    <span>إرسال بريد إلكتروني</span>
                </a>

                @if($user->phone)
                <a href="tel:{{ $user->phone }}"
                    class="flex items-center justify-center gap-3 w-full bg-blue-50 hover:bg-blue-100 text-blue-800 font-bold py-3.5 px-6 rounded-xl transition border border-blue-100">
                    <i class="fas fa-phone-office text-lg"></i>
                    <span>اتصل بالعمل</span>
                </a>
                @endif

                <!-- زر حفظ بطاقة العمل -->
                <a href="{{ route('vcard.download', $user->slug) }}"
                    class="flex items-center justify-center gap-2 w-full bg-white border-2 border-gray-200 hover:border-blue-600 text-gray-600 font-bold py-3 px-6 rounded-xl transition text-sm">
                    <i class="fas fa-id-card text-blue-600"></i>
                    <span>حفظ بطاقة العمل</span>
                </a>
            </div>

            <!-- روابط التواصل المهني -->
            @if($user->socialLinks->count() > 0)
            <div class="border-t border-gray-100 pt-6">
                <div class="grid grid-cols-3 gap-4">
                    @foreach($user->socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank"
                        class="flex flex-col items-center justify-center p-2 rounded-xl transition duration-300 group">

                        <div class="w-12 h-12 flex items-center justify-center rounded-full bg-slate-50 mb-2 group-hover:bg-slate-800 transition">

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
                            @case('Website')
                            <i class="fas fa-globe text-xl text-blue-500 group-hover:text-white"></i> @break
                            @case('GitHub')
                            <i class="fab fa-github text-xl text-blue-500 group-hover:text-white"></i> @break
                            @default
                            <i class="fas fa-link text-xl text-slate-400 group-hover:text-white"></i>
                            @endswitch
                        </div>
                        <span class="text-xs text-gray-500 group-hover:text-slate-800 font-medium">{{ $link->platform->name }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <!-- ذيل البطاقة -->
        <div class="text-center py-3 border-t border-gray-100 bg-slate-50">
            <span class="text-[10px] text-gray-400 uppercase tracking-wider">
                Professional Digital Card
            </span>
        </div>
    </div>

</body>

</html>
