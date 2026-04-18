<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAMPAY — Solusi Cerdas Pengelolaan Sampah</title>
    <meta name="description" content="Platform digital pengelolaan sampah berbasis komunitas. Lapor, Jemput, Tukar Reward.">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* ========== Reset & Base ========== */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        
        :root {
            --green-50: #ecfdf5;
            --green-100: #d1fae5;
            --green-200: #a7f3d0;
            --green-400: #34d399;
            --green-500: #10b981;
            --green-600: #059669;
            --green-700: #047857;
            --green-800: #065f46;
            --green-900: #064e3b;

            --slate-50: #f8fafc;
            --slate-100: #f1f5f9;
            --slate-200: #e2e8f0;
            --slate-300: #cbd5e1;
            --slate-400: #94a3b8;
            --slate-500: #64748b;
            --slate-600: #475569;
            --slate-700: #334155;
            --slate-800: #1e293b;
            --slate-900: #0f172a;
            --slate-950: #020617;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--slate-800);
            background: #ffffff;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        a { text-decoration: none; color: inherit; }
        img { max-width: 100%; display: block; }

        /* ========== Layout ========== */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }

        /* ========== Typography ========== */
        .section-eyebrow {
            display: inline-block;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: var(--green-600);
            margin-bottom: 16px;
        }
        .section-title {
            font-size: clamp(28px, 5vw, 44px);
            font-weight: 900;
            color: var(--slate-900);
            line-height: 1.15;
            letter-spacing: -0.03em;
        }
        .section-subtitle {
            font-size: 17px;
            color: var(--slate-500);
            line-height: 1.7;
            max-width: 600px;
        }

        /* ========== Navbar ========== */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--slate-100);
            transition: box-shadow 0.3s ease;
        }
        .navbar.scrolled { box-shadow: 0 4px 20px rgba(0,0,0,0.06); }
        .navbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
        }
        .nav-logo { display: flex; align-items: center; gap: 12px; }
        .nav-logo img { height: 36px; width: auto; }
        .nav-logo span { font-weight: 800; font-size: 20px; color: var(--slate-900); letter-spacing: -0.02em; }
        .nav-links { display: flex; align-items: center; gap: 36px; }
        .nav-links a { font-size: 14px; font-weight: 600; color: var(--slate-600); transition: color 0.2s; }
        .nav-links a:hover { color: var(--green-600); }
        .nav-cta {
            display: inline-flex; align-items: center; gap: 8px;
            background: linear-gradient(135deg, var(--green-500), var(--green-700));
            color: #fff; font-size: 14px; font-weight: 700;
            padding: 10px 28px; border-radius: 999px;
            box-shadow: 0 4px 16px rgba(16,185,129,0.3);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .nav-cta:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(16,185,129,0.4); }
        .nav-mobile { display: none; }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .nav-mobile { display: block; }
        }

        /* ========== Hero ========== */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 72px;
            overflow: hidden;
            background: var(--slate-50);
        }
        .hero::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background-image: radial-gradient(var(--slate-200) 1px, transparent 1px);
            background-size: 32px 32px;
            opacity: 0.5;
        }
        .hero-grid {
            position: relative; z-index: 2;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            padding: 80px 0;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--green-50);
            border: 1px solid var(--green-200);
            padding: 6px 16px;
            border-radius: 999px;
            font-size: 13px; font-weight: 700; color: var(--green-700);
            margin-bottom: 24px;
        }
        .hero-badge .dot {
            width: 8px; height: 8px; border-radius: 50%;
            background: var(--green-500);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.3); }
        }
        .hero-title {
            font-size: clamp(36px, 6vw, 64px);
            font-weight: 900;
            line-height: 1.08;
            letter-spacing: -0.04em;
            color: var(--slate-900);
            margin-bottom: 24px;
        }
        .hero-title .accent {
            background: linear-gradient(135deg, var(--green-600), var(--green-400));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-text {
            font-size: 18px;
            color: var(--slate-500);
            line-height: 1.7;
            margin-bottom: 40px;
            max-width: 480px;
        }
        .hero-actions { display: flex; gap: 16px; flex-wrap: wrap; }
        .btn-hero-primary {
            display: inline-flex; align-items: center; gap: 10px;
            background: linear-gradient(135deg, var(--green-500), var(--green-700));
            color: #fff; font-size: 16px; font-weight: 700;
            padding: 16px 36px; border-radius: 999px; border: 0;
            box-shadow: 0 8px 24px rgba(16,185,129,0.35);
            transition: all 0.3s ease; cursor: pointer;
        }
        .btn-hero-primary:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(16,185,129,0.45); }
        .btn-hero-secondary {
            display: inline-flex; align-items: center;
            background: #fff;
            color: var(--slate-800); font-size: 16px; font-weight: 700;
            padding: 16px 36px; border-radius: 999px;
            border: 2px solid var(--slate-200);
            transition: all 0.3s ease; cursor: pointer;
        }
        .btn-hero-secondary:hover { border-color: var(--green-300); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.05); }

        /* Hero Visual */
        .hero-visual { position: relative; }
        .hero-phone {
            width: 280px; margin: 0 auto;
            background: var(--slate-900); border-radius: 40px; padding: 12px;
            box-shadow: 0 40px 80px rgba(0,0,0,0.15), 0 0 0 1px rgba(255,255,255,0.1) inset;
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-16px); }
        }
        .phone-screen { background: #fff; border-radius: 28px; overflow: hidden; }
        .phone-notch { height: 24px; background: var(--slate-900); display: flex; justify-content: center; padding-top: 8px; }
        .phone-notch-pill { width: 80px; height: 6px; background: var(--slate-700); border-radius: 99px; }
        .phone-header {
            background: linear-gradient(135deg, var(--green-500), var(--green-700));
            padding: 20px 20px 40px;
            color: #fff;
        }
        .phone-header-greeting { font-size: 12px; opacity: 0.85; margin-bottom: 4px; }
        .phone-header-points { font-size: 28px; font-weight: 800; letter-spacing: -0.03em; }
        .phone-header-points span { font-size: 14px; font-weight: 600; opacity: 0.8; }
        .phone-body { padding: 0 16px 20px; margin-top: -20px; }
        .phone-card {
            background: #fff;
            border: 1px solid var(--slate-100);
            border-radius: 16px;
            padding: 16px;
            display: flex; align-items: center; gap: 14px;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }
        .phone-card-icon {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }
        .phone-card-icon.blue { background: #eff6ff; color: #3b82f6; }
        .phone-card-icon.amber { background: #fffbeb; color: #f59e0b; }
        .phone-card-icon.green { background: var(--green-50); color: var(--green-600); }
        .phone-card-title { font-size: 14px; font-weight: 700; color: var(--slate-800); }
        .phone-card-desc { font-size: 11px; color: var(--slate-400); margin-top: 2px; }

        /* Floating badges on hero */
        .hero-float-badge {
            position: absolute; z-index: 10;
            background: #fff; border-radius: 20px; padding: 16px 20px;
            display: flex; align-items: center; gap: 14px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border: 1px solid var(--slate-100);
        }
        .hero-float-badge.top-right {
            top: 20px; right: -30px;
            animation: float 6s ease-in-out infinite;
            animation-delay: -2s;
        }
        .hero-float-badge.bottom-left {
            bottom: 40px; left: -40px;
            animation: float 6s ease-in-out infinite;
            animation-delay: -4s;
        }
        .float-icon {
            width: 48px; height: 48px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .float-label { font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.1em; color: var(--slate-400); }
        .float-value { font-size: 18px; font-weight: 800; color: var(--slate-900); margin-top: 2px; }

        @media (max-width: 1024px) {
            .hero-grid { grid-template-columns: 1fr; text-align: center; gap: 48px; }
            .hero-text { margin-left: auto; margin-right: auto; }
            .hero-actions { justify-content: center; }
            .hero-float-badge { display: none; }
        }

        /* ========== Steps Section ========== */
        .steps { padding: 120px 0; background: #fff; }
        .steps-header { text-align: center; margin-bottom: 64px; }
        .steps-header .section-subtitle { margin: 16px auto 0; }
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 32px;
        }
        .step-card {
            background: var(--slate-50);
            border: 1px solid var(--slate-100);
            border-radius: 24px;
            padding: 40px 28px;
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        .step-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--green-400), var(--green-600));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s ease;
        }
        .step-card:hover::before { transform: scaleX(1); }
        .step-card:hover { border-color: var(--green-200); transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.06); }
        .step-number {
            display: inline-flex; align-items: center; justify-content: center;
            width: 56px; height: 56px; border-radius: 16px;
            background: linear-gradient(135deg, var(--green-500), var(--green-700));
            color: #fff; font-size: 22px; font-weight: 900;
            margin-bottom: 24px;
            box-shadow: 0 8px 16px rgba(16,185,129,0.25);
        }
        .step-title { font-size: 20px; font-weight: 800; color: var(--slate-900); margin-bottom: 12px; }
        .step-desc { font-size: 14px; color: var(--slate-500); line-height: 1.7; }

        @media (max-width: 1024px) { .steps-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) { .steps-grid { grid-template-columns: 1fr; } }

        /* ========== Features Section ========== */
        .features { padding: 120px 0; background: var(--slate-50); }
        .feature-block {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            margin-bottom: 100px;
        }
        .feature-block:last-child { margin-bottom: 0; }
        .feature-block.reverse .feature-content { order: 2; }
        .feature-block.reverse .feature-image { order: 1; }
        .feature-image-wrapper {
            position: relative;
            border-radius: 32px; overflow: hidden;
            box-shadow: 0 30px 60px rgba(0,0,0,0.08);
        }
        .feature-image-wrapper img { width: 100%; height: 400px; object-fit: cover; }
        .feature-image-wrapper::after {
            content: '';
            position: absolute; inset: 0;
            border-radius: 32px;
            box-shadow: inset 0 0 0 1px rgba(0,0,0,0.06);
        }
        .feature-content .section-title { margin-bottom: 20px; }
        .feature-content .section-subtitle { margin-bottom: 32px; max-width: none; }
        .feature-checklist { list-style: none; }
        .feature-checklist li {
            display: flex; align-items: center; gap: 12px;
            font-size: 16px; font-weight: 700; color: var(--slate-800);
            margin-bottom: 16px;
        }
        .check-icon {
            width: 24px; height: 24px; border-radius: 50%;
            background: var(--green-100); color: var(--green-600);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .stat-row { display: flex; gap: 24px; margin-top: 32px; }
        .stat-box {
            background: #fff;
            border: 1px solid var(--slate-100);
            border-radius: 20px; padding: 24px 28px;
            text-align: center; flex: 1;
        }
        .stat-value { font-size: 32px; font-weight: 900; color: var(--green-600); letter-spacing: -0.03em; }
        .stat-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; color: var(--slate-400); margin-top: 4px; }

        @media (max-width: 1024px) {
            .feature-block { grid-template-columns: 1fr; gap: 40px; }
            .feature-block.reverse .feature-content { order: 1; }
            .feature-block.reverse .feature-image { order: 2; }
        }

        /* ========== CTA Section ========== */
        .cta { padding: 120px 0; background: #fff; }
        .cta-card {
            background: var(--slate-900);
            border-radius: 48px;
            padding: 80px 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .cta-card::before {
            content: '';
            position: absolute; top: -200px; left: -200px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(16,185,129,0.15), transparent 60%);
        }
        .cta-card::after {
            content: '';
            position: absolute; bottom: -200px; right: -200px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(16,185,129,0.1), transparent 60%);
        }
        .cta-inner { position: relative; z-index: 2; }
        .cta-title {
            font-size: clamp(28px, 5vw, 48px);
            font-weight: 900;
            color: #fff;
            line-height: 1.15;
            letter-spacing: -0.03em;
            margin-bottom: 20px;
        }
        .cta-text { font-size: 17px; color: var(--slate-400); margin-bottom: 40px; max-width: 520px; margin-left: auto; margin-right: auto; line-height: 1.7; }
        .cta-actions { display: flex; justify-content: center; gap: 16px; flex-wrap: wrap; }
        .btn-cta-primary {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--green-500); color: var(--slate-900);
            font-size: 16px; font-weight: 800;
            padding: 18px 40px; border-radius: 999px; border: 0;
            box-shadow: 0 8px 24px rgba(16,185,129,0.3);
            transition: all 0.3s ease; cursor: pointer;
        }
        .btn-cta-primary:hover { background: var(--green-400); transform: translateY(-2px); box-shadow: 0 12px 32px rgba(16,185,129,0.4); }
        .btn-cta-secondary {
            display: inline-flex; align-items: center;
            background: transparent; color: #fff;
            font-size: 16px; font-weight: 700;
            padding: 18px 40px; border-radius: 999px;
            border: 2px solid rgba(255,255,255,0.15);
            transition: all 0.3s ease; cursor: pointer;
        }
        .btn-cta-secondary:hover { border-color: rgba(255,255,255,0.4); transform: translateY(-2px); }

        @media (max-width: 640px) { .cta-card { padding: 48px 24px; border-radius: 28px; } }

        /* ========== Footer ========== */
        .footer {
            background: #fff;
            border-top: 1px solid var(--slate-100);
            padding: 48px 0;
        }
        .footer-inner {
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 24px;
        }
        .footer-logo { display: flex; align-items: center; gap: 10px; }
        .footer-logo img { height: 32px; }
        .footer-logo span { font-size: 16px; font-weight: 800; color: var(--slate-900); }
        .footer-links { display: flex; gap: 32px; flex-wrap: wrap; }
        .footer-links a { font-size: 13px; font-weight: 600; color: var(--slate-400); transition: color 0.2s; }
        .footer-links a:hover { color: var(--green-600); }
        .footer-copy { font-size: 13px; color: var(--slate-400); }

        @media (max-width: 768px) {
            .footer-inner { flex-direction: column; text-align: center; }
            .footer-links { justify-content: center; }
        }

        /* ========== AOS Animations (Pure CSS) ========== */
        [data-animate] {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
        }
        [data-animate].visible { opacity: 1; transform: translateY(0); pointer-events: auto; }
        [data-animate][data-delay="100"] { transition-delay: 100ms; }
        [data-animate][data-delay="200"] { transition-delay: 200ms; }
        [data-animate][data-delay="300"] { transition-delay: 300ms; }
        [data-animate][data-delay="400"] { transition-delay: 400ms; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container navbar-inner">
            <a href="#" class="nav-logo">
                <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY">
                <span>SAMPAY</span>
            </a>
            <div class="nav-links">
                <a href="#cara-kerja">Cara Kerja</a>
                <a href="#fitur">Layanan</a>
                <a href="{{ route('login') }}" class="nav-cta">
                    Masuk
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
            <div class="nav-mobile">
                <a href="{{ route('login') }}" class="nav-cta">Masuk</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <div class="hero-grid">
                <div class="visible">
                    <div class="hero-badge">
                        <span class="dot"></span>
                        Waste Management Platform
                    </div>
                    <h1 class="hero-title">
                        Wujudkan<br>Lingkungan<br><span class="accent">Lebih Bersih.</span>
                    </h1>
                    <p class="hero-text">
                        Solusi digital pengelolaan sampah yang efisien. Masyarakat melapor, petugas menjemput, dan sistem mencairkan reward otomatis ke akun Anda.
                    </p>
                    <div class="hero-actions">
                        <a href="{{ route('login') }}" class="btn-hero-primary">
                            Mulai Sekarang
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                        <a href="#cara-kerja" class="btn-hero-secondary">Pelajari Alur</a>
                    </div>
                </div>

                <div class="hero-visual">
                    <!-- Phone Mockup -->
                    <div class="hero-phone">
                        <div class="phone-screen">
                            <div class="phone-notch"><div class="phone-notch-pill"></div></div>
                            <div class="phone-header">
                                <div class="phone-header-greeting">Halo, Selamat Datang 👋</div>
                                <div class="phone-header-points">2.450 <span>Pts</span></div>
                            </div>
                            <div class="phone-body">
                                <div class="phone-card">
                                    <div class="phone-card-icon blue">📍</div>
                                    <div>
                                        <div class="phone-card-title">Lapor Sampah</div>
                                        <div class="phone-card-desc">Ajukan penjemputan baru</div>
                                    </div>
                                </div>
                                <div class="phone-card">
                                    <div class="phone-card-icon amber">🎁</div>
                                    <div>
                                        <div class="phone-card-title">Tukar Reward</div>
                                        <div class="phone-card-desc">Pilih hadiah favoritmu</div>
                                    </div>
                                </div>
                                <div class="phone-card">
                                    <div class="phone-card-icon green">📊</div>
                                    <div>
                                        <div class="phone-card-title">Riwayat Saya</div>
                                        <div class="phone-card-desc">Lihat riwayat transaksi</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Badges -->
                    <div class="hero-float-badge top-right">
                        <div class="float-icon" style="background:var(--green-100);color:var(--green-600);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                        </div>
                        <div>
                            <div class="float-label">Update</div>
                            <div class="float-value" style="font-size:15px;">Terverifikasi ✓</div>
                        </div>
                    </div>
                    <div class="hero-float-badge bottom-left" style="background:var(--slate-900); border-color:var(--slate-800);">
                        <div class="float-icon" style="background:rgba(16,185,129,0.15);">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--green-400)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                        </div>
                        <div>
                            <div class="float-label" style="color:var(--slate-500);">Total Diselamatkan</div>
                            <div class="float-value" style="color:#fff;">850 Kg</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Steps -->
    <section class="steps" id="cara-kerja">
        <div class="container">
            <div class="steps-header" data-animate>
                <div class="section-eyebrow">Mekanisme Kerja</div>
                <h2 class="section-title">Proses Mudah & Transparan</h2>
                <p class="section-subtitle">Empat langkah sederhana dari tumpukan sampah menjadi pundi rupiah.</p>
            </div>
            <div class="steps-grid">
                <div class="step-card" data-animate data-delay="100">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Input Laporan</h3>
                    <p class="step-desc">Masyarakat melapor tumpukan sampah melalui form aplikasi web yang responsif.</p>
                </div>
                <div class="step-card" data-animate data-delay="200">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Penjemputan</h3>
                    <p class="step-desc">Petugas mendapat notifikasi dan menjemput sampah sesuai koordinat lokasi.</p>
                </div>
                <div class="step-card" data-animate data-delay="300">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Validasi Admin</h3>
                    <p class="step-desc">Admin pusat memverifikasi berat dan jenis sampah di bank sampah.</p>
                </div>
                <div class="step-card" data-animate data-delay="400">
                    <div class="step-number">4</div>
                    <h3 class="step-title">Terima Reward</h3>
                    <p class="step-desc">Poin cair otomatis ke akun masyarakat untuk ditukar saldo digital.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan -->
    <section class="features" id="fitur">
        <div class="container">
            <div class="steps-header" data-animate>
                <div class="section-eyebrow">Layanan Kami</div>
                <h2 class="section-title">Tiga Pilar Utama SAMPAY</h2>
                <p class="section-subtitle">Setiap peran memiliki antarmuka yang disesuaikan untuk pengalaman terbaik.</p>
            </div>

            <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:32px;">
                <!-- Card Masyarakat -->
                <div class="step-card" data-animate data-delay="100" style="text-align:left;">
                    <div style="width:56px;height:56px;border-radius:16px;background:var(--green-50);display:flex;align-items:center;justify-content:center;margin-bottom:24px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h4 class="step-title" style="text-align:left;">Masyarakat</h4>
                    <p class="step-desc" style="text-align:left;">Lapor sampah, kumpulkan poin, dan tukar reward — semua lewat browser HP tanpa install.</p>
                </div>

                <!-- Card Petugas -->
                <div class="step-card" data-animate data-delay="200" style="text-align:left;">
                    <div style="width:56px;height:56px;border-radius:16px;background:#fff7ed;display:flex;align-items:center;justify-content:center;margin-bottom:24px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.657 16.657L13.414 20.9a2 2 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z"/><circle cx="12" cy="11" r="3"/></svg>
                    </div>
                    <h4 class="step-title" style="text-align:left;">Petugas</h4>
                    <p class="step-desc" style="text-align:left;">Terima tugas penjemputan, navigasi ke lokasi, dan validasi sampah secara efisien.</p>
                </div>

                <!-- Card Admin -->
                <div class="step-card" data-animate data-delay="300" style="text-align:left;">
                    <div style="width:56px;height:56px;border-radius:16px;background:var(--slate-100);display:flex;align-items:center;justify-content:center;margin-bottom:24px;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--slate-700)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19v-6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2zm0 0V9a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v10m-6 0a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2m0 0V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2z"/></svg>
                    </div>
                    <h4 class="step-title" style="text-align:left;">Admin Pusat</h4>
                    <p class="step-desc" style="text-align:left;">Kontrol sepenuhnya: verifikasi laporan, kelola reward & mitra, export data Excel.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <div class="container">
            <div class="cta-card" data-animate>
                <div class="cta-inner">
                    <h2 class="cta-title">Mulai Bersih &<br>Cuan Sekarang.</h2>
                    <p class="cta-text">Bergabunglah bersama ribuan warga yang sudah merasakan manfaat ekonomi dari mendaur ulang sampah mereka.</p>
                    <div class="cta-actions">
                        <a href="{{ route('login') }}" class="btn-cta-primary">Buka Aplikasi</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-inner">
            <div class="footer-logo">
                <img src="{{ asset('images/logo/logo-sampay.png') }}" alt="SAMPAY">
                <span>SAMPAY</span>
            </div>
            <div class="footer-links">
                <a href="#">Beranda</a>
                <a href="#cara-kerja">Cara Kerja</a>
                <a href="#fitur">Layanan</a>
                <a href="{{ route('login') }}">Masuk</a>
            </div>
            <div class="footer-copy">&copy; 2026 SAMPAY Team.</div>
        </div>
    </footer>

    <!-- Scroll Animations Script (Lightweight, No External Library) -->
    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 40);
        });

        // Intersection Observer for smooth reveal animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.05, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('[data-animate]').forEach(el => observer.observe(el));

        // Fallback: langsung tampilkan elemen yang sudah di viewport saat load
        window.addEventListener('load', () => {
            document.querySelectorAll('[data-animate]').forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight) {
                    el.classList.add('visible');
                }
            });
        });
    </script>
</body>
</html>
