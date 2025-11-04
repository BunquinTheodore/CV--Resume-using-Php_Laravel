<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>{{ $resume->name ?? 'Resume' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 50%, #0e7490 100%);
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
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
        
        .wrapper {
            width: 100%;
            max-width: 900px;
            position: relative;
            z-index: 1;
        }
        
        /* Success Message */
        .success-message {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            padding: 18px 24px;
            border-radius: 12px;
            margin-bottom: 25px;
            border-left: 5px solid #28a745;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
            animation: slideDown 0.5s ease;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .success-message::before {
            content: '✓';
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            background: #28a745;
            color: white;
            border-radius: 50%;
            font-weight: bold;
            font-size: 1.2em;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Resume Container */
        .resume-container {
            background: #fff;
            min-height: 1100px;
            padding: 60px 80px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            border-radius: 16px;
            position: relative;
            animation: fadeIn 0.6s ease;
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
        
        /* Login Button */
        .login-btn {
            position: fixed;
            top: 30px;
            right: 30px;
            background: white;
            color: #06b6d4;
            padding: 14px 32px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
            z-index: 100;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95em;
            letter-spacing: 0.3px;
        }
        
        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.35);
            background: #06b6d4;
            color: white;
        }

        /* Print Button */
        .print-btn {
            position: fixed;
            top: 30px;
            left: 30px;
            background: #111827;
            color: white;
            padding: 14px 24px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
            z-index: 100;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.95em;
            letter-spacing: 0.3px;
            cursor: pointer;
            border: none;
        }

        .print-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.35);
            background: #374151;
        }
        
        /* Header */
        .resume-header {
            border-bottom: 4px solid transparent;
            border-image: linear-gradient(90deg, #06b6d4 0%, #0891b2 100%);
            border-image-slice: 1;
            padding-bottom: 25px;
            margin-bottom: 35px;
        }
        
        h1 {
            font-size: 38px;
            background: linear-gradient(135deg, #0e7490 0%, #06b6d4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 12px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        
        .contact {
            margin-bottom: 15px;
            font-size: 15px;
            color: #64748b;
            line-height: 1.8;
            display: flex;
            flex-wrap: wrap;
            gap: 8px 20px;
            align-items: center;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .contact a {
            color: #06b6d4;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }
        
        .contact a:hover {
            color: #0891b2;
            text-decoration: underline;
        }
        
        h3 {
            font-size: 20px;
            color: #0891b2;
            margin-bottom: 15px;
            font-weight: 700;
            letter-spacing: 0.3px;
        }
        
        .summary {
            color: #475569;
            line-height: 1.8;
            margin-bottom: 35px;
            font-size: 15.5px;
            padding: 20px;
            background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%);
            border-radius: 12px;
            border-left: 4px solid #06b6d4;
        }
        
        /* Sections */
        .section {
            margin-bottom: 35px;
        }
        
        h2 {
            font-size: 24px;
            color: #1e293b;
            border-bottom: none;
            padding: 12px 20px;
            margin-bottom: 20px;
            font-weight: 700;
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
            border-radius: 10px;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
        }
        
        ul {
            margin: 0;
            padding-left: 24px;
            line-height: 1.9;
        }
        
        ul li {
            margin-bottom: 10px;
            color: #475569;
            position: relative;
        }
        
        ul li::marker {
            color: #06b6d4;
            font-weight: bold;
        }
        
        .job-title {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
            font-size: 16px;
        }
        
        /* Expertise Tags */
        .expertise-list {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 15px;
        }
        
        .expertise-tag {
            background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
            color: white;
            padding: 10px 22px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(6, 182, 212, 0.3);
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }
        
        .expertise-tag:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(6, 182, 212, 0.4);
        }
        
        /* Achievements */
        .achievement-item {
            margin-bottom: 20px;
            padding: 20px;
            padding-left: 25px;
            border-left: 4px solid #0891b2;
            background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%);
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .achievement-item:hover {
            border-left-width: 6px;
            padding-left: 23px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .achievement-item strong {
            color: #1e293b;
            font-size: 16px;
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
        }
        
        .achievement-item p {
            color: #475569;
            line-height: 1.7;
            margin: 0;
        }
        
        /* Text Formatting */
        .formatted-text {
            white-space: pre-line;
            line-height: 1.9;
            color: #475569;
            padding: 15px;
            background: #f8fafc;
            border-radius: 8px;
        }
        
        /* Updated Timestamp */
        .updated-timestamp {
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
            margin-top: 50px;
            padding-top: 25px;
            border-top: 2px solid #e2e8f0;
            font-weight: 500;
        }
        
        /* Decorative Elements */
        .section-icon {
            display: inline-block;
            margin-right: 10px;
            font-size: 1.1em;
        }
        
        /* Print Styles */
        @media print {
            @page {
                size: A4;
                margin: 15mm;
            }
            
            body {
                background: white;
                padding: 0;
                margin: 0;
            }
            
            body::before {
                display: none;
            }
            
            .wrapper {
                max-width: 100%;
            }
            
            .resume-container {
                box-shadow: none;
                padding: 20px;
                min-height: auto;
                border-radius: 0;
                page-break-inside: avoid;
            }
            
            .login-btn {
                display: none;
            }
            .print-btn {
                display: none;
            }
            
            .success-message {
                display: none;
            }
            
            .resume-header {
                padding-bottom: 15px;
                margin-bottom: 20px;
            }
            
            h1 {
                font-size: 26px;
                margin-bottom: 8px;
            }
            
            h2 {
                background: none;
                color: #1e293b;
                border-bottom: 2px solid #06b6d4;
                box-shadow: none;
                font-size: 18px;
                padding: 8px 0;
                margin-bottom: 12px;
                margin-top: 15px;
            }
            
            h3 {
                font-size: 16px;
                margin-bottom: 10px;
            }
            
            .contact {
                font-size: 13px;
                margin-bottom: 10px;
            }
            
            .summary {
                padding: 12px;
                margin-bottom: 20px;
                font-size: 13px;
                line-height: 1.5;
            }
            
            .section {
                margin-bottom: 18px;
                page-break-inside: avoid;
            }
            
            .expertise-list {
                gap: 8px;
                margin-top: 10px;
            }
            
            .expertise-tag {
                box-shadow: none;
                padding: 6px 14px;
                font-size: 12px;
                background: #ccfbf1;
                color: #0e7490;
            }
            
            .achievement-item {
                box-shadow: none;
                padding: 12px;
                margin-bottom: 12px;
                page-break-inside: avoid;
            }
            
            .achievement-item strong {
                font-size: 14px;
            }
            
            .formatted-text {
                padding: 10px;
                font-size: 13px;
                line-height: 1.6;
            }
            
            ul {
                padding-left: 20px;
                line-height: 1.6;
            }
            
            ul li {
                margin-bottom: 6px;
                font-size: 13px;
            }
            
            .job-title {
                font-size: 14px;
                margin-bottom: 6px;
            }
            
            .updated-timestamp {
                margin-top: 20px;
                padding-top: 15px;
                font-size: 11px;
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }
            
            .resume-container {
                padding: 40px 30px;
                border-radius: 12px;
            }
            
            h1 {
                font-size: 28px;
            }
            
            h2 {
                font-size: 20px;
                padding: 10px 16px;
            }
            
            .login-btn {
                top: 15px;
                right: 15px;
                padding: 12px 24px;
                font-size: 0.9em;
            }
            
            .print-btn {
                top: 15px;
                left: 15px;
                padding: 12px 20px;
                font-size: 0.9em;
            }
            
            .contact {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
            
            .expertise-list {
                gap: 8px;
            }
            
            .expertise-tag {
                padding: 8px 18px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

<a href="{{ route('dashboard') }}" class="login-btn">🏠 Back to Dashboard</a>
<button type="button" class="print-btn" onclick="window.print()">🖨️ Print</button>

<div class="wrapper">
    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="resume-container">
        <!-- Header -->
        <div class="resume-header">
            @if($resume->photo)
                <div style="text-align: center; margin-bottom: 25px;">
                    <img src="{{ $resume->photo }}" alt="{{ $resume->name }}" 
                         style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 5px solid #06b6d4; box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4);">
                </div>
            @endif
            <h1>{{ $resume->name ?? 'THEODORE VON JOSHUA M. BUNQUIN' }}</h1>
            <div class="contact">
                <span class="contact-item">📍 {{ $resume->address ?? 'Alangilan, Batangas' }}</span>
                <span class="contact-item">|</span>
                <span class="contact-item">✉️ <a href="mailto:{{ $resume->email ?? 'bunquintheodore@gmail.com' }}">{{ $resume->email ?? 'bunquintheodore@gmail.com' }}</a></span>
                <span class="contact-item">|</span>
                <span class="contact-item">📱 {{ $resume->phone ?? '(+63) 966 02 5692' }}</span>
            </div>
            <h3>{{ $resume->headline ?? 'Creative AI Developer & Digital Content Specialist' }}</h3>
            <p class="summary">{{ $resume->summary ?? 'Passionate about delivering innovative, tech-driven solutions that captivate and engage.' }}</p>
        </div>

        <!-- Area of Expertise -->
        @if(!empty($resume->expertise))
        <div class="section">
            <h2><span class="section-icon">💡</span>Area of Expertise</h2>
            <div class="expertise-list">
                @foreach($resume->expertise as $skill)
                    <span class="expertise-tag">{{ $skill }}</span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Key Achievements -->
        @if(!empty($resume->achievements))
        <div class="section">
            <h2><span class="section-icon">🏆</span>Key Achievements</h2>
            @foreach($resume->achievements as $achievement)
                <div class="achievement-item">
                    <strong>{{ $achievement['title'] ?? 'Achievement' }}</strong>
                    <p>{{ $achievement['description'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
        @endif

        <!-- Professional Experience -->
        @if(!empty($resume->experience))
        <div class="section">
            <h2><span class="section-icon">💼</span>Professional Experience</h2>
            <div class="formatted-text">{{ $resume->experience }}</div>
        </div>
        @endif

        <!-- Education -->
        @if(!empty($resume->education))
        <div class="section">
            <h2><span class="section-icon">🎓</span>Education</h2>
            <div class="formatted-text">{{ $resume->education }}</div>
        </div>
        @endif

        <!-- Additional Information -->
        @if(!empty($resume->additional))
        <div class="section">
            <h2><span class="section-icon">📌</span>Additional Information</h2>
            <div class="formatted-text">{{ $resume->additional }}</div>
        </div>
        @endif
        
        @if($resume->updated_at)
        <p class="updated-timestamp">
            Last Updated: {{ $resume->updated_at->format('F d, Y - g:i A') }}
        </p>
        @endif
    </div>
</div>

</body>
</html>