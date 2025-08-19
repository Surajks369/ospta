<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'category_id',
        'image',
        'price',
        'discounted_price',
        'duration',
        'level',
        'instructor',
        'instructor_bio',
        'learning_objectives',
        'requirements',
        'curriculum',
        'language',
        'features',
        'status',
        'sort_order'
    ];

    protected $casts = [
        'status' => 'boolean',
        'price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'features' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function demoBookings()
    {
        return $this->hasMany(DemoBooking::class);
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function getDiscountPercentageAttribute()
    {
        if ($this->discounted_price && $this->price > 0) {
            return round((($this->price - $this->discounted_price) / $this->price) * 100);
        }
        return 0;
    }
}
