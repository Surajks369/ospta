<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'user_registration_id',
        'enrollment_date',
        'amount_paid',
        'payment_method',
        'payment_reference',
        'payment_status',
        'enrollment_status',
        'start_date',
        'end_date',
        'progress_percentage',
        'notes'
    ];

    protected $casts = [
        'enrollment_date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date',
        'amount_paid' => 'decimal:2',
        'progress_percentage' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function userRegistration()
    {
        return $this->belongsTo(UserRegistration::class);
    }

    public function scopeActive($query)
    {
        return $query->where('enrollment_status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('enrollment_status', 'completed');
    }

    public function getPaymentStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'completed' => 'success',
            'failed' => 'danger',
            'refunded' => 'info'
        ];

        return $badges[$this->payment_status] ?? 'secondary';
    }

    public function getEnrollmentStatusBadgeAttribute()
    {
        $badges = [
            'active' => 'success',
            'completed' => 'primary',
            'cancelled' => 'danger',
            'suspended' => 'warning'
        ];

        return $badges[$this->enrollment_status] ?? 'secondary';
    }
}
