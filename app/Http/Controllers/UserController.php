<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
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
        $users = User::where('type','user')->get();
        return view('users.list',[
            'users' => $users,
        ]);
    }
}
