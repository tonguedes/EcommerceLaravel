<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;



class View extends Component
{

    public $category, $product, $prodColorSelectedQuantity, $quantityCount = 1, $productColorId;

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


    public function colorSelected($productColorId)
    {
        $this->productColortId = $productColorId;
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        $this->prodColorSelectedQuantity = $productColor->quantity;

        if ($this->prodColorSelectedQuantity == 0) {
            $this->prodColorSelectedQuantity = "OutOfStock";
        }
    }

    public function addToCart(int $productId)
    {
        if (Auth::check()) {
            // dd($productId);
            if ($this->product->where('id', $productId)->where('status', '0')->exists()) {
                // Check for  product color quantity and add to cart
                if ($this->product->productColors()->count() > 1) {
                    if ($this->prodColorSelectedQuantity != NULL) {
                        $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();

                        if ($productColor->quantity > 0) {

                            if ($productColor->quantity > $this->quantityCount) {
                                //Insert product To cart
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'product_color_id' => $this->productColorId,
                                    'quantity' => $this->quantityCount
                                ]);
                                $this->dispatch('CartAddedUpdated');
                                session()->flash('message', 'produto  color adicionado ao carrinho');
                                $this->dispatch(
                                    'message',
                                    [
                                        'text' => 'product Added to Cart',
                                        'type' => 'success',
                                        'status' => 200
                                    ]
                                );
                            } else {
                                $this->dispatch(
                                    'message',
                                    [
                                        'text' => 'only' . $productColor->quantity . 'Quantity Avaliable',
                                        'type' => 'warning',
                                        'status' => 404
                                    ]
                                );

                            }


                        } else {

                            /*$this->dispatch('message',
                           ['text' => 'out of stock',
                            'type'=>'info',
                           'status'=>404
                            ]);*/

                        }
                    } else {
                        /*$this->dispatch('message',
                       ['text' => 'select your product color',
                        'type'=>'info',
                       'status'=>404
                        ]);*/
                    }
                }
                if (Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                    session()->flash('message', 'produto  ja  adicionado ao carrinho');
                } else {

                    if ($this->product->quantity > 0) {
                        if ($this->product->quantity > $this->quantityCount) {
                            //Insert product To cart
                            Cart::create([
                                'user_id' => auth()->user()->id,
                                'product_id' => $productId,

                                'quantity' => $this->quantityCount
                            ]);
                            $this->dispatch('CartAddedUpdated');
                            session()->flash('message', 'produto   adicionado ao carrinho');
                            /*$this->dispatch('message',
                    ['text' => 'product Added to Cart',
                     'type'=>'success',
                    'status'=>200
                     ]);*/
                        } else {
                            /*$this->dispatch('message',
                        ['text' => 'only'.$this->product->quantity.'Quantity Avaliable',
                        'type'=>'warning',
                        'status'=>404
                       ]);*/

                        }
                    }
                }

            } else {
                /*$this->dispatch('message',
                  ['text' => 'não existe',
                  'type'=>'warning',
                  'status'=>404
                 ]);*/

            }

        } else {

            /*$this->dispatch('message',
               ['text' => 'Fazer login para add ao carrinho',
               'type'=>'info',
               'status'=>401
              ]);*/

        }
    }
    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }



    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product
        ]);

    }

    public function incrementQuantity()
    {
        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        }

    }

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }
}
