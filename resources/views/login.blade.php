<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – MyApp</title>
    <style>
        /* Reset & Base */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: #f5f5f7;
            color: #1d1d1f;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Card */
        .login-card {
            background: #fff;
            padding: 3rem 2.5rem;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        .login-card h1 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        /* Form */
        .form-group {
            text-align: left;
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            font-size: 0.9rem;
            margin-bottom: 0.4rem;
            color: #555;
        }

        input {
            width: 100%;
            padding: 0.9rem;
            border: 1px solid #d2d2d7;
            border-radius: 12px;
            font-size: 1rem;
            outline: none;
            transition: border 0.2s, box-shadow 0.2s;
        }

        input:focus {
            border-color: #0071e3;
            box-shadow: 0 0 0 4px rgba(0,113,227,0.2);
        }

        /* Buttons */
        .btn {
            width: 100%;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-login {
            background: #0071e3;
            color: #fff;
            margin-bottom: 1rem;
        }

        .btn-login:hover {
            background: #005bb5;
            box-shadow: 0 4px 10px rgba(0,0,0,0.12);
            transform: translateY(-1px);
        }

        .google-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 500;
            color: #444;
            text-decoration: none;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            transition: all 0.2s;
            gap: 10px;
            width: 100%;
        }

        .google-btn:hover {
            box-shadow: 0 4px 10px rgba(0,0,0,0.12);
            transform: translateY(-1px);
        }

        /* Messages */
        .message {
            margin-top: 1rem;
            font-size: 0.95rem;
            padding: 0.75rem;
            border-radius: 10px;
        }
        .success { background: #e6f4ea; color: #1a7f37; }
        .error { background: #fde8e8; color: #d93025; }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>Welcome Back</h1>

        @if(session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login.custom') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password">
            </div>

            <button type="submit" class="btn btn-login">Login</button>
        </form>

        <!-- Google Button -->
        <a href="{{ route('google.login') }}" class="google-btn">
            <img src="https://developers.google.com/identity/images/g-logo.png" 
                 alt="Google Logo" width="20">
            Continue with Google
        </a>
    </div>
</body>
</html>
