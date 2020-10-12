<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeadMenu extends Component
{
    /** @var bool Is current user authenticated */
    public $authenticated;


    /**
     * Create a new component instance.
     *
     * @param $authenticated
     */
    public function __construct($authenticated)
    {
        $this->authenticated = $authenticated;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.head-menu');
    }
}
