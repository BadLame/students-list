<?php

namespace App\View\Components;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StudentsList extends Component
{
    /** @var Paginator|null Список студентов */
    public ?Paginator $students;

    /** @var string|null Поисковой запрос */
    public ?string $search;

    /** @var string|null Html постраничной навигации */
    public ?string $pagination_html;

    /** @var array|string[] Состояние сортировки и url для колонок */
    public array $cols_data;


    /**
     * Create a new component instance.
     *
     * @param Paginator|null $students
     * @param string|null $search
     * @param string|null $paginationHtml
     * @param array $colsData
     */
    public function __construct(
        ?Paginator $students, ?string $search, ?string $paginationHtml, array $colsData)
    {
        $this->students = $students;
        $this->search = $search;
        $this->pagination_html = $paginationHtml;
        $this->cols_data = $colsData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.students-list');
    }
}
