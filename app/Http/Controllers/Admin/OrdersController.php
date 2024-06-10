<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrdersController extends Controller
{
    public function index()

    {   $todayDate = Carbon::now();

        $orders = Order::whereDate('created_at',$todayDate)->paginate(10 );
        return view('admin.orders.index', compact('orders'));
    }

    public function show(int $order_Id)
    {

        $order = Order::where('id',$order_Id)->first();
        if($order){
            return view('admin.orders.view', compact('order'));
        }else
        {
          return redirect('admin/orders')->with('message','sem Id da Ordem');
        }
        return view('admin.orders.index', compact('orders'));
    }

}