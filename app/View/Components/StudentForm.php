<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StudentForm extends Component
{
    public ?array $student;

    /**
     * Create a new component instance.
     *
     * @param array|null $student
     */
    public function __construct(?array $student)
    {
        $this->student = $student;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.student-form');
    }
}
