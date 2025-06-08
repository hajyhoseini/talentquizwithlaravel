<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeaturedBook extends Model
{
    use HasFactory;

    protected $table = 'featured_books';

    protected $fillable = [
        'quiz_id',
        'name',
        'image_url',
        'related_talent',
        'general_talent',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    // اگر مدل کوییز وجود داشته باشه
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
