<?php


namespace App\Controllers;


class Dashboard extends BaseController
{
    public function index($page = 'dashboard')
    {
        $data['title'] = ucfirst($page);

        /*
         if (!isset($session->phone)) {
             echo "no phone";
             $session->set->phone('7720904668');
             echo $session;
             return 'Client::login';
         }
        */

        return view('dashboard/dashboard', $data);
    }

    public function products($page = 'products')
    {
        $data['title'] = ucfirst($page);

        return view('dashboard/products', $data);
    }

    public function product($page = 'product')
    {
        $data['title'] = ucfirst($page);

        return view('dashboard/product', $data);
    }

    public function laptops($page = 'laptops')
    {
        $data['title'] = ucfirst($page);

        return view('dashboard/laptops', $data);
    }

    public function phones($page = 'phones')
    {
        $data['title'] = ucfirst($page);

        return view('dashboard/phones', $data);
    }

}