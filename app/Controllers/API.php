<?php namespace App\Controllers;

use App\Entities\BasketProduct;
use App\Models\AccountModel;
use App\Entities\Account;
use App\Entities\Basket;
use App\Models\BasketModel;
use App\Models\BasketProductModel;
use CodeIgniter\API\ResponseTrait;


class Api extends BaseController
{
    use ResponseTrait;

    public function order(int $basketID = null)
    {
        //return $this->respond(true);
        if ($this->session->authenticated) {

            $details = new Account(['accountID' => $this->session->accountID]);

            $model = new AccountModel();

            $account = $model->id($details);

            $admin = $model->isAdmin($account);

            if (!$admin) return $this->failUnauthorized('This account is not authorised to use this API.');


            if ($basketID) {

                $details = new Basket(['basketID' => $basketID]);

                $model = new BasketModel();

                $basket = $model->purchased($details);

                if (!$basket) return $this->failNotFound('A Basket with this id does not exist.');


                $basketProduct = new BasketProductModel();

                $products = $basketProduct->getBasket($basket);



                return $this->respondCreated($products);

            } else {
                //todo return all purchases ever made
                $basketProduct = new BasketProductModel();

                $products = $basketProduct->getAllBaskets();

                return $this->respondCreated($products);

            }

        }
        return $this->failUnauthorized('No account is logged in. To use this API please login.');
    }
}