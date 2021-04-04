<?php


namespace App\Controllers;


class Dashboard extends BaseController {
public function index($page = 'dashboard'){
    $data['title'] = ucfirst($page);

    return view('dashboard/dashboard',$data);
}

    public function products($page = 'products'){
        $data['title'] = ucfirst($page);

        return view('dashboard/products',$data);
    }

    public function laptops($page = 'laptops'){
        $data['title'] = ucfirst($page);

        return view('dashboard/laptops',$data);
    }

    public function phones($page = 'phones'){
        $data['title'] = ucfirst($page);

        return view('dashboard/phones',$data);
    }


}