<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'price',
        'duration',
        'level',
        'discount_price'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'course_id');
    }
}
