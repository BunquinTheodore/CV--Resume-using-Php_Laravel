<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Resume Editor</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 50%, #0e7490 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 420px;
        }
        
        h1 {
            color: #06b6d4;
            font-size: 2.2em;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 30px;
            font-size: 1em;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95em;
        }
        
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }
        
        input:focus {
            outline: none;
            border-color: #06b6d4;
        }
        
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.95em;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 1.05em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4);
        }
        
        .btn-google {
            background: white;
            color: #444;
            border: 2px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
        }
        
        .btn-google:hover {
            background: #f8f9fa;
            border-color: #06b6d4;
        }
        
        .google-icon {
            width: 20px;
            height: 20px;
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
            color: #999;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .divider span {
            padding: 0 15px;
            font-size: 0.9em;
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #06b6d4;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95em;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        .helper-text {
            text-align: center;
            color: #999;
            font-size: 0.85em;
            margin-top: 15px;
        }
        
        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
            border-bottom: 2px solid #e0e0e0;
        }
        
        .tab {
            flex: 1;
            padding: 12px;
            background: none;
            border: none;
            border-bottom: 3px solid transparent;
            color: #666;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1em;
        }
        
        .tab.active {
            color: #06b6d4;
            border-bottom-color: #06b6d4;
        }
        
        .tab:hover {
            color: #06b6d4;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .register-note {
            background: #f0fdfa;
            border: 1px solid #06b6d4;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            color: #0e7490;
            font-size: 0.9em;
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 25px;
            }
            
            h1 {
                font-size: 1.8em;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <h1>🔐 Welcome</h1>
    <p class="subtitle">Login to edit or Register to create</p>
    
    <div class="tabs">
        <button class="tab active" onclick="switchTab('login')">Login</button>
        <button class="tab" onclick="switchTab('register')">Create Account</button>
    </div>
    
    @if(session('error'))
        <div class="alert alert-error">
            ❌ {{ session('error') }}
        </div>
    @endif
    
    @if(session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-error">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- Login Tab -->
    <div id="login-tab" class="tab-content active">
        <!-- Custom Login Form -->
        <form method="POST" action="{{ route('login.custom') }}">
            @csrf
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" 
                       value="{{ old('username') }}" 
                       placeholder="Enter username"
                       required autofocus>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" 
                       placeholder="Enter password"
                       required>
            </div>
            
            <button type="submit" class="btn btn-primary">
                Login
            </button>
        </form>
        
        <!-- Divider -->
        <div class="divider">
            <span>OR</span>
        </div>
        
        <!-- Google Login Button -->
        <a href="{{ route('google.login') }}" class="btn btn-google" style="text-decoration: none;">
            <svg class="google-icon" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            Continue with Google
        </a>
        
        <p class="helper-text">
            Default credentials: <strong>admin</strong> / <strong>1234</strong>
        </p>
    </div>
    
    <!-- Register Tab -->
    <div id="register-tab" class="tab-content">
        <div class="register-note">
            ℹ️ Create an account to build your own resume from scratch!
        </div>
        
        <form method="POST" action="{{ route('register') }}" autocomplete="off">
            @csrf
            
            <div class="form-group">
                <label for="reg-name">Full Name</label>
                <input type="text" id="reg-name" name="name" 
                       value="{{ old('name') }}" 
                       placeholder="Enter your full name"
                       autocomplete="name"
                       required>
            </div>
            
            <div class="form-group">
                <label for="reg-email">Email</label>
                <input type="email" id="reg-email" name="email" 
                       value="{{ old('email') }}" 
                       placeholder="Enter your email"
                       autocomplete="email"
                       required>
            </div>
            
            <div class="form-group">
                <label for="reg-password">Password (min 6 characters)</label>
                <input type="password" id="reg-password" name="password" 
                       placeholder="Create a password"
                       autocomplete="new-password"
                       minlength="6"
                       required>
            </div>
            
            <div class="form-group">
                <label for="reg-password-confirm">Confirm Password</label>
                <input type="password" id="reg-password-confirm" name="password_confirmation" 
                       placeholder="Confirm your password"
                       autocomplete="new-password"
                       minlength="6"
                       required>
            </div>
            
            <button type="submit" class="btn btn-primary">
                Create Account
            </button>
        </form>
    </div>
    
    <a href="{{ route('dashboard') }}" class="back-link">
        ← Back to Dashboard
    </a>
</div>

<script>
    function switchTab(tab) {
        // Update tab buttons
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        event.target.classList.add('active');
        
        // Update tab content
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        document.getElementById(tab + '-tab').classList.add('active');
    }

    // If there are validation errors and old input for registration fields, show register tab
    @if(old('name') || old('email') || $errors->has('name') || $errors->has('email') || $errors->has('password'))
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab')[1].classList.add('active');
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            document.getElementById('register-tab').classList.add('active');
        });
    @endif
</script>

</body>
</html>