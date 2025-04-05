<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MbtiAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'section', 'question_id', 'answer_value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
