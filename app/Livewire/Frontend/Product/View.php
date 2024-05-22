<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;



class View extends Component
{

    public $category, $product, $prodColorSelectedQuantity,$quantityCount=1;

    public function addToWishList($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                session()->flash('message', 'Produdo já existe na alista de favoritos');
                /*$this->dispatch('message',[
                'text' => "Aready added to wishlist",
                'type'=>'warning',
                'status'=>409,
               ]);*/

                return false;

            } else {

                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId,
                ]);
                $this->dispatch('wishlistAddedUpdated');

                session()->flash('message', 'produto adicionado com sucesso');
                /*$this->dispatch('message',
                ['text' => 'produto adicionado com sucesso',
                'type'=>'success',
                'status'=>200
               ]);*/


            }

        } else {
            session()->flash('message', 'Fazer o Login para Continuar');
            /*$this->dispatch('message',
             ['text' => 'Fazer o Login para Continuar',
             'type'=>'info',
             'status'=>401
            ]);
             return false;*/
        }
    }
    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function colorSelected($productColorId)
    {
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        $this->prodColorSelectedQuantity = $productColor->quantity;

        if ($this->prodColorSelectedQuantity == 0) {
            $this->prodColorSelectedQuantity = "OutOfStock";
        }
    }


    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product
        ]);

    }

    public function incrementQuantity()
    {  if( $this->quantityCount < 10){
        $this->quantityCount++;
    }

    }

    public function decrementQuantity()
    {
        if( $this->quantityCount > 1){
            $this->quantityCount--;
        }
    }
}
