<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            padding: 0;
        }
        
        .container {
            max-width: 100%;
            margin: 0 auto;
        }
        
        /* Header Navigation */
        .header {
            background: white;
            padding: 25px 60px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .header h1 {
            font-size: 32px;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
        }
        
        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .btn {
            padding: 12px 28px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95em;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4);
        }
        
        .btn-secondary {
            background: white;
            color: #06b6d4;
            border: 2px solid #06b6d4;
        }
        
        .btn-secondary:hover {
            background: #06b6d4;
            color: white;
        }
        
        .btn-back {
            background: white;
            color: #0f172a;
            border: 2px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .btn-back:hover {
            background: #f8fafc;
            border-color: #06b6d4;
            color: #06b6d4;
        }
        
        .btn-logout {
            background: #dc3545;
            color: white;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        }
        
        .btn-logout:hover {
            background: #c82333;
            transform: translateY(-2px);
        }
        
        /* Success Message with Animation */
        .success-message {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            padding: 18px 24px;
            border-radius: 12px;
            margin: 20px 60px;
            border-left: 5px solid #28a745;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
            font-weight: 600;
            animation: slideInDown 0.5s ease, fadeOut 0.5s ease 3.5s forwards;
            position: relative;
            overflow: hidden;
        }
        
        .success-message::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            background: #28a745;
            animation: shrinkWidth 4s linear forwards;
        }
        
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }
        
        @keyframes shrinkWidth {
            from { width: 100%; }
            to { width: 0%; }
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            padding: 80px 60px;
            color: white;
            text-align: center;
        }
        
        .hero-section h2 {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 15px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .hero-section p {
            font-size: 20px;
            opacity: 0.95;
            max-width: 700px;
            margin: 0 auto;
        }
        
        /* Main Content */
        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 60px;
        }
        
        .section {
            margin-bottom: 80px;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-header h2 {
            font-size: 36px;
            color: #0f172a;
            font-weight: 800;
            margin-bottom: 12px;
            position: relative;
            display: inline-block;
        }
        
        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            border-radius: 2px;
        }
        
        .section-header p {
            font-size: 16px;
            color: #64748b;
            margin-top: 20px;
        }
        
        .resumes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
        }
        
        .templates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
        }
        
        .resume-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            text-decoration: none;
            display: block;
            color: inherit;
        }
        
        .resume-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #06b6d4 0%, #0891b2 100%);
        }
        
        .resume-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
        }
        
        .resume-card h3 {
            font-size: 22px;
            color: #1e293b;
            margin-bottom: 8px;
            font-weight: 700;
        }
        
        .resume-card .headline {
            color: #06b6d4;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
        }
        
        .template-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            border: 3px solid transparent;
        }
        
        .template-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #06b6d4 0%, #0891b2 100%);
        }
        
        .template-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(6, 182, 212, 0.25);
            border-color: #06b6d4;
        }
        
        .template-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }
        
        .template-preview {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%);
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            border: 2px solid #e2e8f0;
        }
        
        .template-card h3 {
            font-size: 20px;
            color: #0f172a;
            margin-bottom: 8px;
            font-weight: 700;
        }
        
        .template-card p {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 15px;
            line-height: 1.5;
        }
        
        .template-features {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 20px;
        }
        
        .feature-tag {
            background: #f0fdfa;
            color: #0891b2;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 600;
            border: 1px solid #99f6e4;
        }
        
        .resume-card .contact-info {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .resume-card .summary {
            color: #475569;
            font-size: 14px;
            line-height: 1.6;
            margin: 15px 0;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .click-hint {
            color: #06b6d4;
            font-size: 13px;
            font-weight: 600;
            margin-top: 15px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .use-template-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
        }
        
        .use-template-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4);
        }
        
        .resume-card:hover .click-hint {
            text-decoration: underline;
        }
        
        .empty-state {
            background: white;
            border-radius: 16px;
            padding: 60px 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        
        .empty-state h2 {
            font-size: 24px;
            color: #1e293b;
            margin-bottom: 12px;
        }
        
        .empty-state p {
            color: #64748b;
            margin-bottom: 25px;
        }
        
        .updated-time {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 10px;
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 20px 25px;
            }
            
            .header h1 {
                font-size: 24px;
            }
            
            .header-actions {
                width: 100%;
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .hero-section {
                padding: 60px 30px;
            }
            
            .hero-section h2 {
                font-size: 32px;
            }
            
            .hero-section p {
                font-size: 16px;
            }
            
            .main-content {
                padding: 40px 25px;
            }
            
            .section-header h2 {
                font-size: 28px;
            }
            
            .resumes-grid,
            .templates-grid {
                grid-template-columns: 1fr;
            }
            
            .success-message {
                margin: 20px 25px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header Navigation -->
    <div class="header">
        <h1>📋 ResumeFlow</h1>
        <div class="header-actions">
            <a href="/" class="btn btn-back">← Back to Home</a>
            @if(session('user_logged_in') || Auth::check())
                <span style="color: #64748b; font-weight: 600;">Welcome, {{ session('username') ?? Auth::user()->name }}!</span>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-logout">🚪 Logout</button>
                </form>
            @else
                <a href="{{ route('login.form') }}" class="btn btn-primary">🔐 Login / Create Account</a>
            @endif
        </div>
    </div>
    
    @if(session('success'))
        <div class="success-message">
            ✓ {{ session('success') }}
        </div>
    @endif
    
    <!-- Hero Section -->
    <div class="hero-section">
        <h2>Welcome to Your Resume Dashboard</h2>
        <p>Create, manage, and showcase your professional resumes with ease</p>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Public Resumes Section -->
        <div class="section">
            <div class="section-header">
                <h2>📄 Public Resumes</h2>
                <p>View and manage all published resumes</p>
            </div>
            
            @if($resumes->count() > 0)
                <div class="resumes-grid">
                    @foreach($resumes as $resume)
                        <a href="{{ route('resume.show', $resume->id) }}" class="resume-card">
                            @if($resume->photo)
                                <div style="text-align: center; margin-bottom: 20px;">
                                    <img src="{{ $resume->photo }}" alt="{{ $resume->name }}" 
                                         style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 4px solid #06b6d4; box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);">
                                </div>
                            @endif
                            <h3>{{ $resume->name }}</h3>
                            @if($resume->headline)
                                <div class="headline">{{ $resume->headline }}</div>
                            @endif
                            <div class="contact-info">
                                <span>✉️ {{ $resume->email }}</span>
                            </div>
                            @if($resume->phone)
                                <div class="contact-info">
                                    <span>📱 {{ $resume->phone }}</span>
                                </div>
                            @endif
                            @if($resume->summary)
                                <div class="summary">{{ $resume->summary }}</div>
                            @endif
                            <div class="updated-time">
                                Last updated: {{ $resume->updated_at->format('M d, Y') }}
                            </div>
                            <div class="click-hint">
                                👁️ Click to view full resume
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <h2>No Resumes Yet</h2>
                    <p>Choose a template below to create your first resume!</p>
                </div>
            @endif
        </div>
        
        <!-- Templates Section (Below when scrolled) -->
        <div class="section">
            <div class="section-header">
                <h2>🎨 Choose a Template</h2>
                <p>Select from our professional resume templates to get started</p>
            </div>
            
            <div class="templates-grid">
                <!-- Template 1: Classic Professional -->
                <div class="template-card" onclick="window.location.href='{{ route('login.form') }}?template=classic'">
                    <span class="template-badge">Popular</span>
                    <div class="template-preview">📋</div>
                    <h3>Classic Professional</h3>
                    <p>Clean and traditional design perfect for corporate roles</p>
                    <div class="template-features">
                        <span class="feature-tag">ATS-Friendly</span>
                        <span class="feature-tag">Traditional</span>
                    </div>
                    <button class="use-template-btn">Use This Template</button>
                </div>
                
                <!-- Template 2: Modern Minimalist -->
                <div class="template-card" onclick="window.location.href='{{ route('login.form') }}?template=modern'">
                    <span class="template-badge">Trending</span>
                    <div class="template-preview">✨</div>
                    <h3>Modern Minimalist</h3>
                    <p>Sleek design with clean lines for tech and creative roles</p>
                    <div class="template-features">
                        <span class="feature-tag">Modern</span>
                        <span class="feature-tag">Clean</span>
                    </div>
                    <button class="use-template-btn">Use This Template</button>
                </div>
                
                <!-- Template 3: Creative Bold -->
                <div class="template-card" onclick="window.location.href='{{ route('login.form') }}?template=creative'">
                    <div class="template-preview">🎨</div>
                    <h3>Creative Bold</h3>
                    <p>Stand out with vibrant colors for design and marketing</p>
                    <div class="template-features">
                        <span class="feature-tag">Colorful</span>
                        <span class="feature-tag">Unique</span>
                    </div>
                    <button class="use-template-btn">Use This Template</button>
                </div>
                
                <!-- Template 4: Executive Elite -->
                <div class="template-card" onclick="window.location.href='{{ route('login.form') }}?template=executive'">
                    <div class="template-preview">💼</div>
                    <h3>Executive Elite</h3>
                    <p>Sophisticated layout for senior and executive positions</p>
                    <div class="template-features">
                        <span class="feature-tag">Professional</span>
                        <span class="feature-tag">Premium</span>
                    </div>
                    <button class="use-template-btn">Use This Template</button>
                </div>
                
                <!-- Template 5: Academic Scholar -->
                <div class="template-card" onclick="window.location.href='{{ route('login.form') }}?template=academic'">
                    <div class="template-preview">🎓</div>
                    <h3>Academic Scholar</h3>
                    <p>Ideal for researchers, professors, and academic roles</p>
                    <div class="template-features">
                        <span class="feature-tag">Research-Focused</span>
                        <span class="feature-tag">Detailed</span>
                    </div>
                    <button class="use-template-btn">Use This Template</button>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
