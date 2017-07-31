<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class UpdatePasswordController extends Controller
{
    /*
     * Ensure the user is signed in to access this page
     */
    public function __construct() {

        $this->middleware('auth');

    }

    /**
     * Update the password for the user.
     *
     * @param  Request  $request
     * @return Response
     */

     public function ShowUserProfile(){
         $user = User::find(Auth::id());
         return view('users.usersettings')->with("user",$user);
     }


    public function UpdateUserProfile(Request $request){

       $user = User::find(Auth::id());

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|regex:/^[0-9]{9}$/|unique:users',
        ]);

        if (!$validator->fails()){

            $user = User::find(Auth::id());
            $user->name=$request['name'];
            $user->email=$request['email'];

            $user->save();

            return redirect('/settings/user')->with('success','successfully updated');
        }
        else{
             return redirect()->back()->withErrors($validator)->withInput();
        }







     }

    public function update(Request $request)
    {
        $this->validate($request, [
            'old' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::find(Auth::id());
        $hashedPassword = $user->password;

        if (Hash::check($request->old, $hashedPassword)) {
            //Change the password
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            $request->session()->flash('success', 'Your password has been changed.');

            return back();
        }

        $request->session()->flash('failure', 'Your password has not been changed.');

        return back();


    }
}

?>
