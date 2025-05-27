<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizResultLevel extends Model
{
    protected $table = 'quiz_result_levels';

    protected $fillable = [
        'quiz_id',
        'min_score',
        'max_score',
        'label',
        'icon',
        'color_class',
    ];

    // اگر timestamps استفاده می‌کنید (created_at, updated_at)
    public $timestamps = true;

    // رابطه با مدل Quiz
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}
