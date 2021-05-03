<?php namespace App\Controllers;

use App\Entities\Product;
use App\Entities\Account;

use App\Models\BasketModel;
use App\Models\AccountModel;
use App\Models\ProductModel;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;


class Basket extends BaseController
{
    use ResponseTrait;

    public function add(int $productID, int $quantity = 1)
    {
        //if ($quantity < 1) return $this->failValidationError('Product Quantity Invalid.');

        $check = $this->check($productID, true, true);


        if ($check instanceof Response) {

            return redirect()->back()->with('error', $check);
        } else {
            $account = $check["account"];
            $product = $check["product"];
        }


//      //  log_message('debug', '[DEBUG] Cart with id [{cart_id}] already has Product with id [{product_id}].', ['cart_id' => $account, 'product_id' => $product]);
//
        $basket = new BasketModel();

        $add = $basket->add($account, $product, $quantity);

        return $this->respondCreated($add);

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
            //  return redirect()->to('/login')->with('error','No account is signed in. Action cannot be completed.');
            return $this->failUnauthorized('No account is signed in. Action cannot be completed ');
        //check if user account exists


        if ($requireAccount)
            $data['account'] = $this->sessionAccount();


        if (isset($productID)) {

            $model = new ProductModel();

            $product = new Product(['productID' => $productID]);

            if (!$model->find($product->productID))
                return $this->failNotFound('Product doesnt exist in database');
            $data['product'] = $product;

        }


        return $data;


        //see if ajax call or http request
    }

    /**
     * gets the account for the current session
     */
    private function sessionAccount()
    {
        $model = new AccountModel();

        $details = $model->id(new Account(['accountID' => $this->session->accountID]), true);

        return new Account($details);
    }

    public function purchase()
    {

    }

    private function getBasket()
    {

        if (!$this->session->authenticated)
            return redirect()->to('/login')->with('error', 'A valid account must be used to access your basket.');
            //$this->failUnauthorized('User must be logged in to access their basket');

        //get the current account in the session
        $account = $this->sessionAccount();

        // Get the basket items for the current account in the session.
        $model = new BasketModel();

        //get contents of basket_product database for current id
        $basket = $model->getProducts($account);

        // If the cart has no products return a 404 and empty message.
        if (empty($basket))
            return $this->failNotFound('Basket has no items');
            //return redirect()->to('/empty')->with('error','Basket has no items.');

        return $basket;

    }

}