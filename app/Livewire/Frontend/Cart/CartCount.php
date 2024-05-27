<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartCount extends Component
{
    public $cartCount;

    protected $listener =['CartAddedUpdated' => 'checkcartCount'];
    public function checkcartCount()
    {
        if(Auth::check())
        {
            return $this->cartCount = Cart::where('user_id', auth()->user()->id)->count();
        }else{
            return $this->cartCount = 0;
        }
    }
    public function render()
    {
        $this->cartCount = $this-> checkcartCount();
        return view('livewire.frontend.cart.cart-count');
    }
}
