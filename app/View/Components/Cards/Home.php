<?php

namespace App\View\Components\Cards;

use Illuminate\View\Component;

class Home extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $unit = '', public $icon = '', public $text = '', public $url = '', public $value = 0)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cards.home');
    }
}
