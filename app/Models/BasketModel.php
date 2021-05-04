<?php namespace App\Models;

use App\Entities\Basket;
use App\Entities\BasketProduct;
use App\Entities\Product;
use App\Entities\Account;

use CodeIgniter\Model;
use ReflectionException;

class BasketModel extends Model
{

    protected $table = 'basket';
    protected $primaryKey = 'basketID';
    protected $returnType = 'App\Entities\Basket';
    protected $allowedFields = ['accountFK', 'purchased'];
    //protected $skipValidation = false;

//    protected $createdField = 'created_at';
//    protected $updatedField = 'updated_at';
//    protected $deletedField = 'deleted_at';
    protected $useAutoIncrement = true;


    /**
     * @param Account $account
     * @param Product $product
     * @param int $quantity
     * @return \CodeIgniter\Database\BaseResult|false|int|object|string
     */
    public function add(Account $account, Product $product, int $quantity)
    {

        $basket = $this->basket($account);

        $model = new BasketProductModel();


        return $model->addToBasket($basket, $product, $quantity);

    }

    /**
     * @param Account $account
     * @return array|false|object|null
     */
    public function basket(Account $account)
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

    /**
     * @param Account $account
     * @return array|false
     */
    public function getProducts(Account $account)
    {
        // check if account basket exists
        if (!$this->exists($account))
            return false;

        // get basketproduct entity for basket id related to basket id (with accountFK)
        $basket = $this->basket($account);

        // bsketproduct get all results where basketFK == basketID

        $model = new BasketProductModel();

        // return as array
        return $model->getBasket($basket);

    }


    /**
     * @param Account $account
     * @return array|object|null
     *
     * get basket Associated with an account
     *
     */
    public function id(Account $account)
    {
        return $this
            ->where('accountFK', $account->accountID)
            ->where('purchased', false)
            ->first();
    }

    /**
     * @param Account $account
     * @return bool
     *
     * Check if account already has a pre-existing basket
     */
    public function exists(Account $account)
    {
        $data = $this
            ->select()
            ->where('accountFK', $account->accountID)
            ->where('purchased', false)
            ->countAllResults();

        return ($data === 1);
    }




    public function setPurchased(Account $account)
    {
        $basket = $this
            ->select()
            ->where('accountFK', $account->accountID)
            ->where('purchased', false)
            ->first();


        $data = ['purchased' => true];

        try {

            return $this->update($basket->basketID, $data); //todo fix

        } catch (\ReflectionException $e) {

            return $e;

        }

    }

    public function purchased(Basket $basket)
    {
        return $this
            ->select()
            ->where('basketID', $basket->basketID)
            ->where('purchased', true)
            ->first();
    }

}
