<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllQuestion extends Model
{
    use HasFactory;

    protected $table = 'all_questions';

    protected $fillable = [
        'section',
        'question',
        'quiz_id',
    ];

    public $timestamps = true;

    // تعریف رابطه با مدل Option
 // در مدل AllQuestion.php
public function options()
{
    return $this->hasMany(Option::class, 'question_id');
}

}
