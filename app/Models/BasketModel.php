<?php namespace App\Models;

use App\Entities\Basket;
use App\Entities\BasketProduct;
use App\Entities\Product;
use App\Entities\Client;

use CodeIgniter\Model;
use ReflectionException;

class BasketModel extends Model
{

    protected $table = 'basket';
    protected $primaryKey = 'basketID';
    protected $returnType = 'App\Entities\Basket';
    protected $allowedFields = ['accountFK', 'purchased'];
    //protected $skipValidation = false;
    protected $useTimestamps = false;
//    protected $createdField = 'created_at';
//    protected $updatedField = 'updated_at';
//    protected $deletedField = 'deleted_at';
    protected $useAutoIncrement = true;


    public function add(Client $account, Product $product, int $quantity)
    {

        $basket = $this->basket($account);

        $model = new BasketProductModel();



        return $model->addToBasket($basket, $product, $quantity);

    }

    public function basket(Client $account)
    {



        //if account doesnt have basket
        //todo change to find if the accountID exists within the basket database
       //   then when checking if basket exists if the basket that exists is purchased, make a new basket
        if (!$this->exists($account)) {
            //create new basket

            $basket = new Basket(['accountFK' => $account->accountID]);


            //try to insert into database
            try {
                if ($this->insert($basket)) {
                    //return basket
                    return $this->id($account); //todo change this to correct return data

                } else {
                    //return error
                    return false;
                }
            } catch (ReflectionException $e) {
                //return error
                return false;
            }

        } else {
            //basket exists for account already
            return $this->id($account); //todo change this to correct return data

        }


    }

    public function id(Client $account)
    {
        return $this
            ->where('accountFK', $account->accountID)
            ->first();
    }

    public function exists(Client $account)
    {
        $data = $this
            ->select()
            ->where('accountFK', $account->accountID)
            ->countAllResults();

        return ($data === 1);
    }

}
