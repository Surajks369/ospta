<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'offer_code',
        'discount_type',
        'discount_value',
        'minimum_amount',
        'maximum_discount',
        'start_date',
        'end_date',
        'usage_limit',
        'used_count',
        'image',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'discount_value' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'maximum_discount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeValid($query)
    {
        return $query->where('status', true)
                    ->where('start_date', '<=', Carbon::now())
                    ->where('end_date', '>=', Carbon::now());
    }

    public function isValid()
    {
        return $this->status && 
               Carbon::now()->between($this->start_date, $this->end_date) &&
               ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }

    public function calculateDiscount($amount)
    {
        if (!$this->isValid() || ($this->minimum_amount && $amount < $this->minimum_amount)) {
            return 0;
        }

        $discount = 0;
        if ($this->discount_type === 'percentage') {
            $discount = ($amount * $this->discount_value) / 100;
        } else {
            $discount = $this->discount_value;
        }

        if ($this->maximum_discount && $discount > $this->maximum_discount) {
            $discount = $this->maximum_discount;
        }

        return min($discount, $amount);
    }
}
