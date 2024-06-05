<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;
use Livewire\Component;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount=0;

    public $fullname,$email,$phone,$pincode,$address,$payment_mode=NULL,$payment_id = NULL;

    public function rules()
    {
        return[
            'fullname'=>'required|string|max:120',
            'email'=>'required|string|max:120',
            'phone'=>'required|string|max:11|min:10',
            'pincode'=>'required|string|max:6|min:6',
            'address'=>'required|string|max:500'


        ];
    }

    public function codOrder()
    {
        $this->validate();
        $this->payment_mode = 'Pagamento na entrega';
        $codOrder = $this->placeOrder();
        if($codOrder){

            Cart::where('user_id',auth()->user()->id)->delete();

            session()->flash('message','Ordem feita  com sucesso!');
         $this->dispatch('message',[
                'text' => "Ordem feita  com sucesso!",
                'type'=>'success',
                'status'=>200,
               ]);
               return redirect()->to('thank-you');
        }else{
            session()->flash('message','algo deu errado!');
            $this->dispatch('message',[
                'text' => "algo deu errado!",
                'type'=>'error',
                'status'=>500,
               ]);
        }
    }

    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id'=>auth()->user()->id,
            'traking_no'=>'fundaçao'.Str::random(10),
            'fullname'=>$this->fullname,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'pincode'=>$this->pincode,
            'address'=>$this->address,
            'status_message'=>'em progresso',
            'payment_mode'=>$this->payment_mode,
            'payment_id'=>$this->payment_id,
        ]);

        foreach ($this->carts as $cartItem) {
             Orderitem::create([
                'order_id'=>$order->id,
                'product_id'=>$cartItem->product_id,
                'product_color_id'=>$cartItem->product_color_id,
                'quantity'=>$cartItem->quantity,
              'price'=>$cartItem->product->selling_price

            ]);

            if($cartItem->product_color_id != NULL){

                $cartItem->productColor()->where('id',$cartItem->product_color_id)->decrement('quantity',$cartItem->quantity);
            }else{
                $cartItem->product()->where('id',$cartItem->product_id)->decrement('quantity',$cartItem->quantity);
            }


            //$this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }

        return $order;



    }
    public function totalProductAmount()
    {
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->carts as $cartItem) {
            $this->totalProductAmount += $cartItem->product->selling_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;

    }
    public function render()
    {   $this->fullname = auth()->user()->name;
        $this->email= auth()->user()->email;
        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
