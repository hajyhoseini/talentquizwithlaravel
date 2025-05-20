<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalentInsight extends Model
{
    protected $table = 'talent_insights';

    protected $fillable = [
        'quiz_id',        // 👈 اضافه شده
        'section',
        'level',
        'interpretation',
        'suggestions',
    ];

    protected $casts = [
        'suggestions' => 'string',
    ];
}
