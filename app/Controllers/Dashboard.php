<?php namespace App\Controllers;

use App\Entities\Product;
use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;


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

    public function inventory($category = 'all')
    {

        //$request = $this->request->getPost();

        $details = new Product(['category' => $category]); //TODO handle if set or not

        $product = new ProductModel();

        $products = $product->getProductCategory($details);

        //shuffles returned order of products for variety on page
        shuffle($products);

        //if (empty($product)) return new PageNotFoundException('product category doesn\'t exist.'); //TODO say empty
        if (empty($products)) throw new PageNotFoundException('This category does not contain any products.', 404);


        $data = [
            'title' => ucfirst('products'),
            'category' => $category,
            'products' => $products
        ];

        return view('dashboard/products', $data);
    }

    public function brand($brand){

    }

    public function product($productID)
    {

        $details = new Product(['productID' => $productID]);
        $data['title'] = ucfirst('product');

        return view('dashboard/individual', $data);
    }

}