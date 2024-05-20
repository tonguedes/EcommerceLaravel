<?php

namespace App\Livewire\Frontend\Product;

use Livewire\Component;

class View extends Component
{

     public $category, $product, $prodColorSelectedQuantity;
    public function mount($category, $product)
    {
           $this->category = $category;
           $this->product = $product;
    }

    public function colorSelected($productColorId)
    {
       $productColor = $this->product->productColors()->where('id',$productColorId)->first();
       $this->prodColorSelectedQuantity = $productColor->quantity;

       if($this->prodColorSelectedQuantity==0){
        $this->prodColorSelectedQuantity ="OutOfStock";
       }
    }
    public function render()
    {
        return view('livewire.frontend.product.view',[
            'category' => $this ->category,
            'product' => $this ->product
        ]);

    }
}
