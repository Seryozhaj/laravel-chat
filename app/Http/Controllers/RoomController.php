<?php

namespace App\Http\Controllers;

use App\Room;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class RoomController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | RoomController Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:6', 'confirmed'],
    //     ]);
    // }

   
    public function index(){
        $room = Room::wher('user_id',Auth::id())->get();
        return view('welcome',[
            'room' => $room
        ]);
    }

    public function create(Request $request)
    {
        $room  = Room::create([
            'name'=>$request->name,
            'user_id'=>Auth::id(),
            'url'=>Str::random(),
        ]);
        if($room){
            return redirect('/');
        }  
    }
}
