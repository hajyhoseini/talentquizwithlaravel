<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeaturedPerson extends Model
{
    use HasFactory;

    protected $table = 'featured_people';

    protected $fillable = [
        'quiz_id',
        'name',
        'image_url',
        'related_talent',
        'general_talent',
    ];

    // اگر می‌خوای ارتباط با مدل Quiz رو هم داشته باشی
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
