<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - مصور فوتوغرافي</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #0a0a0a;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .viewfinder-border {
            position: relative;
        }

        .viewfinder-border::before,
        .viewfinder-border::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border-color: #E60914;
            border-style: solid;
            transition: all 0.3s ease;
        }

        .viewfinder-border::before {
            top: -2px;
            right: -2px;
            border-width: 2px 2px 0 0;
        }

        .viewfinder-border::after {
            bottom: -2px;
            left: -2px;
            border-width: 0 0 2px 2px;
        }

        .img-container::before,
        .img-container::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border-color: #E60914;
            border-style: solid;
        }

        .img-container::before {
            top: -2px;
            left: -2px;
            border-width: 2px 0 0 2px;
        }

        .img-container::after {
            bottom: -2px;
            right: -2px;
            border-width: 0 2px 2px 0;
        }

        .btn-press:active {
            transform: scale(0.98);
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-[#111111] rounded-none border border-[#222] shadow-2xl overflow-hidden fade-in relative">

        <div class="relative h-64 w-full viewfinder-border">
            @if($user->img_cover)
            <img src="{{ asset('storage/' . $user->img_cover) }}" alt="Cover" class="w-full h-full object-cover opacity-80">
            @else
            <div class="w-full h-full bg-gradient-to-tr from-[#1a1a1a] to-[#2d2d2d] flex items-center justify-center">
                <i class="fas fa-camera text-6xl text-[#333]"></i>
            </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-[#111111] via-transparent to-transparent"></div>
        </div>

        <div class="relative px-6 pb-8 text-center mt-[-60px] z-10">

            <div class="relative w-32 h-32 mx-auto mb-4 img-container p-1 bg-black">
                <img src="{{ $user->img ? asset('storage/' . $user->img) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=1a1a1a&color=fff&size=128&bold=true' }}"
                    alt="{{ $user->name }}"
                    class="w-full h-full object-cover rounded-sm shadow-xl">
            </div>

            <div class="mb-6">
                <h1 class="text-2xl font-bold text-white tracking-wide uppercase">{{ $user->name }}</h1>
                <div class="flex items-center justify-center gap-2 mt-2 text-gray-400">
                    <i class="fas fa-camera-retro text-[#E60914] text-sm"></i>
                    @if($user->job)
                    <span class="text-sm tracking-widest uppercase">{{ $user->job }}</span>
                    @else
                    <span class="text-sm tracking-widest uppercase">مصور فوتوغرافي</span>
                    @endif
                </div>
                @if($user->bio)
                <p class="text-gray-500 text-xs leading-relaxed max-w-xs mx-auto mt-4 border-r-2 border-[#E60914] pr-3">
                    {{ $user->bio }}
                </p>
                @endif
            </div>

            <div class="mb-8">
                <a href="{{ route('vcard.download', $user->slug) }}"
                    class="inline-flex items-center justify-center gap-3 w-full bg-transparent border-2 border-[#E60914] hover:bg-[#E60914] text-[#E60914] hover:text-white font-bold py-3 px-6 transition duration-300 btn-press uppercase tracking-wider text-sm">
                    <i class="fas fa-save"></i>
                    <span>حفظ جهة الاتصال</span>
                </a>
            </div>

            @if($user->socialLinks->count() > 0)
            <div class="space-y-3">
                @foreach($user->socialLinks as $link)
                <a href="{{ $link->url }}" target="_blank"
                    class="flex items-center justify-between bg-[#0a0a0a] border border-[#222] hover:border-[#E60914] rounded-none p-3 transition duration-300 group">

                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 flex items-center justify-center border border-[#333] group-hover:border-[#E60914] transition">
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
                        <span class="text-gray-300 text-sm group-hover:text-white transition">{{ $link->platform->name }}</span>
                    </div>

                    <i class="fas fa-arrow-left text-gray-600 group-hover:text-[#E60914] transition transform group-hover:-translate-x-1"></i>
                </a>
                @endforeach
            </div>
            @endif

        </div>

        <div class="text-center pb-4 pt-4 bg-[#0a0a0a] border-t border-[#1a1a1a]">
            <span class="text-[10px] text-gray-700 tracking-widest uppercase">
                Powered by <span class="text-gray-500">AVORA</span>
            </span>
        </div>
    </div>
</body>

</html>
