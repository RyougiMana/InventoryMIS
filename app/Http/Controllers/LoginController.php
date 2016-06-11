<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    public function index()
    {

        $user = DB::table('commodity')->where('name', 'ipad')->first();
        echo $user->name;
        return view('welcome', ['user' => $user]);

    }

    //
    public function postLogin()
    {
        $user = 'abc';
        return view('auth.login')->with(['user' => $user]);

//        $users = DB::select('select * from users where active = ?', [1]);
//        return view('auth.login', ['users' => $users]);
//        $input = Request::all();
//        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
//            // 认证通过...
//            return redirect('/rbac');
//        }
//        else{
//            echo '输入错误';
//            return redirect('/login');
//        }
    }
}
