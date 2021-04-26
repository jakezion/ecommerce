<?php namespace App\Controllers;

use App\Entities\Product;
use App\Models\ProductModel;


class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'title' => ucfirst('dashboard')
        ];

        //$this->session->set('authenticated', true); //TODO fix
        //echo $this->session->get('authenticated');

//        if (!$this->session->get('authenticated', true)) {
//
//            return redirect()
//                ->to('/login')
//                ->with('error', 'Please sign in correctly');
//        }

        return view('dashboard/dashboard', $data);
    }

    public function inventory($group = 'all')
    {

        $request = $this->request->getPost();

        $details = new Product($request);

        $productList = new ProductModel();

        $product = $productList->getProductCategory($details); //TODO getCategory

        //        echo var_dump($category);
        //$this->response->send();


        if (empty($product)) ; //TODO say empty

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

        return view('dashboard/individual', $data);
    }

}