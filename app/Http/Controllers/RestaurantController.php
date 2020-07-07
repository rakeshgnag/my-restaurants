<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Restaurant;
use App\Image;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Input;

class RestaurantController extends Controller
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
     * Create event Form
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function create()
    {   
        return view('restaurants.create');
    }

    /**
     * Store restaurant
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function store(Request $request)
    {   
        // Validating user inputs
         $validator = $request->validate([
            'name' => ['required', 'string'],
            'banner' => ['required','mimes:jpeg,jpg,png,JPG,PNG','max:5120'],
            'description' => ['required', 'string'],
            'lat' => ['required'],
            'lon' => ['required'],
        ]);

        $photo = $request->banner;
        
        $restaurant = new Restaurant();
        $restaurant->name = $request->name;

        //get slug for image
        $slug = Str::slug($request->name, '-');
        $imagename = $slug . '.' . $photo->getClientOriginalExtension();
        $restaurant->image = $imagename;
        //image name 

        $restaurant->slug = $slug;
        $restaurant->description = $request->description;
        $restaurant->lat = $request->lat;
        $restaurant->lon = $request->lon;
        $restaurant->address = $request->address;
        $restaurant->save();

        $image = \Image::make($photo);
        $picture = (string) $image->encode();
        $local = Storage::disk('local')->put(env('RESTAURANTS_IMAGE_PATH') . $imagename, $picture);

        return redirect('/restaurants.list');
    }

    /**
     * Edit event
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function edit(Request $request)
    {   
         // Validating user inputs
         $validator = $request->validate([
            'restaurant_id' => ['required', 'exists:restaurants,id']
        ]);
        $restaurant = Restaurant::find($request->restaurant_id);
        if($restaurant){
            return view('restaurants.edit',[
                'restaurant' => $restaurant,
            ]);
        }
        
    }

    /**
     * Update event
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function update(Request $request)
    {
        // Validating user inputs
         $validator = $request->validate([
            'restaurant_id' => ['required', 'exists:restaurants,id'],
            'name' => ['required', 'string'],
            'banner' => ['mimes:jpeg,jpg,png,JPG,PNG','max:5120'],
            'description' => ['required', 'string'],
            'lat' => ['required'],
            'lon' => ['required'],
        ]);

        $photo = $request->banner;
        
        $restaurant = Restaurant::find($request->restaurant_id);
        $restaurant->name = $request->name;

        //get slug for image
        $slug = Str::slug($request->name, '-');
       
        if($request->banner){
            $imagename = $slug . '.' . $photo->getClientOriginalExtension();
            $restaurant->image = $imagename;
        }
        //image name 

        $restaurant->slug = $slug;
        $restaurant->description = $request->description;
        $restaurant->lat = $request->lat;
        $restaurant->lon = $request->lon;
        $restaurant->save();

        if($request->banner){
            $image = \Image::make($photo);
            $picture = (string) $image->encode();
            $local = Storage::disk('local')->put(env('RESTAURANTS_IMAGE_PATH') . $imagename, $picture);
        }
        
        
        return redirect('/restaurants.list');
    }

    /**
     * Delete event
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function delete(Request $request)
    {   
        // Validating user inputs
         $validator = $request->validate([
            'id' => ['required', 'exists:restaurants,id']
        ]);

        $restaurant = Restaurant::find($request->id);
        $restaurant->delete();
        return redirect('/restaurants.list');
    }


    /**
     * List events
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function list(Request $request)
    {   
        $restaurants = Restaurant::get();
        return view('restaurants.list',[
            'restaurants' => $restaurants,
        ]);
    }

    /**
     * Detail Page Of Event
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function show(Request $request)
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
