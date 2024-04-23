<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterationController extends Controller
{
    //

    public function index(){
        return view('registeration');
    }

    public function storeRegister(Request $request){
        // dd($request->all());
        $request->validate([
            'first_name' => ['required', 'string', 'alpha'],
            'last_name' => ['required', 'string', 'alpha'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'string',],
            'user_type' => ['required', 'in:Employee,Dealer']
        ]);
        $user = User::create($request->all());
        return redirect()->route('login')->with('success', "Registeration Sucessfully You Can Login Now");
    }

    public function login(){
        return view('login');
    }

    public function storeLogin(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string',],
        ]);
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
    
        // Check if user exists and password matches (without bcrypt)
        if ($user && $user->password === $credentials['password']) {
            Auth::login($user);
            // Redirect to authenticated page
            if(auth()->user()->user_type=='Dealer'){
                return redirect()->route('dealer.city_state_zip');
            }else{
                return redirect()->route('dealers.index');
            }
           
        }
    
        // If authentication fails, redirect back with errors
        return redirect()->back()->with(['mess' => 'Invalid password']);
     
    }

    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'you are logout');
}

public function checkEmail(Request $request){
 
    $email = $request->input('email');
    $user = User::where('email', $email)->first();

    if ($user) {
        // Email already exists
        return response()->json(['exists' => true]);
    } else {
        // Email does not exist
        return response()->json(['exists' => false]);
    }
}

}
