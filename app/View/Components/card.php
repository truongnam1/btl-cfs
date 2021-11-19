<?php

namespace App\View\Components;

use Illuminate\View\Component;

class card extends Component
{

    public $cus;
    public $arr;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cus)
    {
        $this->cus = $cus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }

    public function arr1($name)
    {
        
        return "day la" . $name;
    }
}
