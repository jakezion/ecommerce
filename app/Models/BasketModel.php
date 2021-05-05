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
    protected $useAutoIncrement = true;


    /**
     * @param Account $account
     * @param Product $product
     * @param int $quantity
     * @return \CodeIgniter\Database\BaseResult|false|int|object|string add an item to the basket
     */
    public function add(Account $account, Product $product, int $quantity)
    {

        $basket = $this->basket($account);

        $model = new BasketProductModel();


        return $model->addToBasket($basket, $product, $quantity);

    }

    /**
     * @param Account $account
     * @return array|false|object|null create a new basket or return the current one
     */
    public function basket(Account $account)
    {


        //if account doesnt have basket

        if (!$this->exists($account)) {
            //create new basket

            $basket = new Basket(['accountFK' => $account->accountID]);


            //try to insert into database
            try {
                if ($this->insert($basket)) {
                    //return basket
                    return $this->id($account);

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
            return $this->id($account);

        }
    }

    /**
     * @param Account $account
     * @return array|false get all the products within a basket if it exists
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
     * @return array|object|null get basket Associated with an account
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
     * @return bool Check if account already has a pre-existing basket
     *
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


    /**
     * @param Account $account
     * @return bool|\Exception|ReflectionException set a basket to purchased
     */
    public function setPurchased(Account $account)
    {
        $basket = $this
            ->select()
            ->where('accountFK', $account->accountID)
            ->where('purchased', false)
            ->first();


        $data = ['purchased' => true];

        try {

            return $this->update($basket->basketID, $data);

        } catch (\ReflectionException $e) {

            return $e;

        }

    }

    /**
     * @param Basket $basket
     * @return array|object|null check if a basket is purchased
     */
    public function purchased(Basket $basket)
    {
        return $this
            ->select()
            ->where('basketID', $basket->basketID)
            ->where('purchased', true)
            ->first();
    }

}
