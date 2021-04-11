<?php namespace App\Controllers;

use App\Models\ProductModel;


class Dashboard extends BaseController
{
    public function index(){
        $data = [
            'title' => ucfirst('dashboard')
        ];

        //$this->session->set('authenticated', true); //TODO fix
//echo $this->session->get('authenticated');
        if (!$this->session->get('authenticated',true)) {

            return redirect()
                ->to('login')
                ->with('validation','Please sign in correctly');
        }

        return view('dashboard/dashboard', $data);
    }

    public function inventory($group = 'all')
    {

        $productModel = new ProductModel();

        $product = $productModel; //TODO getCategory

        if(empty($product)); //TODO say empty

        $data = [
            'title' => ucfirst('products'),
            'group' => $group,
            'products' => $product
            ];

        return view('dashboard/products', $data);
    }

    public function product($id)
    {
        $data['title'] = ucfirst('product');

        return view('dashboard/product', $data);
    }

}