<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'state',
        'pincode',
        'qualification',
        'image',
        'notes',
        'status'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function demoBookings()
    {
        return $this->hasMany(DemoBooking::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'approved');
    }

    public function getFullAddressAttribute()
    {
        return trim($this->address . ', ' . $this->city . ', ' . $this->state . ' - ' . $this->pincode, ', - ');
    }
}
