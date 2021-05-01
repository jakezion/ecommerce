<?php


namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\ProductModel;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;




class Basket
{
    use ResponseTrait;

    public function add(int $productID, int $quantity = 1)
    {

        if ($quantity < 1) return $this->failValidationError('Invalid quantity supplied.');


//        $prepResult = $this->prepare($productID, true, true);
//
//        // Check if the result was a HTTP response (failure).
//        if ($prepResult instanceof Response) {
//            return $prepResult;
//        } else {
//            $client = $prepResult['client'];
//            $product = $prepResult['product'];
//        }
//
//
//        // Product exists so try and add it to the cart.
//        $cartModel = new CartModel();
//        if ($cartModel->addProduct($client, $product, $quantity)) {
//            log_message('debug', '[DEBUG] addProduct() called from Cart.');
//            return $this->respondCreated([
//                'status' => 200,
//                'code' => 200,
//                'message' => [
//                    'success' => 'Product added successfully.'
//                ]
//            ]);
//        } else {
//            return $this->failValidationError('Failed to add product to cart.');
//        }
    }


    public function remove()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function purchase()
    {

    }


}