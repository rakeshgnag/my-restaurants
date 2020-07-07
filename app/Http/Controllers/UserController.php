<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Redirect;

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

    /**
     * Create User Form
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function create(Request $request)
    {   
        return view('users.create');
    }


    /**
     * Store User
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function store(Request $request)
    {   
        // Validating user inputs
         $validator = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required','email','unique:users'],
            'password' => ['required'],
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/users.list');
    }

    /**
     * Edit event Form
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function edit(Request $request)
    {   
        // Validating user inputs
         $validator = $request->validate([
            'user_id' => ['required', 'exists:users,id']
        ]);
        $user = User::find($request->user_id);

        return view('users.edit',[
            'user' => $user
        ]);
    }

    /**
     * Update User
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function update(Request $request)
    {   
        // Validating user inputs
         $validator = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string'],
            'email' => ['required','email'],
        ]);
        
        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
         $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('/users.list');
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
            'id' => ['required', 'exists:users,id']
        ]);

        $user = User::find($request->id);
        $user->delete();
        session()->flash('message', 'User delete successfully!!');
        return redirect('/users.list');
    }

}
