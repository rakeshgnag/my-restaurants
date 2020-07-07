<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;
use App\Order;
use App\User;
use DB;

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

        $users = DB::table('users')
          ->select('users.id as userId', 'users.name as name')
          ->join('orders', 'users.id', '=', 'orders.user_id')
          ->distinct('userId')
          ->get();

        $users->groupBy('userId');
        return view('orders.list',[
            'users' => $users,
        ]);
    }


    /**
     * List events
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function  orderDetails(Request $request)
    {   
        $restaurants = Restaurant::pluck('name','id');
        $user = User::find($request->user_id);
        $orders = Order::get();
       
        return view('orders.details',[
            'user' => $user,
            'orders' => $orders,
            'restaurants' => $restaurants
        ]);
    }

    

    
}
