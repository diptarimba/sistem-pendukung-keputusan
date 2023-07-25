<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Carousel extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $IdCarousel;
    public function __construct(public $content)
    {
        $this->IdCarousel = Str::random(10);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.carousel');
    }
}
