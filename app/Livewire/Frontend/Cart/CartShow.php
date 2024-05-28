<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;


class CartShow extends Component
{
    public $cart;

    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if ($productColor->quantity > $cartData->quantity) {
                    $cartData->decrement('quantity');
                    session()->flash('message', 'quantidade de cor atualizada');
                    /*$this->dispatch('message',
                     ['text' => 'product Added to Cart',
                     'type'=>'success',
                    'status'=>200
                     ]);*/

                } else {
                    session()->flash('somente' . $productColor->quantity . 'em estoque');
                }

            } else {

                if ($cartData->product->quantity > $cartData->quantity) {
                    $cartData->decrement('quantity');
                    session()->flash('message', 'Quantidade atualizada');
                    /*$this->dispatch('message',
                     ['text' => 'product Added to Cart',
                     'type'=>'success',
                    'status'=>200
                     ]);*/
                } else {
                    session()->flash('somente' . $cartData->product->quantity . 'em estoque');
                }
            }

        } else {
            session()->flash('message', 'Ops algo de errado!');
        }
    }

    public function incrementQuantity(int $cartId)
    {

        $cartData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if ($cartData) {
            if ($cartData->productColor()->where('id', $cartData->product_color_id)->exists()) {
                $productColor = $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if ($productColor->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    session()->flash('message', 'quantity color update');
                    /*$this->dispatch('message',
                     ['text' => 'product Added to Cart',
                     'type'=>'success',
                    'status'=>200
                     ]);*/

                } else {
                    session()->flash('somente' . $productColor->quantity . 'em estoque');
                }

            } else {

                if ($cartData->product->quantity > $cartData->quantity) {
                    $cartData->increment('quantity');
                    session()->flash('message', 'quantity update');
                    /*$this->dispatch('message',
                     ['text' => 'product Added to Cart',
                     'type'=>'success',
                    'status'=>200
                     ]);*/
                } else {
                    session()->flash('somente' . $cartData->product->quantity . 'em estoque');
                }
            }

        } else {
            session()->flash('message', 'ops algo nao deu certo!');
        }

    }

    public function removeCartItem(int $cartId)
    {
        $cartRemoveData=Cart::where('user_id',auth()->user()->id)->where('id',$cartId)->first();
        if($cartRemoveData){
            $cartRemoveData->delete();
            session()->flash('message', 'Produdo removido do Carrinho');
                /*$this->dispatch('message',[
                'text' => "Aready added to wishlist",
                'type'=>'warning',
                'status'=>409,
               ]);*/
        }else{
            session()->flash('message', 'Ops algo deu errado');
        }


    }
    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }
}
