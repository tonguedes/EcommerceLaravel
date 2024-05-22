<?php

namespace App\Livewire\Frontend;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{
    public function removeWishlistItem(int $wishlistId)
    {
        Wishlist::where('user_id',auth()->user()->id)->where('id',$wishlistId)->delete();
        session()->flash('message','Item dos Favoritos removido com sucesso!');
         /*$this->dispatch('message',[
                'text' => "item removido com sucesso",
                'type'=>'success',
                'status'=>200,
               ]);*/
    }
    public function render()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show',['wishlist'=>$wishlist]);
    }
}
