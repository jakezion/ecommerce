<?php namespace App\Controllers;

use App\Entities\Product;
use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;




class Dashboard extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $data = [
            'title' => ucfirst('dashboard')
        ];

//        if (!$this->session->get('admin', true)) {
//            return redirect()
//                ->to('/purchases');
//        }

        return view('dashboard/dashboard', $data);
    }


    public function ajax($category = 'all', $brand = 'all')
    {
        if ($this->request->isAjax()) {

            $product = new ProductModel();

            if ($this->request->getPost('categories')) {
                return $this->respond($product->getCategories());
               // echo json_encode($product->getCategories());

            } elseif ($this->request->getPost('category')) {

                   $category = $this->request->getPost('category');
                   return $this->respond($product->getBrands($category));


            } elseif ($this->request->getPost('brands')) {

                $brand = $this->request->getPost('brand');
                return $this->respond($brand);
              //  echo json_encode($brand);

            }

//            if( $this->request->getPost('category') == 'all'){
//                return $this->respond($product->getAllProducts());
//            } else {
        }
        return $this->failServerError('Request does not appear to be made using AJAX.');
    }


    public function inventory($category = 'all', $brand = 'all')
    {

        $data = [
            'title' => ucfirst('products'),
            'category' => $category,
            'brand' => $brand,
        ];

        if ($this->request->isAjax()) {

            if ($category) $category = $this->request->getPost('product_category');

            if ($brand) $brand = $this->request->getPost('product_brand');

            $details = new Product(['category' => $category, 'brand' => $brand]);

            $product = new ProductModel();

            if ($category == null || $category == 'all') {
                $products = $product->getAllProducts();
            } else if ($brand == 'all') {
                $products = $product->getProductCategory($details);
            } else {
                $products = $product->getProductBrand($details);
            }
            shuffle($products);

//            if (empty($products)) throw new PageNotFoundException('This category does not contain any products.', 404);

            return $this->respond($products);
           // echo json_encode($products);

        } else {
            return view('dashboard/products', $data);
        }

    }


    public function product($productID)
    {

        $details = new Product(['productID' => $productID]);

        $productModel = new ProductModel();

        if ($productModel->exists($details) == 1) {
            $product = $productModel->getProductID($details);
        } else {
            return redirect()
                ->to('/inv');
        }


        $data = [
            'title' => ucfirst($product->name),
            'productID' => $productID,
            'product' => $product
        ];


        return view('dashboard/product', $data);
    }

}