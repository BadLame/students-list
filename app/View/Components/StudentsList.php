<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StudentsList extends Component
{
    /** @var array|null Список студентов */
    public $students;

    /** @var string Поисковой запрос */
    public $search;

    /** @var string Html постраничной навигации */
    public $pagination;

    /**
     * Create a new component instance.
     *
     * @param $students
     * @param $search
     * @param $pagination
     */
    public function __construct($students, $search, $pagination)
    {
        $this->students = $students;
        $this->search = $search;
        $this->pagination = $pagination;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.students-list');
    }
}
