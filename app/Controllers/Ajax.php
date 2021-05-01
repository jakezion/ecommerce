<?php namespace App\Controllers;

use App\Entities\Product;
use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Ajax extends BaseController
{
//    public function dropdown($category = 'all', $brand = 'all')
//    {
//        if ($this->request->isAjax()) {
//
//            $product = new ProductModel();
//
//            if ($this->request->getPost('categories')) {
//
//                echo json_encode($product->getCategories());
//
//            } elseif ($this->request->getPost('category')) {
//
//                $category = $this->request->getPost('category');
//                echo json_encode($product->getBrands($category));
//
//            } elseif ($this->request->getPost('brands')) {
//
//                $brand = $this->request->getPost('brand');
//                echo json_encode($brand);
//
//            }
//        }
//    }
}