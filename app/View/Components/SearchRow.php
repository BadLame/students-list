<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchRow extends Component
{
    /** @var string Поисковый запрос */
    public $search;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($search)
    {
        $this->search = $search;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.search-row');
    }
}
