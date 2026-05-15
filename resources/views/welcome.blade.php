<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting->site_title ?? 'Aurum | Fine Dining' }}</title>

    <meta name="description" content="{{ $setting->meta_description ?? 'Luxury Fine Dining Experience' }}">

    <!-- Google Fonts for Luxury Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,400&family=Montserrat:wght@200;300;400;500;600&display=swap" rel="stylesheet">

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Icons -->
    @if($setting->icon_180)
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/' . $setting->icon_180) }}">
    @endif

    @if($setting->icon_32)
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/' . $setting->icon_32) }}">
    @endif

    @if($setting->icon_16)
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/' . $setting->icon_16) }}">
    @endif

    @if($setting->manifest)
    <link rel="manifest" href="{{ asset('storage/' . $setting->manifest) }}">
    @endif


    <!-- GSAP for Advanced Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <style>
        :root {
            /* Color Palette */
            --bg-dark: #0a0a0a;
            --bg-charcoal: #121212;
            --bg-card: rgba(255, 255, 255, 0.03);
            --gold-primary: #D4AF37;
            --gold-light: #F4DF8D;
            --gold-dim: #8a701e;
            --text-white: #ffffff;
            --text-muted: #a0a0a0;
            --font-serif: 'Cormorant Garamond', serif;
            --font-sans: 'Montserrat', sans-serif;
            --transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        }

        /* --- Reset & Base Styles --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-white);
            font-family: var(--font-sans);
            overflow-x: hidden;
            line-height: 1.6;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: var(--font-serif);
            font-weight: 400;
            letter-spacing: 0.05em;
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: var(--transition);
        }

        ul {
            list-style: none;
        }

        img {
            max-width: 100%;
            display: block;
        }

        /* --- Utility Classes --- */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .section-padding {
            padding: 100px 0;
        }

        .text-gold {
            color: var(--gold-primary);
        }

        .btn {
            display: inline-block;
            padding: 14px 35px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            border: 1px solid var(--gold-primary);
            color: var(--gold-primary);
            background: transparent;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: var(--gold-primary);
            z-index: -1;
            transition: var(--transition);
        }

        .btn:hover::before {
            width: 100%;
        }

        .btn:hover {
            color: var(--bg-dark);
        }

        .btn-fill {
            background: var(--gold-primary);
            color: var(--bg-dark);
        }

        .btn-fill:hover {
            background: var(--text-white);
            border-color: var(--text-white);
            color: var(--bg-dark);
        }

        /* --- Navigation --- */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 25px 0;
            transition: var(--transition);
            background: transparent;
        }

        .navbar.scrolled {
            background: rgba(10, 10, 10, 0.95);
            padding: 15px 0;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: var(--font-serif);
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-white);
            letter-spacing: 2px;
        }

        .logo-img {
            height: 40px;
            width: 80px
        }

        .logo span {
            color: var(--gold-primary);
        }

        .nav-links {
            display: flex;
            gap: 40px;
        }

        .nav-link {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0%;
            height: 1px;
            background: var(--gold-primary);
            transition: var(--transition);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .lang-switch {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .mobile-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* --- Hero Section --- */
        .hero {
            height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
            opacity: 0.6;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.8) 100%);
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
            max-width: 800px;
            padding: 0 20px;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            text-transform: uppercase;
            letter-spacing: 5px;
            color: var(--gold-primary);
            margin-bottom: 20px;
            display: block;
            opacity: 0;
            /* Animated with GSAP */
            transform: translateY(20px);
        }

        .hero-title {
            font-size: 4.5rem;
            line-height: 1.1;
            margin-bottom: 30px;
            opacity: 0;
            transform: translateY(30px);
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            opacity: 0;
            transform: translateY(40px);
        }

        /* --- About Section --- */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-image-wrapper {
            position: relative;
            overflow: hidden;
        }

        .about-image {
            width: 100%;
            border-radius: 4px;
            transition: transform 1s ease;
        }

        .about-image-wrapper:hover .about-image {
            transform: scale(1.05);
        }

        .about-text h2 {
            font-size: 3rem;
            margin-bottom: 25px;
            color: var(--gold-primary);
        }

        .about-text p {
            color: var(--text-muted);
            margin-bottom: 30px;
            font-size: 1.05rem;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 30px;
        }

        .stat-item h4 {
            font-size: 2.5rem;
            color: var(--text-white);
        }

        .stat-item p {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0;
        }

        /* --- Menu Section --- */
        .menu-section {
            background: var(--bg-charcoal);
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            font-size: 3.5rem;
            color: var(--gold-primary);
            margin-bottom: 10px;
        }

        .menu-filters {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 50px;
        }

        .filter-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            font-family: var(--font-serif);
            font-size: 1.5rem;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .filter-btn.active,
        .filter-btn:hover {
            color: var(--gold-primary);
        }

        .filter-btn::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 1px;
            background: var(--gold-primary);
            transition: width 0.3s;
        }

        .filter-btn.active::after {
            width: 100%;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .menu-item {
            background: var(--bg-card);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            overflow: hidden;
            transition: var(--transition);
            opacity: 0;
            /* Hidden initially for filtering */
            transform: translateY(20px);
        }

        .menu-item.show {
            animation: fadeInItem 0.6s forwards;
        }

        @keyframes fadeInItem {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .menu-item:hover {
            transform: translateY(-10px);
            border-color: var(--gold-dim);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .menu-img-container {
            height: 250px;
            overflow: hidden;
        }

        .menu-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s;
        }

        .menu-item:hover .menu-img {
            transform: scale(1.1);
        }

        .menu-details {
            padding: 25px;
        }

        .dish-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 10px;
            border-bottom: 1px dotted rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
        }

        .dish-name {
            font-family: var(--font-serif);
            font-size: 1.5rem;
            font-weight: 600;
        }

        .dish-price {
            color: var(--gold-primary);
            font-weight: 600;
            font-size: 1.2rem;
        }

        .dish-desc {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* --- Gallery Section --- */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-auto-rows: 300px;
            gap: 15px;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .gallery-item:nth-child(1) {
            grid-column: span 2;
            grid-row: span 2;
            height: 100%;
        }

        .gallery-item:nth-child(2) {
            grid-column: span 1;
        }

        .gallery-item:nth-child(3) {
            grid-column: span 1;
        }

        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }

        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: var(--transition);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .gallery-icon {
            color: var(--gold-primary);
            font-size: 2rem;
            transform: scale(0);
            transition: var(--transition);
        }

        .gallery-item:hover .gallery-img {
            transform: scale(1.1);
        }

        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-item:hover .gallery-icon {
            transform: scale(1);
        }

        /* --- Testimonials Section --- */
        .testimonials-section {
            background: var(--bg-charcoal);
            text-align: center;
        }

        .testimonial-slider {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            min-height: 400px;
        }

        .testimonial-card {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            opacity: 0;
            transition: opacity 1s ease;
            pointer-events: none;
            padding: 20px;
        }

        .testimonial-card.active {
            opacity: 1;
            pointer-events: all;
            position: relative;
        }

        .user-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid var(--gold-primary);
            margin: 0 auto 20px;
            object-fit: cover;
        }

        .testimonial-text {
            font-family: var(--font-serif);
            font-size: 1.8rem;
            font-style: italic;
            margin-bottom: 30px;
            line-height: 1.4;
        }

        .stars {
            color: var(--gold-primary);
            margin-bottom: 15px;
        }

        .user-name {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .slider-dots {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .dot {
            width: 10px;
            height: 10px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            cursor: pointer;
            transition: var(--transition);
        }

        .dot.active {
            background: var(--gold-primary);
        }

        /* --- Reservation Section --- */
        .reservation-section {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('https://picsum.photos/seed/restaurant-interior/1920/1080.jpg') center/cover fixed;
        }

        .reservation-form {
            background: rgba(18, 18, 18, 0.9);
            backdrop-filter: blur(15px);
            padding: 60px;
            max-width: 700px;
            margin: 0 auto;
            border: 1px solid rgba(212, 175, 55, 0.2);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-control {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 15px 0;
            color: var(--text-white);
            font-family: var(--font-sans);
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-bottom-color: var(--gold-primary);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        select.form-control {
            color: rgba(255, 255, 255, 0.7);
        }

        /* --- Contact & Footer --- */
        .contact-section {
            padding-bottom: 0;
        }

        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .contact-info {
            padding: 60px;
            background: var(--bg-charcoal);
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .contact-icon {
            color: var(--gold-primary);
            font-size: 1.5rem;
            margin-right: 20px;
            margin-top: 5px;
        }

        .contact-details h5 {
            font-size: 1.2rem;
            margin-bottom: 5px;
            color: var(--text-white);
        }

        .contact-details p {
            color: var(--text-muted);
        }

        .social-links {
            margin-top: 40px;
        }

        .social-link {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 45px;
            height: 45px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            margin-right: 15px;
            transition: var(--transition);
        }

        .social-link:hover {
            background: var(--gold-primary);
            border-color: var(--gold-primary);
            color: var(--bg-dark);
        }

        .map-frame {
            width: 100%;
            height: 100%;
            min-height: 450px;
            border: 0;
            filter: grayscale(100%) invert(92%) contrast(83%);
        }

        footer {
            background: var(--bg-dark);
            padding: 40px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            text-align: center;
        }

        .footer-logo {
            font-family: var(--font-serif);
            font-size: 1.8rem;
            color: var(--text-white);
            margin-bottom: 20px;
            display: inline-block;
        }

        .copyright {
            color: var(--text-muted);
            font-size: 0.8rem;
        }

        /* --- RTL Support --- */
        [dir="rtl"] {
            text-align: right;
        }

        [dir="rtl"] .navbar .logo {
            margin-right: 0;
            margin-left: 0;
        }

        [dir="rtl"] .nav-links {
            gap: 40px;
        }

        [dir="rtl"] .about-image-wrapper {
            order: 2;
        }

        [dir="rtl"] .about-text {
            order: 1;
        }

        [dir="rtl"] .dish-header {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .contact-icon {
            margin-right: 0;
            margin-left: 20px;
        }

        [dir="rtl"] .social-link {
            margin-right: 0;
            margin-left: 15px;
        }

        /* --- Responsive Design --- */
        @media (max-width: 992px) {
            .hero-title {
                font-size: 3.5rem;
            }

            .about-grid {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .gallery-item:nth-child(1) {
                grid-column: span 2;
            }

            .contact-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .nav-links {
                position: fixed;
                top: 0;
                right: -100%;
                width: 80%;
                height: 100vh;
                background: var(--bg-charcoal);
                flex-direction: column;
                justify-content: center;
                align-items: center;
                transition: 0.5s;
                z-index: 999;
            }

            [dir="rtl"] .nav-links {
                right: auto;
                left: -100%;
            }

            .nav-links.active {
                right: 0;
            }

            [dir="rtl"] .nav-links.active {
                left: 0;
            }

            .mobile-toggle {
                display: block;
                z-index: 1001;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
                grid-auto-rows: 250px;
            }

            .gallery-item:nth-child(1) {
                grid-column: span 1;
                grid-row: span 1;
            }

            .menu-filters {
                gap: 15px;
                flex-wrap: wrap;
            }

            .filter-btn {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container nav-container">
            <a href="#" class="logo flex items-center gap-2">
                @if($setting->logo)
                <img src="{{ asset('storage/' . $setting->logo) }}" alt="{{ $setting->site_name }}" class="logo-img w-auto">
                @else
                <i class="fas fa-utensils text-[#E60914]"></i>
                @endif
            </a>
            <div class="mobile-toggle" id="mobile-toggle">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="nav-links" id="nav-links">
                <li><a href="#home" class="nav-link" data-lang="nav_home">Home</a></li>
                <li><a href="#about" class="nav-link" data-lang="nav_about">About</a></li>
                <li><a href="#menu" class="nav-link" data-lang="nav_menu">Menu</a></li>
                <li><a href="#gallery" class="nav-link" data-lang="nav_gallery">Gallery</a></li>
                <li><a href="#reservation" class="nav-link" data-lang="nav_reservation">Book</a></li>
                <li><a href="#contact" class="nav-link" data-lang="nav_contact">Contact</a></li>
                <li>
                    <div class="lang-switch" id="lang-switch">
                        <i class="fas fa-globe"></i>
                        <span id="current-lang">EN</span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <img src="https://picsum.photos/seed/luxuryfood/1920/1080" class="hero-video" alt="Fine Dining Background">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-subtitle"
                data-content-en="{{ $content->hero_subtitle_en }}"
                data-content-ar="{{ $content->hero_subtitle_ar }}">
                {{ $content->hero_subtitle_en }}
            </span>
            <h1 class="hero-title"
                data-content-en="{{ $content->hero_title_en }}"
                data-content-ar="{{ $content->hero_title_ar }}">
                {{ $content->hero_title_en }}
            </h1>
            <div class="hero-buttons">
                <a href="#reservation" class="btn btn-fill" data-lang="btn_book">Book a Table</a>
                <a href="#menu" class="btn" data-lang="btn_menu">View Menu</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-padding">
        <div class="container">
            <div class="about-grid">
                <div class="about-image-wrapper">
                    <img src="https://picsum.photos/seed/chef/600/700" alt="Executive Chef" class="about-image">
                </div>
                <div class="about-text">
                    <h2 data-content-en="{{ $content->about_title_en }}"
                        data-content-ar="{{ $content->about_title_ar }}">
                        {{ $content->about_title_en }}
                    </h2>
                    <p data-content-en="{{ $content->about_desc_en }}"
                        data-content-ar="{{ $content->about_desc_ar }}">
                        {{ $content->about_desc_en }}
                    </p>
                    <a href="#menu" class="btn" data-lang="about_btn">Discover More</a>

                    <div class="stats-container">
                        <div class="stat-item">
                            <h4>15+</h4>
                            <p data-lang="stat_exp">Years Experience</p>
                        </div>
                        <div class="stat-item">
                            <h4>50k</h4>
                            <p data-lang="stat_happy">Happy Customers</p>
                        </div>
                        <div class="stat-item">
                            <h4>40+</h4>
                            <p data-lang="stat_dishes">Signature Dishes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="section-padding menu-section">
        <div class="container">
            <div class="section-header">
                <h2 data-lang="menu_title">Culinary Masterpieces</h2>
                <p data-lang="menu_subtitle" class="text-gold">Seasonally Inspired | Globally Sourced</p>
            </div>

            <div class="menu-filters">
                <button class="filter-btn active" data-filter="all" data-lang="filter_all">All</button>
                <button class="filter-btn" data-filter="starters" data-lang="filter_starters">Starters</button>
                <button class="filter-btn" data-filter="mains" data-lang="filter_mains">Mains</button>
                <button class="filter-btn" data-filter="desserts" data-lang="filter_desserts">Desserts</button>
                <button class="filter-btn" data-filter="drinks" data-lang="filter_drinks">Drinks</button>
            </div>

            <div class="menu-grid">
                <!-- Starters -->
                <div class="menu-item" data-category="starters">
                    <div class="menu-img-container">
                        <img src="https://picsum.photos/seed/food1/400/300" alt="Dish" class="menu-img">
                    </div>
                    <div class="menu-details">
                        <div class="dish-header">
                            <h3 class="dish-name" data-lang="dish1_name">Truffle Arancini</h3>
                            <span class="dish-price">$24</span>
                        </div>
                        <p class="dish-desc" data-lang="dish1_desc">Wild mushroom risotto balls, black truffle aioli, parmesan dust.</p>
                    </div>
                </div>

                <!-- Mains -->
                <div class="menu-item" data-category="mains">
                    <div class="menu-img-container">
                        <img src="https://picsum.photos/seed/food2/400/300" alt="Dish" class="menu-img">
                    </div>
                    <div class="menu-details">
                        <div class="dish-header">
                            <h3 class="dish-name" data-lang="dish2_name">Wagyu Beef Tenderloin</h3>
                            <span class="dish-price">$85</span>
                        </div>
                        <p class="dish-desc" data-lang="dish2_desc">A5 Japanese Wagyu, garlic confit, roasted root vegetables, red wine reduction.</p>
                    </div>
                </div>

                <!-- Desserts -->
                <div class="menu-item" data-category="desserts">
                    <div class="menu-img-container">
                        <img src="https://picsum.photos/seed/food3/400/300" alt="Dish" class="menu-img">
                    </div>
                    <div class="menu-details">
                        <div class="dish-header">
                            <h3 class="dish-name" data-lang="dish3_name">Golden Sphere</h3>
                            <span class="dish-price">$22</span>
                        </div>
                        <p class="dish-desc" data-lang="dish3_desc">Chocolate sphere, gold leaf, passion fruit core, vanilla bean gelato.</p>
                    </div>
                </div>

                <!-- Drinks -->
                <div class="menu-item" data-category="drinks">
                    <div class="menu-img-container">
                        <img src="https://picsum.photos/seed/drink1/400/300" alt="Dish" class="menu-img">
                    </div>
                    <div class="menu-details">
                        <div class="dish-header">
                            <h3 class="dish-name" data-lang="dish4_name">Smoked Old Fashioned</h3>
                            <span class="dish-price">$18</span>
                        </div>
                        <p class="dish-desc" data-lang="dish4_desc">Bourbon, maple syrup, angostura bitters, hickory smoke infusion.</p>
                    </div>
                </div>

                <!-- More Starters -->
                <div class="menu-item" data-category="starters">
                    <div class="menu-img-container">
                        <img src="https://picsum.photos/seed/food5/400/300" alt="Dish" class="menu-img">
                    </div>
                    <div class="menu-details">
                        <div class="dish-header">
                            <h3 class="dish-name" data-lang="dish5_name">Scallop Crudo</h3>
                            <span class="dish-price">$28</span>
                        </div>
                        <p class="dish-desc" data-lang="dish5_desc">Hokkaido scallops, yuzu pearls, radish, micro cilantro.</p>
                    </div>
                </div>

                <!-- More Mains -->
                <div class="menu-item" data-category="mains">
                    <div class="menu-img-container">
                        <img src="https://picsum.photos/seed/food6/400/300" alt="Dish" class="menu-img">
                    </div>
                    <div class="menu-details">
                        <div class="dish-header">
                            <h3 class="dish-name" data-lang="dish6_name">Pan Seared Scallops</h3>
                            <span class="dish-price">$45</span>
                        </div>
                        <p class="dish-desc" data-lang="dish6_desc">Cauliflower purée, crispy pancetta, caper butter sauce.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="section-padding">
        <div class="container">
            <div class="section-header">
                <h2 data-lang="gallery_title">Visual Feast</h2>
                <p class="text-gold" data-lang="gallery_subtitle">Atmosphere & Plating</p>
            </div>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="https://picsum.photos/seed/restaurant1/600/600" alt="Gallery" class="gallery-img">
                    <div class="gallery-overlay"><i class="fas fa-search-plus gallery-icon"></i></div>
                </div>
                <div class="gallery-item">
                    <img src="https://picsum.photos/seed/restaurant2/400/400" alt="Gallery" class="gallery-img">
                    <div class="gallery-overlay"><i class="fas fa-search-plus gallery-icon"></i></div>
                </div>
                <div class="gallery-item">
                    <img src="https://picsum.photos/seed/restaurant3/400/400" alt="Gallery" class="gallery-img">
                    <div class="gallery-overlay"><i class="fas fa-search-plus gallery-icon"></i></div>
                </div>
                <div class="gallery-item">
                    <img src="https://picsum.photos/seed/restaurant4/400/400" alt="Gallery" class="gallery-img">
                    <div class="gallery-overlay"><i class="fas fa-search-plus gallery-icon"></i></div>
                </div>
                <div class="gallery-item">
                    <img src="https://picsum.photos/seed/restaurant5/400/400" alt="Gallery" class="gallery-img">
                    <div class="gallery-overlay"><i class="fas fa-search-plus gallery-icon"></i></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="section-padding testimonials-section">
        <div class="container">
            <div class="testimonial-slider">
                <div class="testimonial-card active" data-index="0">
                    <img src="https://picsum.photos/seed/person1/100/100" alt="User" class="user-img">
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text" data-lang="review1_text">"An absolutely transcendent experience. The tasting menu was a journey through flavors I didn't know existed. Impeccable service."</p>
                    <h5 class="user-name">- Sophia Laurent</h5>
                </div>
                <div class="testimonial-card" data-index="1">
                    <img src="https://picsum.photos/seed/person2/100/100" alt="User" class="user-img">
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text" data-lang="review2_text">"The ambiance is purely cinematic. Dark, moody, and luxurious. The wagyu beef was cooked to perfection. Highly recommended."</p>
                    <h5 class="user-name">- James Sterling</h5>
                </div>
                <div class="testimonial-card" data-index="2">
                    <img src="https://picsum.photos/seed/person3/100/100" alt="User" class="user-img">
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="testimonial-text" data-lang="review3_text">"A hidden gem in the city. The wine pairing is genius. A bit pricey, but worth every penny for a special occasion."</p>
                    <h5 class="user-name">- Amira Al-Fayed</h5>
                </div>

                <div class="slider-dots" id="slider-dots">
                    <div class="dot active" onclick="setSlide(0)"></div>
                    <div class="dot" onclick="setSlide(1)"></div>
                    <div class="dot" onclick="setSlide(2)"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reservation Section -->
    <section id="reservation" class="section-padding reservation-section">
        <div class="container">
            <div class="section-header">
                <h2 data-lang="book_title">Reserve Your Table</h2>
                <p class="text-gold" data-lang="book_subtitle">Secure your evening of indulgence</p>
            </div>

            <form action="{{ route('reservations.store') }}" method="POST" class="reservation-form" id="bookingForm">
                @if(session('status'))
                <div style=" top: 80px; right: 20px; background: #D4AF37; color: #000; padding: 15px 25px; border-radius: 4px; z-index: 3000; box-shadow: 0 5px 15px rgba(0,0,0,0.3);">
                    {{ session('status') }}
                </div>
                @endif
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <input name="name" type="text" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input name="phone" type="tel" class="form-control" placeholder="Phone Number" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <input name="reservation_date" type="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <select name="reservation_time" class="form-control">
                            <option value="" disabled selected>Time</option>
                            <option value="18:00">6:00 PM</option>
                            <option value="19:00">7:00 PM</option>
                            <option value="20:00">8:00 PM</option>
                            <option value="21:00">9:00 PM</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <select name="guests" class="form-control">
                            <option value="" disabled selected>Guests</option>
                            <option value="1">1 Person</option>
                            <option value="2">2 People</option>
                            <option value="3">3 People</option>
                            <option value="4">4 People</option>
                            <option value="5">5+ People</option>
                        </select>
                    </div>
                    <div class="form-group" style="display: flex; align-items: center;">
                        <button type="submit" class="btn btn-fill" style="width: 100%;" data-lang="btn_confirm">Confirm Booking</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section-padding contact-section">
        <div class="contact-container">
            <div class="contact-info">
                <h2 style="margin-bottom: 30px; color: var(--gold-primary);" data-lang="contact_title">Contact Us</h2>

                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="contact-details">
                        <h5 data-lang="contact_addr_title">Address</h5>
                        <p data-content-en="{{ $setting->address_en }}" data-content-ar="{{ $setting->address_ar }}">
                            {{ $setting->address_en }}
                        </p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-phone"></i></div>
                    <div class="contact-details">
                        <h5 data-lang="contact_phone_title">Phone</h5>
                        <p dir="ltr">{{ $setting->mobile }}</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div class="contact-details">
                        <h5 data-lang="contact_email_title">Email</h5>

                        <a href="mailto:{{ $setting->email }}" class="hover:text-[#E60914] transition">
                            <p>{{ $setting->email }}</p>
                        </a>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-clock"></i></div>
                    <div class="contact-details">
                        <h5 data-lang="contact_hours_title">Opening Hours</h5>
                        <p data-content-en="{{ $setting->hours_en }}" data-content-ar="{{ $setting->hours_ar }}">
                            {{ $setting->hours_en }}
                        </p>
                    </div>
                </div>

                <div class="social-links">
                    @if($setting->facebook)
                    <a href="{{ $setting->facebook }}" target="_blank" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if($setting->instagram)
                    <a href="{{ $setting->instagram }}" target="_blank" class="social-link"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($setting->twitter)
                    <a href="{{ $setting->twitter }}" target="_blank" class="social-link"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if($setting->snapchat)
                    <a href="{{ $setting->snapchat }}" target="_blank" class="social-link"><i class="fab fa-snapchat-ghost"></i></a>
                    @endif
                    @if($setting->tiktok)
                    <a href="{{ $setting->tiktok }}" target="_blank" class="social-link"><i class="fab fa-tiktok"></i></a>
                    @endif
                </div>
            </div>
            <div class="map-wrapper">
                {!! $setting->map_link !!}
            </div>
        </div>
    </section>
    <section id="faq" class="section-padding bg-[#111]">
        <div class="container">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-white mb-4" data-lang="faq_title">الأسئلة الشائعة</h2>
                <p class="text-gray-400" data-lang="faq_subtitle">لدينا إجابات لكل استفساراتكم</p>
            </div>

            <div class="max-w-4xl mx-auto space-y-4">
                @forelse($faqs as $faq)
                <!-- سؤال واحد -->
                <div class="border border-[#1a1a1a] rounded-lg overflow-hidden bg-[#0a0a0a] transition duration-300">
                    <!-- زر السؤال -->
                    <button onclick="toggleFaq(this)" class="w-full text-left px-6 py-4 flex justify-between items-center focus:outline-none group">
                        <div>
                            <span class="text-white font-bold text-lg block data-content-wrapper"
                                data-content-en="{{ $faq->question_en }}"
                                data-content-ar="{{ $faq->question_ar }}">
                                {{ $faq->question_en }}
                            </span>
                        </div>
                        <i class="fas fa-plus text-[#E60914] group-hover:text-white transition duration-300 transform"></i>
                    </button>

                    <!-- الإجابة (مخفية افتراضياً) -->
                    <div class="faq-answer hidden max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <div class="px-6 pb-6 pt-2 text-gray-300 leading-relaxed text-sm border-t border-[#1a1a1a] mt-2 data-content-wrapper"
                            data-content-en="{{ $faq->answer_en }}"
                            data-content-ar="{{ $faq->answer_ar }}">
                            {{ $faq->answer_en }}
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-500">لا توجد أسئلة حالياً.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <a href="#" class="footer-logo flex items-center justify-center gap-2">
                @if($setting->logo)
                <img src="{{ asset('storage/' . $setting->logo) }}" class="logo-img w-auto">
                @endif
                {{ $setting->site_name ?? 'AURUM' }}<span>.</span>
            </a>
            <p class="copyright">&copy; 2023 {{ $setting->site_name ?? 'Aurum Restaurant' }}. All Rights Reserved.</p>
            <div style="margin-top: 20px;">
                <input type="email" placeholder="Subscribe to our newsletter" style="padding: 10px; border: 1px solid #333; background: #000; color: #fff;">
                <button class="btn" style="padding: 10px 20px; font-size: 0.7rem;">GO</button>
            </div>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div id="toast" style="position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%); background: var(--gold-primary); color: #000; padding: 15px 30px; border-radius: 4px; font-weight: 600; opacity: 0; pointer-events: none; transition: opacity 0.3s; z-index: 2000;">
        Table Booked Successfully!
    </div>

    <script>
        // --- Translations ---
        const translations = {
            en: {
                nav_home: "Home",
                nav_about: "About",
                nav_menu: "Menu",
                nav_gallery: "Gallery",
                nav_reservation: "Book",
                nav_contact: "Contact",
                hero_subtitle: "Experience the Extraordinary",
                hero_title: "Taste the Art of Perfection",
                btn_book: "Book a Table",
                btn_menu: "View Menu",
                about_title: "Our Story",
                about_desc: "Founded in 2010, Aurum represents the pinnacle of culinary excellence. Our philosophy is simple: source the finest ingredients, treat them with respect, and transform them into unforgettable memories. Under the guidance of Executive Chef Alessandro Marco, we invite you on a journey through flavor, texture, and emotion.",
                about_btn: "Discover More",
                stat_exp: "Years Experience",
                stat_happy: "Happy Customers",
                stat_dishes: "Signature Dishes",
                menu_title: "Culinary Masterpieces",
                menu_subtitle: "Seasonally Inspired | Globally Sourced",
                filter_all: "All",
                filter_starters: "Starters",
                filter_mains: "Mains",
                filter_desserts: "Desserts",
                filter_drinks: "Drinks",
                dish1_name: "Truffle Arancini",
                dish1_desc: "Wild mushroom risotto balls, black truffle aioli, parmesan dust.",
                dish2_name: "Wagyu Beef Tenderloin",
                dish2_desc: "A5 Japanese Wagyu, garlic confit, roasted root vegetables, red wine reduction.",
                dish3_name: "Golden Sphere",
                dish3_desc: "Chocolate sphere, gold leaf, passion fruit core, vanilla bean gelato.",
                dish4_name: "Smoked Old Fashioned",
                dish4_desc: "Bourbon, maple syrup, angostura bitters, hickory smoke infusion.",
                dish5_name: "Scallop Crudo",
                dish5_desc: "Hokkaido scallops, yuzu pearls, radish, micro cilantro.",
                dish6_name: "Pan Seared Scallops",
                dish6_desc: "Cauliflower purée, crispy pancetta, caper butter sauce.",
                gallery_title: "Visual Feast",
                gallery_subtitle: "Atmosphere & Plating",
                review1_text: "\"An absolutely transcendent experience. The tasting menu was a journey through flavors I didn't know existed. Impeccable service.\"",
                review2_text: "\"The ambiance is purely cinematic. Dark, moody, and luxurious. The wagyu beef was cooked to perfection. Highly recommended.\"",
                review3_text: "\"A hidden gem in the city. The wine pairing is genius. A bit pricey, but worth every penny for a special occasion.\"",
                book_title: "Reserve Your Table",
                book_subtitle: "Secure your evening of indulgence",
                btn_confirm: "Confirm Booking",
                contact_title: "Contact Us",
                contact_addr_title: "Address",
                contact_addr_val: "123 Luxury Avenue, Golden District, Dubai, UAE",
                contact_phone_title: "Phone",
                contact_email_title: "Email",
                contact_hours_title: "Opening Hours",
                contact_hours_val: "Daily: 6:00 PM - 11:30 PM"
            },
            ar: {
                nav_home: "الرئيسية",
                nav_about: "قصتنا",
                nav_menu: "القائمة",
                nav_gallery: "المعرض",
                nav_reservation: "حجز",
                nav_contact: "اتصل بنا",
                hero_subtitle: "اختبر الاستثنائي",
                hero_title: "تذوق فن الكمال",
                btn_book: "احجز طاولة",
                btn_menu: "تصفح القائمة",
                about_title: "قصتنا",
                about_desc: "تأسس أوروم في عام 2010، ويمثل قمة التميز الطهوي. فلسفتنا بسيطة: الحصول على أجود المكونات، ومعاملتها باحترام، وتحويلها إلى ذكريات لا تُنسى. تحت إشراف الشيف التنفيذي أليساندرو ماركو، ندعوك في رحلة عبر النكهة والملمس والمشاعر.",
                about_btn: "اكتشف المزيد",
                stat_exp: "سنوات خبرة",
                stat_happy: "عملاء سعداء",
                stat_dishes: "أطباق مميزة",
                menu_title: "روائع الطهي",
                menu_subtitle: "إلهام موسمي | مصادر عالمية",
                filter_all: "الكل",
                filter_starters: "المقبلات",
                filter_mains: "الأطباق الرئيسية",
                filter_desserts: "الحلويات",
                filter_drinks: "المشروبات",
                dish1_name: "أرنشيني الترافل",
                dish1_desc: "كرات أرز بالفطر البري، أليولي الترافل الأسود، غبار بارميزان.",
                dish2_name: "فيليه واجي ياكي",
                dish2_desc: "واجي ياباني A5، ثوم مملح، خضروات جذرية مشوية، صلصة النبيذ الأحمر.",
                dish3_name: "الكرة الذهبية",
                dish3_desc: "كرة شوكولاتة، ورق ذهبي، قلب فاكهة الباشن فروت، جيلاتي فانيلا.",
                dish4_name: "أولد فاشن المدخن",
                dish4_desc: "بوربون، شراب القيقب، مرارة أنجوستورا، دخان Hickoky.",
                dish5_name: "سكلوب كرودو",
                dish5_desc: "سكلوب هوكايدو، لآلئ اليوزو، فجل، كزبرة صغيرة.",
                dish6_name: "سكلوب مقلي",
                dish6_desc: "هريس القرنبيط، بانشيتا مقرمشة، صلصة الكابر.",
                gallery_title: "وليمة بصرية",
                gallery_subtitle: "الأجواء والتقديم",
                review1_text: "\"تجربة متسامية تمامًا. كانت قائمة التذوق رحلة عبر نكهات لم أكن أعرف بوجودها. خدمة لا تشوبها شائبة.\"",
                review2_text: "\"الأجواء سينمائية بحتة. مظلمة، كئيبة، وفاخرة. لحم الواجي مطهو بدقة. أوصي بشدة به.\"",
                review3_text: "\"جوهرة مخفية في المدينة. اقتران النبيذ عبقري. باهظ الثمن قليلاً، ولكنه يستحق كل قرش لمناسبة خاصة.\"",
                book_title: "احجز طاولتك",
                book_subtitle: "تأمين مساء من الترف",
                btn_confirm: "تأكيد الحجز",
                contact_title: "اتصل بنا",
                contact_addr_title: "العنوان",
                contact_addr_val: "123 شارع الفخامة، حي الذهب، دبي، الإمارات",
                contact_phone_title: "الهاتف",
                contact_email_title: "البريد الإلكتروني",
                contact_hours_title: "ساعات العمل",
                contact_hours_val: "يومياً: 6:00 مساءً - 11:30 مساءً"
            }
        };

        // --- Language Switching Logic with LocalStorage Persistence ---

        // Check local storage for saved language, default to 'en' if not found
        const savedLang = localStorage.getItem('aurumLang') || 'en';
        let currentLanguage = savedLang;

        const langSwitcher = document.getElementById('lang-switch');
        const currentLangDisplay = document.getElementById('current-lang');

        langSwitcher.addEventListener('click', () => {
            currentLanguage = currentLanguage === 'en' ? 'ar' : 'en';

            // SAVE THE NEW LANGUAGE TO LOCAL STORAGE
            localStorage.setItem('aurumLang', currentLanguage);

            updateLanguage();
        });

        function updateLanguage() {
            // 1. تحديث اتجاه الصفحة
            const html = document.documentElement;
            html.setAttribute('dir', currentLanguage === 'ar' ? 'rtl' : 'ltr');
            html.setAttribute('lang', currentLanguage);

            // 2. تحديث زر اللغة
            currentLangDisplay.textContent = currentLanguage === 'en' ? 'EN' : 'عربي';

            // 3. تحديث النصوص الثابتة (الكود الموجود عندك حالياً)
            document.querySelectorAll('[data-lang]').forEach(el => {
                const key = el.getAttribute('data-lang');
                if (translations[currentLanguage][key]) {
                    el.textContent = translations[currentLanguage][key];
                }
            });

            // 4. --- الكود المفقود (تحديث النصوص الديناميكية من قاعدة البيانات) ---
            // هذا الجزء يقوم بالبحث عن العناصر التي تحمل البيانات من الداتا بيس
            document.querySelectorAll('[data-content-en]').forEach(el => {
                const text = currentLanguage === 'ar' ?
                    el.getAttribute('data-content-ar') // إذا عربي خذ القيمة العربية
                    :
                    el.getAttribute('data-content-en'); // إذا إنجليزي خذ القيمة الإنجليزية

                // إذا وجد نص، قم بتحديثه
                if (text && text.trim() !== "") {
                    el.textContent = text;
                }
            });
        }

        // Initialize language on page load
        updateLanguage();

        // --- Sticky Navbar ---
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // --- Mobile Menu ---
        const mobileToggle = document.getElementById('mobile-toggle');
        const navLinks = document.getElementById('nav-links');

        mobileToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            const icon = mobileToggle.querySelector('i');
            if (navLinks.classList.contains('active')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
                mobileToggle.querySelector('i').classList.remove('fa-times');
                mobileToggle.querySelector('i').classList.add('fa-bars');
            });
        });

        // --- GSAP Animations ---
        gsap.registerPlugin(ScrollTrigger);

        // Hero Animations
        const heroTl = gsap.timeline();
        heroTl.to(".hero-subtitle", {
                opacity: 1,
                y: 0,
                duration: 1,
                delay: 0.5
            })
            .to(".hero-title", {
                opacity: 1,
                y: 0,
                duration: 1
            }, "-=0.5")
            .to(".hero-buttons", {
                opacity: 1,
                y: 0,
                duration: 1
            }, "-=0.5");

        // About Section Fade In
        gsap.from(".about-text", {
            scrollTrigger: {
                trigger: "#about",
                start: "top 70%"
            },
            y: 50,
            opacity: 0,
            duration: 1
        });

        // Menu Items Stagger
        gsap.from(".menu-item", {
            scrollTrigger: {
                trigger: "#menu",
                start: "top 75%"
            },
            y: 50,
            opacity: 0,
            duration: 0.8,
            stagger: 0.1
        });

        // --- Menu Filtering ---
        const filterBtns = document.querySelectorAll('.filter-btn');
        const menuItems = document.querySelectorAll('.menu-item');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class from all buttons
                filterBtns.forEach(b => b.classList.remove('active'));
                // Add active to clicked
                btn.classList.add('active');

                const filterValue = btn.getAttribute('data-filter');

                menuItems.forEach(item => {
                    item.classList.remove('show'); // Reset animation class

                    if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                        item.style.display = 'block';
                        // Small timeout to allow display:block to apply before opacity animation
                        setTimeout(() => item.classList.add('show'), 10);
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // --- Testimonial Slider ---
        let currentSlide = 0;
        const slides = document.querySelectorAll('.testimonial-card');
        const dots = document.querySelectorAll('.dot');

        function setSlide(index) {
            // Remove active classes
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            // Set new active
            currentSlide = index;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }

        // Auto slide
        setInterval(() => {
            let next = (currentSlide + 1) % slides.length;
            setSlide(next);
        }, 5000);

        // --- Form Submission ---
        const form = document.getElementById('bookingForm');
        const toast = document.getElementById('toast');

        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const btn = form.querySelector('button');
            const originalText = btn.innerText;

            btn.innerText = "Processing...";
            btn.disabled = true;

            try {
                const formData = new FormData(form);

                const response = await fetch("{{ route('reservations.store') }}", {
                    method: "POST",
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    form.reset();
                    showToast(data.message);
                } else {
                    showToast("Something went wrong");
                }

            } catch (error) {
                showToast("Server error");
            }

            btn.innerText = originalText;
            btn.disabled = false;
        });

        function showToast(message) {
            toast.innerText = message;
            toast.style.opacity = '1';
            toast.style.bottom = '50px';

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.bottom = '30px';
            }, 3000);
        }
    </script>
</body>

</html>
