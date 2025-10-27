<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'job_title',
        'photo',
        'qualification',
        'bio',
        'email',
        'phone',
        'social_links',
        'specializations',
        'sort_order',
        'status'
    ];

    protected $casts = [
        'social_links' => 'array',
        'status' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}