<?php


namespace App\Controllers;

use App\Entities\Product;
use App\Entities\Client;

use App\Models\ClientModel;
use App\Models\ProductModel;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;


class Basket extends BaseController
{
    use ResponseTrait;


    public function add(int $productID, int $quantity = 1)
    {

        if ($quantity < 1) return $this->failValidationError('Product Quantity Invalid.');

        $check = $this->check($productID, true, true);

        $account = $check['account'];
        $product = $check['product'];

        $basket = new BasketModel();

        if ($basket->add($account, $product, $quantity)) {

            return $this->respondCreated([
                'status' => 200,
                'code' => 200,
                'message' => [
                    'success' => 'Product has been added successfully to basket.'
                ]
            ]);

        } else {

            return $this->failValidationError('Product could not be added to the shopping basket');

        }

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

    private function check(int $productID = null, bool $authenticated = true, bool $requireAccount = true)
    {
        $data = [];
        //if product exists

        //check if account is authenticated otherwise redirect to login as they need to be signed in
        if (!$this->session->authenticated)
            return $this->failUnauthorized('No account is signed in. Action cannot be completed ');
        //check if user account exists
        if ($requireAccount) {
            $model = new ClientModel();

            $details = $model->id(new Client(['accountID' => $this->session->accountID]), true);

            $account = new Client($details);

            array_push($data, ['account' => $account]);

        }

        if (isset($productID)) {
            $model = new ProductModel();

            $product = new Product(['productID' => $productID]);

            if ($model->exists($product->productID) !== 1) {
                return $this->failNotFound('Product doesnt exist in database');
            }

            array_push($data, ['product' => $product]);
        }

        return $data;

        //see if ajax call or http request
    }

    public function purchase()
    {

    }

    public function get()
    {

    }


}