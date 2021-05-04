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

            if (!$admin) return $this->failUnauthorized($admin);
//                return redirect()
//                    ->to('/login')
//                    ->with('error', 'you are not an admin. please login with your admin credentials');

            if ($basketID) {

                $details = new Basket(['basketID' => $basketID]);

                $model = new BasketModel();

                $basket = $model->purchased($details);

                if (!$basket) return $this->failNotFound('$basket not purchased');
//                        redirect()
//                            ->to('/')
//                            ->with('error', 'no purchased basket with this id exists');


                $basketProduct = new BasketProductModel();

                $products = $basketProduct->getBasket($basket);


                return $this->respondCreated($products);

            } else {
                //todo return all purchases ever made
                return $this->respondCreated(true);
            }

        }
        return $this->respondCreated(false);
    }
}