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
     
        if(auth()->user()->id){
            return view('profile', compact('user'));
        }else{
            return redirect()->route('login')->with('errors', 'you are not login');
        }
        

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
        $create = User::where('id', $request->id)->update($data);
        if(auth()->user()->user_type=='Dealer'){
            return redirect()->route('dealer.city_state_zip')->with('success', "Record Update Successfully");
        }else{
            return redirect()->route('dealers.index')->with('success', "Record Update Successfully");
        }
    }

    public function list(Request $request){
        
        $dealers = User::where('user_type', 'Dealer');
        if($request->zip){
            $dealers = $dealers  ->where('zip_code', 'LIKE', "%$request->zip%");
        }
       
       $dealers= $dealers->simplePaginate(1);
       
       if(!empty(auth()->user()->id)){
            return view('index', compact('dealers'));
        }else{
            return redirect()->route('login')->with('mess', 'you are not login');
        }
        
    }
  
}
