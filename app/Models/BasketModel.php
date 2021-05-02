<?php namespace App\Controllers;

use App\Entities;

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
    protected $allowedFields = ['accountID', 'product', 'quantity']; //TODO MAYBE CHECK IF ADMIN AS WELL?
    protected $skipValidation = false;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $useAutoIncrement = true;


    public function add(Client $account, Product $product, int $quantity)
    {

        $basket = new Basket($this->basket($account));

        $model = new BasketProductModel();

        return $model->addToBasket($basket, $product, $quantity);

    }

    public function basket(Client $account)
    {

        if (!$this->exists($account)) {

                $basket = new Basket(['accountID' => $account->accountID]);

            try {
                if ($this->insert($basket)) {

                    return $this->id($account);

                } else {

                    return false;
                }
            } catch (ReflectionException $e) {
                return $e;
            }

        } else {

            return $this->id($account);

        }

    }

    public function id(Client $account)
    {
        return $this
            ->where('accountID', $account->accountID)
            ->first();
    }

    public function exists(Client $account)
    {
        $data = $this
            ->where('accountID', $account->accountID)
            ->countAllResults();

        return ($data === 1);
    }

}
