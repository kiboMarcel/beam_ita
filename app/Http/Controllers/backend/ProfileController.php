<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //

    
    public function ProfileView(){
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('backend.user.view_profil', compact('user') );

    }

    public function ProfileUpdate(Request $request){

        $id = Auth::user()->id;

        $user =  User::find($id);
        $user -> name = $request->name;
        $user -> email = $request->email;
        $user -> address = $request->address;
        $user -> mobile = $request->mobile;
        $user -> gender = $request->gender;
        $user -> save();
        

        //return redirect()-> route('user.view');
        return view('backend.user.view_profil', compact('user') );

    }

    public function ProfilePasswordView(){
        return view('backend.user.edit_password' );
    }

    public function PasswordUpdate(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword)){
            $user= User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        }else{
            return redirect()->back()->with('error', '');
        }
    }
}
