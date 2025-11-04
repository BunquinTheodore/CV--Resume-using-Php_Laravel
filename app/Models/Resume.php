<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'name',
        'photo',
        'address',
        'email',
        'phone',
        'headline',
        'summary',
        'expertise',
        'achievements',
        'experience',
        'education',
        'additional',
        'is_published',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'expertise' => 'array',
        'achievements' => 'array',
        'is_published' => 'boolean',
    ];

    /**
     * Get the formatted last updated date.
     */
    public function getLastUpdatedAttribute()
    {
        return $this->updated_at->format('Y-m-d H:i:s');
    }

    /**
     * Get the user that owns the resume.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}