<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ExamList extends Component
{
    public $exams;

    public function __construct($exams)
    {
        $this->exams = $exams;
    }

    public function render()
    {
        return view('components.exam-list');
    }
}
