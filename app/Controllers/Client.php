<?php


namespace App\Controllers;


class Client extends BaseController
{

    public function getLogin($page = 'login')
    {

        if($this->session->get('authenticated')){
            return redirect()->to($this->validAuthentication);
        }

        $data['title'] = ucfirst($page);


        return view('client/login', $data);
    }

    public function postLogin($page = 'login')
    {

        if($this->session->get('authenticated')){
            return redirect()->to($this->validAuthentication);
        }
        $data['title'] = ucfirst($page);
        return view('client/login', $data);
    }

    public function logout($page = 'logout')
    {

        return view('client/logout');
    }

    public function register($page = 'register')
    {
        $data['title'] = ucfirst($page);
        return view('client/register', $data);
    }
}