<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Order;
use App\User;


class OrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

     /**
     * List events
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function list(Request $request)
    {   
        $restaurants = Restaurant::pluck('name','id');
        $users = User::pluck('name','id');
        $orders = Order::get();
        return view('orders.list',[
            'restaurants' => $restaurants,
            'users' => $users,
            'orders' => $orders
        ]);
    }

    

    
}
