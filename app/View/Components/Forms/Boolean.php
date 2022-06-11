<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Boolean extends Component
{
    public $fieldAttributes;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fieldAttributes)
    {
        $this->fieldAttributes =$fieldAttributes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.boolean');
    }
}
