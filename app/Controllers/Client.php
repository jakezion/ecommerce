<?php


namespace App\Controllers;


class Client extends BaseController {

    public function login($page = 'login'){
        $data['title'] = ucfirst($page);
//        $name = $_SESSION['phone'];
        return view('client/login',$data);
    }

    public function logout($page = 'logout'){

        return view('client/logout');
    }

    public function register($page = 'register'){
        $data['title'] = ucfirst($page);
        return view('client/register',$data);
    }
}