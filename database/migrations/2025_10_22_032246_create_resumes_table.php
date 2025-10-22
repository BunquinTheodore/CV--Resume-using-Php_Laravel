<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('headline')->nullable();
            $table->text('summary')->nullable();
            $table->json('expertise')->nullable(); // Array of skills
            $table->json('achievements')->nullable(); // Array of achievement objects
            $table->text('experience')->nullable();
            $table->text('education')->nullable();
            $table->text('additional')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // Insert default resume data
        DB::table('resumes')->insert([
            'name' => 'THEODORE VON JOSHUA M. BUNQUIN',
            'address' => 'Alangilan, Batangas',
            'email' => 'bunquintheodore@gmail.com',
            'phone' => '(+63) 966 02 5692',
            'headline' => 'Creative AI Developer & Digital Content Specialist',
            'summary' => 'Passionate about delivering innovative, tech-driven solutions that captivate and engage.',
            'expertise' => json_encode([
                'Prompt Engineering',
                'Programming',
                'AI-Powered Development',
                'Web Development'
            ]),
            'achievements' => json_encode([
                [
                    'title' => 'System Development',
                    'description' => 'Designed and launched EduManageX, a Java-based School Management System with SQL integration.'
                ],
                [
                    'title' => 'Algorithm Engineering',
                    'description' => 'Built a Maze Solver in C++ using data structures and algorithmic logic.'
                ]
            ]),
            'experience' => "Freelance Developer & Content Specialist | Self-Employed | 2025 - Present\n\n• Delivered websites, content, and social media visuals for diverse clients.\n• Provided virtual assistance, graphic design, and creative support.\n• Collaborated with international teams on AI-powered projects.",
            'education' => 'Bachelor of Science in Computer Science | National Engineering University, Philippines | Aug 2023 – 2027',
            'additional' => "Languages: English, Filipino\nCertifications: Python Programming (CodeAlpha Internship)\nAwards/Activities: AI Vibe Coding Competition Participant (2025)",
            'is_published' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};