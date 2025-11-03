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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        
        .header {
            background: white;
            padding: 30px 40px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .header h1 {
            font-size: 32px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }
        
        .btn-secondary:hover {
            background: #667eea;
            color: white;
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
        
        .success-message {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            padding: 18px 24px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 5px solid #28a745;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
            font-weight: 600;
        }
        
        .resumes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
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
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
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
            color: #667eea;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
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
            color: #667eea;
            font-size: 13px;
            font-weight: 600;
            margin-top: 15px;
            display: flex;
            align-items: center;
            gap: 6px;
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
            
            .resumes-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>📋 Resume Dashboard</h1>
        <div class="header-actions">
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
    
    @if($resumes->count() > 0)
        <div class="resumes-grid">
            @foreach($resumes as $resume)
                <a href="{{ route('resume.show', $resume->id) }}" class="resume-card">
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
            <p>Be the first to create a resume!</p>
            <a href="{{ route('login.form') }}" class="btn btn-primary">Get Started</a>
        </div>
    @endif
</div>

</body>
</html>
