<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        header('Content-Type: application/json');
    }


    public function AddNewUser(Request $request){

        if ($request->isMethod('post')){
            if(Auth::user()->id == 1 &&
                !empty($request->input('email')) &&
                !empty($request->input('password')) ){

//                $user = new App\User();
//                $user->password = Hash::make($request->input('password'));
//                $user->email = $request->input('email');
//                $user->name = $request->input('email');
//                $user->save();
                $query = DB::table('users')
                    ->insert([
                        'name'=>$request->input('email'),
                        'email'=>$request->input('email'),
                        'password'=>Hash::make($request->input('password'))
                    ]);

                if($query){
                    $i['stauts'] = 'ok';
                }else{
                    $i['stauts'] = 'error #2';
                }

            }else{

                $i['stauts'] = 'error #1';

            }

            echo json_encode(array('AddNewUser'=>$i));
        }

    }


    public function DeleteUser(Request $request){

        if ($request->isMethod('post')){
            if(Auth::user()->id == 1 &&
                !empty($request->input('UserID'))){

                User::where('id',intval($request->input('UserID')))->delete();
                $i['stauts'] = 'ok';

            }else{

                $i['stauts'] = 'error';

            }

            echo json_encode(array('DeleteUser'=>$i));
        }

    }

    public function UpdateUserPassword(Request $request){
        if ($request->isMethod('post')){
            if(Auth::user()->id == 1 &&
                !empty($request->input('UserID')) &&
                !empty($request->input('NewPassword'))){

                User::where('id',intval($request->input('UserID')))->update([
                    'password'=>Hash::make($request->input('NewPassword'))
                ]);
                $i['stauts'] = 'ok';
                $this->LogoutUser(intval($request->input('UserID')));

            }else{

                $i['stauts'] = 'error';
            }

            echo json_encode(array('UpdateUserPassword'=>$i));
        }
    }


    public function UpdateMyPassword(Request $request){
        if ($request->isMethod('post')){
            if(!empty($request->input('NewPassword'))){

                User::where('id',Auth::user()->id)
                    ->update([
                    'password'=>Hash::make($request->input('NewPassword'))
                ]);
                $i['stauts'] = 'ok';

            }else{

                $i['stauts'] = 'error';
            }

            echo json_encode(array('UpdateMyPassword'=>$i));
        }
    }

    public function LoadAllUser(){
        if (Auth::user()->id == 1){
            $i['data'] = User::orderBy('created_at','DESC')
                ->select(
                    'id',
                    'email'
                )->get();
            $i['stauts'] = 'ok';

        }else{
            $i['stauts'] = 'error';
        }
        echo json_encode(array('LoadAllUser'=>$i));
    }



    private function LogoutUser($userID){
//        $user = Auth::user();
//        $userToLogout = User::find(intval($userID));
//        Auth::setUser($userToLogout);
//        Auth::logout();
//        Auth::setUser($user);
    }

}
