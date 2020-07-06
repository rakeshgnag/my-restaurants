<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Config;
use Redirect;
use App\Restaurant;
use App\Order;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    /**
     * Search Function
     *
     */
    public function search(Request $request)
    {
        $locations = Config::get('locations');
        $latitude = $locations[$request->location]['lat'];
        $longitude = $locations[$request->location]['lon'];

        //search restaurants within radius 4 kms
        $restaurants = Restaurant::select(DB::raw('*, ( 6367 * acos( cos( radians('.$latitude.') ) * cos( radians( lat ) ) * cos( radians( lon ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( lat ) ) ) ) AS distance'))
            ->having('distance', '<', 4)
            ->orderBy('distance')
            ->get();

        if($restaurants->isEmpty()){
           return Redirect::back()->withErrors(['Sorry no restaurants found in your location']);
        }
        return view('restaurants.searchsuccess',[
            'restaurants' => $restaurants,
        ]);
        
    }
     /**
     * Store restaurant
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function orderStore(Request $request)
    {   
        // Validating user inputs
         $validator = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'restaurant_id' => ['required',  'exists:restaurants,id']
        ]);
        
        $old_order = Order::where('user_id', $request->user_id)
                     ->where('restaurant_id', $request->restaurant_id)
                     ->first();
        if(!$old_order){
            $order = new Order();
            $order->user_id = $request->user_id;
            $order->restaurant_id = $request->restaurant_id;
            $order->save();

            $restaurant = Restaurant::find($request->restaurant_id);
            return view('restaurants.success',[
                'restaurant' => $restaurant,
            ]);
        }
        return Redirect::back()->withErrors(['You have already paid for this restaurant']);
        

    }


     /**
     * Detail Page Of Event
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function restaurantShow(Request $request)
    {   
        // Validating user inputs
         $validator = $request->validate([
            'restaurant_id' => ['required', 'exists:restaurants,id']
        ]);
        $restaurant = Restaurant::find($request->restaurant_id);
        return view('restaurants.show',[
            'restaurant' => $restaurant
        ]);
    }
}
