<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - مندوب مبيعات</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f1f5f9;
            /* رمادي فاتح */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sales-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            /* أزرق داكن احترافي */
        }

        .gold-accent {
            color: #f59e0b;
            /* ذهبي */
        }

        .gold-bg {
            background-color: #f59e0b;
        }

        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
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

    <div class="w-full max-w-md bg-white rounded-3xl card-shadow overflow-hidden border border-gray-100 fade-in relative">

        <!-- هيدر احترافي -->
        <div class="relative h-32 w-full sales-gradient flex items-center justify-center overflow-hidden">
            <!-- نقوش زخرفية -->
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <div class="absolute top-0 right-0 w-40 h-40 bg-white rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-white rounded-full translate-y-1/2 -translate-x-1/2"></div>
            </div>

            <div class="relative z-10 text-center px-4">
                <!-- الاسم هنا صغير ليظهر كعنوان رئيسي، والصورة ستأتي تحته -->
                <h2 class="text-sm text-gray-400 uppercase tracking-widest">Sales Representative</h2>
                <h1 class="text-xl font-bold text-white mt-1 tracking-wide">{{ $user->name }}</h1>
            </div>
        </div>

        <!-- محتوى البطاقة -->
        <div class="relative px-6 pb-8 text-center">

            <!-- الصورة الشخصية (معلقة قليلاً) -->
            <div class="absolute -top-12 left-1/2 transform -translate-x-1/2">
                <div class="relative">
                    <div class="p-1 bg-white rounded-full shadow-lg inline-block">
                        <img src="{{ $user->img ? asset('storage/' . $user->img) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=1e293b&color=fff&size=128' }}"
                            alt="{{ $user->name }}"
                            class="w-24 h-24 rounded-full object-cover border-4 border-white">
                    </div>
                    <span class="absolute bottom-1 right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></span>
                </div>
            </div>

            <!-- الوصف والمنطقة (اختياري) -->
            <div class="pt-16 mb-6">
                <p class="text-slate-800 font-semibold text-lg">
                    {{ $user->job ?? 'مستشار المبيعات' }}
                </p>
                @if($user->bio)
                <p class="text-gray-500 text-sm leading-relaxed max-w-xs mx-auto mt-2 border-t border-gray-100 pt-3">
                    {{ $user->bio }}
                </p>
                @endif
            </div>

            <!-- أزرار الأكشن (CTA) - أهم جزء -->
            <div class="space-y-3 mb-8">

                <!-- زر الاتصال المباشر -->
                <a href="tel:{{ $user->phone }}"
                    class="flex items-center justify-center gap-3 w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3.5 px-6 rounded-xl transition btn-press shadow-md">
                    <i class="fas fa-phone-volume text-lg"></i>
                    <span>اتصل الآن للطلب</span>
                </a>

                <!-- زر واتساب -->
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone ?? $user->whatsapp) }}" target="_blank"
                    class="flex items-center justify-center gap-3 w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3.5 px-6 rounded-xl transition btn-press shadow-md">
                    <i class="fab fa-whatsapp text-xl"></i>
                    <span>تواصل واتساب</span>
                </a>

                <!-- زر حفظ جهة الاتصال -->
                <a href="{{ route('vcard.download', $user->slug) }}"
                    class="flex items-center justify-center gap-2 w-full bg-white border-2 border-slate-200 hover:border-amber-500 text-slate-700 font-bold py-3 px-6 rounded-xl transition text-sm">
                    <i class="fas fa-user-plus text-amber-500"></i>
                    <span>حفظ جهة الاتصال</span>
                </a>
            </div>

            <!-- روابط السوشيال ميديا -->
            @if($user->socialLinks->count() > 0)
            <div class="border-t border-gray-100 pt-6">
                <div class="grid grid-cols-4 gap-2">
                    @foreach($user->socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank"
                        class="flex flex-col items-center justify-center p-2 rounded-xl transition duration-300 group hover:bg-slate-50">

                        <div class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-100 mb-1 group-hover:bg-slate-900 transition">

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
                        <span class="text-[10px] text-gray-400 group-hover:text-slate-800">{{ $link->platform->name }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <!-- ذيل البطاقة -->
        <div class="text-center py-3 border-t border-gray-100 bg-gray-50">
            <span class="text-[10px] text-gray-400 uppercase tracking-wider">
                Powered by <span class="font-bold text-slate-600">AVORA</span>
            </span>
        </div>
    </div>

</body>

</html>
