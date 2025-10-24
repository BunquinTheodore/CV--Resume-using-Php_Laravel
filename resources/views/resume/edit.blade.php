<!DOCTYPE html>
<!-- THIS IS THE EDIT PAGE - TEST -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resume - {{ $resume->name ?? '' }}</title>
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
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 50px 60px;
            position: relative;
            animation: fadeInUp 0.6s ease;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .header-section {
            text-align: center;
            margin-bottom: 50px;
            padding-bottom: 30px;
            border-bottom: 3px solid #f0f0f0;
        }
        
        h1 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 2.8em;
            margin-bottom: 12px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .subtitle {
            color: #64748b;
            font-size: 1.1em;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .form-section {
            margin-bottom: 45px;
            animation: fadeIn 0.8s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .form-section h2 {
            color: #1e293b;
            font-size: 1.6em;
            margin-bottom: 25px;
            padding-left: 20px;
            border-left: 5px solid #667eea;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            color: #334155;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 0.95em;
            letter-spacing: 0.2px;
        }
        
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1em;
            font-family: inherit;
            transition: all 0.3s ease;
            background: #f8fafc;
        }
        
        input:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }
        
        textarea {
            resize: vertical;
            min-height: 120px;
            line-height: 1.7;
        }
        
        /* Dynamic Fields */
        .dynamic-section {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 20px;
            border: 1px solid #e2e8f0;
        }
        
        .dynamic-item {
            background: white;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 2px solid #e2e8f0;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .dynamic-item:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        .remove-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.85em;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }
        
        .remove-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }
        
        .add-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
            margin-top: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }
        
        .add-btn::before {
            content: '+';
            font-size: 1.4em;
            font-weight: 700;
        }
        
        /* Expertise Input */
        .expertise-input-container {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .expertise-input-container input {
            flex: 1;
        }
        
        .expertise-input-container .remove-btn {
            position: static;
            padding: 10px 16px;
            font-size: 1.2em;
            border-radius: 10px;
        }
        
        /* Actions */
        .actions {
            display: flex;
            gap: 20px;
            justify-content: flex-end;
            margin-top: 50px;
            padding-top: 30px;
            border-top: 3px solid #f0f0f0;
        }
        
        .btn {
            padding: 16px 40px;
            border: none;
            border-radius: 12px;
            font-size: 1.05em;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-align: center;
            letter-spacing: 0.3px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
        }
        
        .btn-secondary {
            background: white;
            color: #64748b;
            border: 2px solid #e2e8f0;
        }
        
        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }
        
        /* Logout Button */
        .logout-btn {
            position: fixed;
            top: 30px;
            right: 30px;
            background: rgba(255, 255, 255, 0.95);
            color: #667eea;
            border: none;
            padding: 12px 28px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 700;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            font-size: 0.95em;
        }
        
        .logout-btn:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.2);
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.88em;
            margin-top: 8px;
            padding: 8px 12px;
            background: #fee2e2;
            border-radius: 6px;
            border-left: 3px solid #ef4444;
        }
        
        .helper-text {
            color: #64748b;
            font-size: 0.88em;
            margin-top: 8px;
            font-style: italic;
            line-height: 1.5;
        }
        
        /* Progress Indicator */
        .section-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 50%;
            font-size: 0.85em;
            font-weight: 700;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }
            
            .container {
                padding: 35px 25px;
                border-radius: 16px;
            }
            
            h1 {
                font-size: 2em;
            }
            
            .actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
            
            .logout-btn {
                top: 15px;
                right: 15px;
                padding: 10px 20px;
                font-size: 0.9em;
            }
            
            .form-section h2 {
                font-size: 1.4em;
            }
        }
    </style>
</head>
<body>

<form method="POST" action="{{ route('logout') }}" style="display: inline;">
    @csrf
    <button type="submit" class="logout-btn">🚪 Logout</button>
</form>

<div class="container">
    <div class="header-section">
        <h1>✏️ Edit Your Resume</h1>
        <p class="subtitle">Update your information and click "Publish Resume" to save changes and make them live</p>
    </div>
    
    <form method="POST" action="{{ route('resume.update', $resume->id ?? 1) }}" id="resumeForm">
        @csrf
        
        <!-- Basic Information -->
        <div class="form-section">
            <h2><span class="section-number">1</span> Basic Information</h2>
            
            <div class="form-group">
                <label for="name">Full Name *</label>
                <input type="text" id="name" name="name" 
                       value="{{ old('name', $resume->name ?? '') }}" required>
                @error('name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" 
                       value="{{ old('address', $resume->address ?? '') }}">
            </div>
            
            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" 
                       value="{{ old('email', $resume->email ?? '') }}" required>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" 
                       value="{{ old('phone', $resume->phone ?? '') }}">
            </div>
            
            <div class="form-group">
                <label for="headline">Professional Headline</label>
                <input type="text" id="headline" name="headline" 
                       value="{{ old('headline', $resume->headline ?? '') }}"
                       placeholder="e.g., Creative AI Developer & Digital Content Specialist">
                <div class="helper-text">A brief title that describes your professional identity</div>
            </div>
            
            <div class="form-group">
                <label for="summary">Professional Summary</label>
                <textarea id="summary" name="summary" rows="4">{{ old('summary', $resume->summary ?? '') }}</textarea>
                <div class="helper-text">A concise overview of your professional background and goals</div>
            </div>
        </div>
        
        <!-- Area of Expertise -->
        <div class="form-section">
            <h2><span class="section-number">2</span> Area of Expertise</h2>
            <div id="expertiseContainer">
                @php
                    $expertiseItems = old('expertise', $resume->expertise ?? []);
                @endphp
                @if(!empty($expertiseItems))
                    @foreach($expertiseItems as $skill)
                        <div class="expertise-input-container">
                            <input type="text" name="expertise[]" value="{{ $skill }}" placeholder="e.g., Web Development">
                            <button type="button" class="remove-btn" onclick="removeExpertise(this)">✕</button>
                        </div>
                    @endforeach
                @endif
            </div>
            <button type="button" class="add-btn" onclick="addExpertise()">Add Expertise</button>
        </div>
        
        <!-- Key Achievements -->
        <div class="form-section">
            <h2><span class="section-number">3</span> Key Achievements</h2>
            <div id="achievementsContainer">
                @php
                    $achievementItems = old('achievements', $resume->achievements ?? []);
                @endphp
                @forelse($achievementItems as $index => $achievement)
                    <div class="dynamic-item">
                        <button type="button" class="remove-btn" onclick="removeAchievement(this)">Remove</button>
                        
                        <div class="form-group">
                            <label>Achievement Title *</label>
                            <input type="text" name="achievements[{{ $index }}][title]" 
                                   value="{{ $achievement['title'] ?? '' }}" 
                                   placeholder="e.g., System Development" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Description *</label>
                            <textarea name="achievements[{{ $index }}][description]" rows="3" required>{{ $achievement['description'] ?? '' }}</textarea>
                        </div>
                    </div>
                @empty
                    <p style="color: #94a3b8; font-style: italic; padding: 20px; text-align: center;">No achievements added yet. Click "Add Achievement" below.</p>
                @endforelse
            </div>
            <button type="button" class="add-btn" onclick="addAchievement()">Add Achievement</button>
        </div>
        
        <!-- Professional Experience -->
        <div class="form-section">
            <h2><span class="section-number">4</span> Professional Experience</h2>
            <div class="form-group">
                <label for="experience">Experience Details</label>
                <textarea id="experience" name="experience" rows="8">{{ old('experience', $resume->experience ?? '') }}</textarea>
                <div class="helper-text">List your work experience. Use bullet points (•) for clarity. Each line will be preserved.</div>
            </div>
        </div>
        
        <!-- Education -->
        <div class="form-section">
            <h2><span class="section-number">5</span> Education</h2>
            <div class="form-group">
                <label for="education">Education Details</label>
                <textarea id="education" name="education" rows="4">{{ old('education', $resume->education ?? '') }}</textarea>
                <div class="helper-text">List your educational background with degrees, institutions, and years</div>
            </div>
        </div>
        
        <!-- Additional Information -->
        <div class="form-section">
            <h2><span class="section-number">6</span> Additional Information</h2>
            <div class="form-group">
                <label for="additional">Additional Details</label>
                <textarea id="additional" name="additional" rows="6">{{ old('additional', $resume->additional ?? '') }}</textarea>
                <div class="helper-text">Languages, certifications, awards, or other relevant information</div>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="actions">
            <a href="{{ route('resume.view') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">📢 Publish Resume</button>
        </div>
    </form>
</div>

<script>
    let achievementCount = {{ count(old('achievements', $resume->achievements ?? [])) }};
    
    // Add Expertise
    function addExpertise() {
        const container = document.getElementById('expertiseContainer');
        const html = `
            <div class="expertise-input-container">
                <input type="text" name="expertise[]" placeholder="e.g., Web Development">
                <button type="button" class="remove-btn" onclick="removeExpertise(this)">✕</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    }
    
    function removeExpertise(button) {
        button.parentElement.remove();
    }
    
    // Add Achievement
    function addAchievement() {
        const container = document.getElementById('achievementsContainer');
        
        // Remove "no achievements" message if it exists
        const noAchievementsMsg = container.querySelector('p');
        if (noAchievementsMsg) {
            noAchievementsMsg.remove();
        }
        
        const html = `
            <div class="dynamic-item">
                <button type="button" class="remove-btn" onclick="removeAchievement(this)">Remove</button>
                
                <div class="form-group">
                    <label>Achievement Title *</label>
                    <input type="text" name="achievements[${achievementCount}][title]" 
                           placeholder="e.g., System Development" required>
                </div>
                
                <div class="form-group">
                    <label>Description *</label>
                    <textarea name="achievements[${achievementCount}][description]" rows="3" required></textarea>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        achievementCount++;
    }
    
    function removeAchievement(button) {
        button.closest('.dynamic-item').remove();
        
        // Show "no achievements" message if container is empty
        const container = document.getElementById('achievementsContainer');
        if (container.children.length === 0) {
            container.innerHTML = '<p style="color: #94a3b8; font-style: italic; padding: 20px; text-align: center;">No achievements added yet. Click "Add Achievement" below.</p>';
        }
    }
    
    // Form submission confirmation
    document.getElementById('resumeForm').addEventListener('submit', function(e) {
        const confirmed = confirm('Are you sure you want to publish these changes? You will be logged out after publishing.');
        if (!confirmed) {
            e.preventDefault();
        }
    });
    
    // Auto-save to localStorage (optional - for recovering unsaved work)
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        // Load saved value
        const savedValue = localStorage.getItem('resume_' + input.name);
        if (savedValue && !input.value) {
            input.value = savedValue;
        }
        
        // Save on change
        input.addEventListener('input', function() {
            localStorage.setItem('resume_' + input.name, input.value);
        });
    });
    
    // Clear localStorage on successful submit
    document.getElementById('resumeForm').addEventListener('submit', function() {
        localStorage.clear();
    });
</script>

</body>
</html>