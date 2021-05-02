<?php namespace App\Controllers;

use App\Entities;

use App\Entities\Basket;
use App\Entities\Product;
use CodeIgniter\Model;

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

        $basket = $this->basket($account);

        $model = new BasketProductModel();

        return $model->createProduct($basket, $product, $quantity);

    }

    public function basket(Client $account)
    {
        // 1. Check if user has cart already.
        // a. If not, create one and pass back.
        // b. If yes, pass back.
        // 2. Return the cart.
        if (!$this->cartExists($account)) {
            // The client does not have a cart.
            try {
                // Create a new cart row for the client.
                $cart = new Cart([
                    'client_id' => $account->id
                ]);
                if ($this->insert($cart)) {
                    // Return the cart to the caller.
                    return $this->readCartByClientID($account);
                } else {
                    return false;
                }
            } catch (\ReflectionException $e) {

                return false;
            }
        } else {
            // The cart already exists so return to caller.

            return $this->readCartByClientID($account);
        }
    }

    public function exists(Entities\Client $account){

    }

}
