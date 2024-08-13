<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class Header extends Component
{
    /**
     * Get the number of items in the logged-in user's cart.
     *
     * @return int
     */
    public function cartItemCount()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->count();
        }
        return 0;
    }

    /**
     * The view that should be rendered for the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.header');
    }
}