<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $title;
    public $message;
    public $theme;
    public $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $message, $theme, $icon )
    {
        $this->title = $title;
        $this->message = $message;
        $this->theme = $theme;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
