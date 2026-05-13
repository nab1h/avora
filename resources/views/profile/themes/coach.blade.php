<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - Speaker & Coach</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #0f0720;
            /* خلفية داكنة بنفسجية */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* تدرج ملهم (Inspirational Gradient) */
        .coach-gradient {
            background: linear-gradient(135deg, #7c3aed 0%, #db2777 50%, #f59e0b 100%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .neon-glow {
            box-shadow: 0 0 20px rgba(219, 39, 119, 0.3);
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

    <div class="w-full max-w-md glass-card rounded-3xl overflow-hidden shadow-2xl fade-in relative">

        <!-- هيدر ديناميكي -->
        <div class="relative h-44 w-full coach-gradient overflow-hidden">
            <!-- أشكال هندسية متحركة -->
            <div class="absolute -top-10 -right-10 w-40 h-40 border-4 border-white/10 rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-20 h-20 border-4 border-white/10 rounded-full translate-y-1/2"></div>

            <!-- نص تأثيري خفيف -->
            <div class="absolute bottom-4 right-4 text-right">
                <h3 class="text-white/80 text-xs font-bold tracking-widest uppercase">Inspirational</h3>
            </div>
        </div>

        <!-- محتوى البطاقة -->
        <div class="relative px-6 pb-8 text-center">

            <!-- الصورة الشخصية (مع توهج) -->
            <div class="absolute -top-16 left-1/2 transform -translate-x-1/2">
                <div class="relative">
                    <div class="p-1 rounded-full neon-glow" style="background: linear-gradient(45deg, #7c3aed, #db2777);">
                        <img src="{{ $user->img ? asset('storage/' . $user->img) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=7c3aed&color=fff&size=128' }}"
                            alt="{{ $user->name }}"
                            class="w-28 h-28 rounded-full object-cover border-4 border-[#0f0720]">
                    </div>
                    @if($user->is_active)
                    <span class="absolute bottom-1 right-1 w-5 h-5 bg-pink-500 border-2 border-[#0f0720] rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-[10px]"></i>
                    </span>
                    @endif
                </div>
            </div>

            <!-- الاسم والمنصب -->
            <div class="pt-16 mb-4">
                <h1 class="text-2xl font-black text-white tracking-wide">{{ $user->name }}</h1>
                <p class="text-transparent bg-clip-text font-bold text-sm mt-1" style="background-image: linear-gradient(to right, #a78bfa, #f472b6);">
                    {{ $user->job ?? 'Life & Business Coach' }}
                </p>
                @if($user->bio)
                <p class="text-gray-400 text-xs leading-relaxed max-w-xs mx-auto mt-3 italic">
                    "{{ $user->bio }}"
                </p>
                @endif
            </div>

            <!-- مجالات التدريب (Tags) -->
            <div class="flex flex-wrap justify-center gap-2 mb-6">
                <span class="px-3 py-1 text-xs rounded-full bg-purple-500/20 text-purple-300 border border-purple-500/30">Leadership</span>
                <span class="px-3 py-1 text-xs rounded-full bg-pink-500/20 text-pink-300 border border-pink-500/30">Mindset</span>
                <span class="px-3 py-1 text-xs rounded-full bg-orange-500/20 text-orange-300 border border-orange-500/30">Growth</span>
            </div>

            <!-- أزرار التفاعل -->
            <div class="space-y-3 mb-8">

                <!-- زر حجز جلسة (استشارة) -->
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone ?? $user->whatsapp) }}" target="_blank"
                    class="flex items-center justify-center gap-3 w-full coach-gradient text-white font-bold py-4 px-6 rounded-xl transition btn-press shadow-lg">
                    <i class="fas fa-calendar-check text-lg"></i>
                    <span>احجز جلستك الآن</span>
                </a>

                <!-- زر حفظ الاتصال -->
                <a href="{{ route('vcard.download', $user->slug) }}"
                    class="flex items-center justify-center gap-2 w-full bg-transparent border border-white/5 hover:border-white/20 text-gray-400 font-bold py-3 px-6 rounded-xl transition text-sm">
                    <i class="fas fa-download text-gray-500"></i>
                    <span>حفظ جهة الاتصال</span>
                </a>
            </div>

            <!-- روابط السوشيال ميديا -->
            @if($user->socialLinks->count() > 0)
            <div class="border-t border-white/10 pt-6">
                <div class="flex justify-center gap-4">
                    @foreach($user->socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank"
                        class="w-12 h-12 flex items-center justify-center rounded-full bg-white/5 hover:bg-white/10 border border-white/10 hover:border-pink-500 transition group">

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
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        <!-- ذيل البطاقة -->
        <div class="text-center py-3 border-t border-white/10">
            <span class="text-[10px] text-gray-500 uppercase tracking-widest">
                Empower Your Life <span class="text-pink-500">•</span> AVORA
            </span>
        </div>
    </div>

</body>

</html>
