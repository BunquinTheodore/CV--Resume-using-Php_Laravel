<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ResumeFlow - Professional Resume Builder</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 50%, #0e7490 100%);
            color: #0f172a;
            overflow-x: hidden;
        }
        
        /* Animated Background */
        .animated-bg {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 0;
            overflow: hidden;
        }
        
        .animated-bg::before,
        .animated-bg::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite ease-in-out;
        }
        
        .animated-bg::before {
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }
        
        .animated-bg::after {
            bottom: -150px;
            right: -150px;
            animation-delay: 10s;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(50px, 50px) scale(1.1); }
            50% { transform: translate(100px, -50px) scale(0.9); }
            75% { transform: translate(-50px, 100px) scale(1.05); }
        }
        
        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            animation: slideDown 0.8s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-100%);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .logo {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -1px;
        }
        
        .nav-links {
            display: flex;
            gap: 35px;
            align-items: center;
        }
        
        .nav-links a {
            text-decoration: none;
            color: #334155;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            font-size: 15px;
        }
        
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #06b6d4;
            transition: width 0.3s ease;
        }
        
        .nav-links a:hover {
            color: #06b6d4;
        }
        
        .nav-links a:hover::after {
            width: 100%;
        }
        
        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Hero Section */
        .hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 100px 50px 50px;
            text-align: center;
            z-index: 1;
        }
        
        .hero-content {
            max-width: 900px;
            animation: fadeInUp 1s ease;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero h1 {
            font-size: 72px;
            font-weight: 900;
            color: white;
            margin-bottom: 25px;
            line-height: 1.2;
            letter-spacing: -2px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        
        .hero .subtitle {
            font-size: 24px;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 45px;
            line-height: 1.6;
            font-weight: 400;
        }
        
        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: white;
            color: #06b6d4;
            padding: 20px 50px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 20px;
            font-weight: 700;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }
        
        .cta-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(6, 182, 212, 0.1);
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }
        
        .cta-button:hover::before {
            width: 400px;
            height: 400px;
        }
        
        .cta-button:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
        }
        
        .cta-button span {
            position: relative;
            z-index: 1;
        }
        
        /* Features Section */
        .features {
            position: relative;
            background: white;
            padding: 100px 50px;
            z-index: 1;
        }
        
        .section-title {
            text-align: center;
            font-size: 48px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 60px;
            letter-spacing: -1px;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .feature-card {
            background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%);
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.4s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            border: 2px solid transparent;
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 0;
        }
        
        .feature-card:hover::before {
            opacity: 1;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(6, 182, 212, 0.3);
            border-color: #06b6d4;
        }
        
        .feature-card:hover .feature-icon,
        .feature-card:hover h3,
        .feature-card:hover p {
            color: white;
            position: relative;
            z-index: 1;
        }
        
        .feature-icon {
            font-size: 64px;
            margin-bottom: 20px;
            transition: all 0.4s ease;
        }
        
        .feature-card h3 {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 15px;
            transition: all 0.4s ease;
            position: relative;
            z-index: 1;
        }
        
        .feature-card p {
            font-size: 16px;
            color: #475569;
            line-height: 1.7;
            transition: all 0.4s ease;
            position: relative;
            z-index: 1;
        }
        
        /* How It Works Section */
        .how-it-works {
            position: relative;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 100px 50px;
            z-index: 1;
        }
        
        .steps-container {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 50px;
        }
        
        .step {
            text-align: center;
            position: relative;
            animation: fadeIn 1s ease;
            animation-fill-mode: both;
        }
        
        .step:nth-child(1) { animation-delay: 0.2s; }
        .step:nth-child(2) { animation-delay: 0.4s; }
        .step:nth-child(3) { animation-delay: 0.6s; }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
            border-radius: 50%;
            font-size: 36px;
            font-weight: 800;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(6, 182, 212, 0.3);
            transition: all 0.3s ease;
        }
        
        .step:hover .step-number {
            transform: scale(1.1) rotate(360deg);
        }
        
        .step h3 {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 12px;
        }
        
        .step p {
            font-size: 16px;
            color: #64748b;
            line-height: 1.6;
        }
        
        /* Testimonials Section */
        .testimonials {
            position: relative;
            background: white;
            padding: 100px 50px;
            z-index: 1;
        }
        
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .testimonial-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            border-left: 5px solid #06b6d4;
        }
        
        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }
        
        .testimonial-text {
            font-size: 16px;
            color: #475569;
            line-height: 1.8;
            margin-bottom: 25px;
            font-style: italic;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 20px;
        }
        
        .author-info h4 {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
        }
        
        .author-info p {
            font-size: 14px;
            color: #64748b;
        }
        
        /* CTA Section */
        .cta-section {
            position: relative;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            padding: 100px 50px;
            text-align: center;
            z-index: 1;
        }
        
        .cta-section h2 {
            font-size: 48px;
            font-weight: 800;
            color: white;
            margin-bottom: 25px;
            letter-spacing: -1px;
        }
        
        .cta-section p {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 40px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .cta-secondary {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: white;
            color: #06b6d4;
            padding: 20px 50px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 20px;
            font-weight: 700;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            transition: all 0.4s ease;
        }
        
        .cta-secondary:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.3);
        }
        
        /* Footer */
        footer {
            position: relative;
            background: #0f172a;
            color: white;
            padding: 50px;
            text-align: center;
            z-index: 1;
        }
        
        footer p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.7);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            nav {
                padding: 15px 25px;
            }
            
            .logo {
                font-size: 22px;
            }
            
            .nav-links {
                gap: 20px;
            }
            
            .nav-links a {
                font-size: 14px;
            }
            
            .hero {
                padding: 80px 25px 50px;
            }
            
            .hero h1 {
                font-size: 42px;
            }
            
            .hero .subtitle {
                font-size: 18px;
            }
            
            .cta-button {
                padding: 16px 35px;
                font-size: 18px;
            }
            
            .features, .how-it-works, .testimonials, .cta-section {
                padding: 60px 25px;
            }
            
            .section-title {
                font-size: 36px;
            }
            
            .features-grid,
            .testimonials-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .cta-section h2 {
                font-size: 36px;
            }
            
            .cta-section p {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

<div class="animated-bg"></div>

<!-- Navigation -->
<nav>
    <div class="logo">📋 ResumeFlow</div>
    <div class="nav-links">
        <a href="#features">Features</a>
        <a href="#how-it-works">How It Works</a>
        <a href="#testimonials">Testimonials</a>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>Build Your Dream Resume in Minutes</h1>
        <p class="subtitle">Create professional, ATS-friendly resumes with our intuitive builder. Stand out from the crowd and land your dream job.</p>
        <a href="{{ route('dashboard') }}" class="cta-button">
            <span>Build Resume</span>
            <span>→</span>
        </a>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="features">
    <h2 class="section-title">Why Choose ResumeFlow?</h2>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <h3>Lightning Fast</h3>
            <p>Create a professional resume in under 10 minutes with our streamlined interface.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🎨</div>
            <h3>Beautiful Templates</h3>
            <p>Choose from 5 professionally designed templates that make you stand out.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">📱</div>
            <h3>Fully Responsive</h3>
            <p>Build and edit your resume on any device - desktop, tablet, or mobile.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🔒</div>
            <h3>Secure & Private</h3>
            <p>Your data is encrypted and stored securely. We never share your information.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">💾</div>
            <h3>Auto-Save</h3>
            <p>Never lose your work. Our auto-save feature keeps your progress safe.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🖨️</div>
            <h3>Print Ready</h3>
            <p>Export your resume as a perfectly formatted PDF ready for printing.</p>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="how-it-works">
    <h2 class="section-title">How It Works</h2>
    <div class="steps-container">
        <div class="step">
            <div class="step-number">1</div>
            <h3>Choose a Template</h3>
            <p>Select from our collection of professional resume templates.</p>
        </div>
        <div class="step">
            <div class="step-number">2</div>
            <h3>Fill Your Info</h3>
            <p>Add your details, experience, education, and skills easily.</p>
        </div>
        <div class="step">
            <div class="step-number">3</div>
            <h3>Download & Share</h3>
            <p>Download your polished resume and start applying to jobs!</p>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="testimonials">
    <h2 class="section-title">What Our Users Say</h2>
    <div class="testimonials-grid">
        <div class="testimonial-card">
            <p class="testimonial-text">"ResumeFlow made creating my resume so easy! I got my dream job within 2 weeks of using it."</p>
            <div class="testimonial-author">
                <div class="author-avatar">MJ</div>
                <div class="author-info">
                    <h4>Maria Johnson</h4>
                    <p>Software Engineer</p>
                </div>
            </div>
        </div>
        <div class="testimonial-card">
            <p class="testimonial-text">"The templates are beautiful and professional. Highly recommend for anyone job hunting!"</p>
            <div class="testimonial-author">
                <div class="author-avatar">DS</div>
                <div class="author-info">
                    <h4>David Smith</h4>
                    <p>Marketing Manager</p>
                </div>
            </div>
        </div>
        <div class="testimonial-card">
            <p class="testimonial-text">"Simple, fast, and effective. This is the best resume builder I've used!"</p>
            <div class="testimonial-author">
                <div class="author-avatar">SC</div>
                <div class="author-info">
                    <h4>Sarah Chen</h4>
                    <p>Product Designer</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <h2>Ready to Build Your Resume?</h2>
    <p>Join thousands of professionals who have successfully landed their dream jobs with ResumeFlow.</p>
    <a href="{{ route('dashboard') }}" class="cta-secondary">
        <span>Get Started Now</span>
        <span>→</span>
    </a>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2025 ResumeFlow. All rights reserved. Built with ❤️ for job seekers everywhere.</p>
</footer>

</body>
</html>
