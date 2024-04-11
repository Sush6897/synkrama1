<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DealerProfileController extends Controller
{
    //

    public function index($id=""){
        if(!empty($id)){
            $user = User::where('id', $id)->first();
        }else{
            $user = User::where('id', auth()->user()->id)->first();
 
        }
        return view('profile', compact('user'));

    }

    public function update(Request $request){
        $request->validate([
            "city" =>'required|string|alpha',
            "state" =>'required|string|alpha',
            "zip" =>'required|numeric|digits:6',
        ]);
        $data= [
            'city'=>$request->city,
            'state'=> $request->state,
            'zip_code' => $request->zip,
        ];
        $create = User::where('id', auth()->user()->id)->update($data);
        return redirect()->route('dealer.city_state_zip');
    }

    public function list(Request $request){
        
        $dealers = User::where('user_type', 'Dealer');
        if($request->zip){
            $dealers = $dealers  ->where('zip_code', 'LIKE', "%$request->zip%");
        }
       
       $dealers= $dealers ->get();
        
        return view('index', compact('dealers'));
    }
  
}
