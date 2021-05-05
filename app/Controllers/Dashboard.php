<?php namespace App\Controllers;

use App\Entities\Product;
use App\Models\AccountModel;
use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;


class Dashboard extends BaseController
{
    use ResponseTrait;

    /**
     * @return \CodeIgniter\HTTP\RedirectResponse|string main index page redirects to products page
     *
     */
    public function index()
    {
        $data = ['title' => ucfirst('dashboard')];

        return redirect()->to('/inv');

        return view('dashboard/dashboard', $data);

    }


    /**
     * @param string $category
     * @param string $brand
     * @return Response|mixed returns all categories available
     */
    public function categories($category = 'all', $brand = 'all')
    {
        if ($this->request->isAjax()) {
            $product = new ProductModel();

            return $this->respond($product->getCategories());
        }
        return $this->failServerError('Request does not appear to be made using AJAX.');
    }


    /**
     * @param string $category
     * @param string $brand
     * @return Response|mixed returns all brands for a specific category
     */
    public function brand($category = 'all', $brand = 'all')
    {
        if ($this->request->isAjax()) {
            $product = new ProductModel();


            return $this->respond($product->getBrands($category));
        }
        return $this->failServerError('Request does not appear to be made using AJAX.');
    }


    /**
     * @param string $category
     * @param string $brand
     * @return mixed|string returns all products based on their category and brand
     */
    public function inventory($category = 'all', $brand = 'all')
    {

        $data = [

            'title' => ucfirst('products'),
            'category' => $category,
            'brand' => $brand,
        ];

        if ($this->request->isAjax()) {

            $details = new Product(['category' => $category, 'brand' => $brand]);

            $product = new ProductModel();


            if ($category == 'all') {
                $products = $product->getAllProducts();
            } else if ($brand == 'all') {
                $products = $product->getProductCategory($details);
            } else {
                $products = $product->getProductBrand($details);
            }
            shuffle($products);

            if (empty($products)) $this->failNotFound('This category does not contain any products.', 404);

            return $this->respond($products);

        } else {

            return view('dashboard/products', $data);

        }

    }


    /**
     * @param $productID
     * @return \CodeIgniter\HTTP\RedirectResponse|string returns an individual product based on its id
     */
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