<?php
// filepath: /home/fian/laravel/myanimelist-app/app/View/Components/InputError.php

namespace App\View\Components;

use Illuminate\View\Component;

class InputError extends Component
{
    /**
     * The error messages.
     *
     * @var array
     */
    public $messages;

    /**
     * Create a new component instance.
     *
     * @param  array  $messages
     * @return void
     */
    public function __construct($messages)
    {
        $this->messages = $messages;
    }

    /**
     * Determine if the error message should be displayed.
     *
     * @return bool
     */
    public function shouldRender()
    {
        return isset($this->messages) && count($this->messages) > 0;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-error');
    }
}
