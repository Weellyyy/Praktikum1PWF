<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteProduct extends Component
{
    public string $url;
    public string $message;

    /**
     * Create a new component instance.
     */
    public function __construct(string $url, string $message = 'Are you sure you want to delete this product?')
    {
        $this->url = $url;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-product');
    }
}
