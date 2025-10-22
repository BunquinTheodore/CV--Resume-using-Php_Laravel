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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 30px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px 50px;
        }
        
        h1 {
            color: #667eea;
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        
        .form-section {
            margin-bottom: 35px;
        }
        
        .form-section h2 {
            color: #764ba2;
            font-size: 1.6em;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #764ba2;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 1.05em;
        }
        
        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1em;
            font-family: inherit;
            transition: border-color 0.3s ease;
        }
        
        input:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
            line-height: 1.6;
        }
        
        /* Dynamic Fields */
        .dynamic-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        
        .dynamic-item {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #e0e0e0;
            position: relative;
        }
        
        .remove-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #dc3545;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background 0.3s ease;
        }
        
        .remove-btn:hover {
            background: #c82333;
        }
        
        .add-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 10px;
            transition: background 0.3s ease;
        }
        
        .add-btn:hover {
            background: #218838;
        }
        
        /* Expertise Input */
        .expertise-input-container {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }
        
        .expertise-input-container input {
            flex: 1;
        }
        
        /* Actions */
        .actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e0e0e0;
        }
        
        .btn {
            padding: 14px 32px;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        /* Logout Button */
        .logout-btn {
            position: fixed;
            top: 30px;
            right: 30px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            padding: 10px 24px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: white;
            color: #667eea;
        }
        
        .error-message {
            color: #dc3545;
            font-size: 0.9em;
            margin-top: 5px;
        }
        
        .helper-text {
            color: #666;
            font-size: 0.9em;
            margin-top: 5px;
            font-style: italic;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 30px 25px;
            }
            
            h1 {
                font-size: 2em;
            }
            
            .actions {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
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
    <h1>✏️ Edit Your Resume</h1>
    <p class="subtitle">Update your information and click "Publish Resume" to save changes and make them live</p>
    
    <form method="POST" action="{{ route('resume.update', $resume->id ?? 1) }}" id="resumeForm">
        @csrf
        
        <!-- Basic Information -->
        <div class="form-section">
            <h2>📋 Basic Information</h2>
            
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
            <h2>💡 Area of Expertise</h2>
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
            <button type="button" class="add-btn" onclick="addExpertise()">+ Add Expertise</button>
        </div>
        
        <!-- Key Achievements -->
        <div class="form-section">
            <h2>🏆 Key Achievements</h2>
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
                    <p style="color: #999; font-style: italic;">No achievements added yet. Click "Add Achievement" below.</p>
                @endforelse
            </div>
            <button type="button" class="add-btn" onclick="addAchievement()">+ Add Achievement</button>
        </div>
        
        <!-- Professional Experience -->
        <div class="form-section">
            <h2>💼 Professional Experience</h2>
            <div class="form-group">
                <label for="experience">Experience Details</label>
                <textarea id="experience" name="experience" rows="8">{{ old('experience', $resume->experience ?? '') }}</textarea>
                <div class="helper-text">List your work experience. Use bullet points (•) for clarity. Each line will be preserved.</div>
            </div>
        </div>
        
        <!-- Education -->
        <div class="form-section">
            <h2>🎓 Education</h2>
            <div class="form-group">
                <label for="education">Education Details</label>
                <textarea id="education" name="education" rows="4">{{ old('education', $resume->education ?? '') }}</textarea>
                <div class="helper-text">List your educational background with degrees, institutions, and years</div>
            </div>
        </div>
        
        <!-- Additional Information -->
        <div class="form-section">
            <h2>📌 Additional Information</h2>
            <div class="form-group">
                <label for="additional">Additional Details</label>
                <textarea id="additional" name="additional" rows="6">{{ old('additional', $resume->additional ?? '') }}</textarea>
                <div class="helper-text">Languages, certifications, awards, or other relevant information</div>
            </div>
        </div>
        
        <!-- Actions -->
        <div class="actions">
            <a href="{{ route('resume.view') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">📢 Publish Resume & Logout</button>
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
            container.innerHTML = '<p style="color: #999; font-style: italic;">No achievements added yet. Click "Add Achievement" below.</p>';
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