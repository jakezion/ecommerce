<?php namespace App\Controllers;

use App\Entities;
use App\Entities\Basket;
use App\Entities\BasketProduct;
use App\Entities\Product;
use App\Models\ProductModel;
use CodeIgniter\Model;

class BasketProductModel extends Model
{
    protected $table = 'basket_product';
    protected $primaryKey = 'id';

    protected $returnType = 'App\Entities\BasketProduct';
    protected $useSoftDeletes = true; //might be false if multiple baskets are used
    protected $allowedFields = ['basketFK', 'productFK', 'quantity', 'price'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    //todo validation rules for required and their formats

    public function addToBasket(Basket $basket, Product $product, int $quantity)
    {
        //get current price for product for
        $price = $this->currentPrice($product);

        $basketProduct = new BasketProduct([
            'basketFK' => $basket->basketID,
            'productFK' => $product->productID,
            'quantity' => $quantity,
            'price' => $price,
        ]);

        try {
            return $this->insert($basketProduct);
        } catch (\ReflectionException $e) {
            return false;
        }

    }

    public function currentPrice(Product $product)
    {

        $model = new ProductModel();

        $price = $model->find($product->productID);

        return $price->price;
    }

    //--------------------------
    public function exists()
    {

    }

    public function getBasket()
    {

    }

    public function updateBasket()
    {

    }

    public function purchased()
    {

    }

    public function deleteProduct()
    {

    }


}