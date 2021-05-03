<?php namespace App\Models;

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
    protected $useTimestamps = false;
    protected $returnType = 'App\Entities\BasketProduct';
    protected $useSoftDeletes = false; //might be false if multiple baskets are used
    protected $allowedFields = ['basketFK', 'productFK', 'quantity', 'price'];

//    protected $useTimestamps = true;
//    protected $createdField = 'created_at';
//    protected $updatedField = 'updated_at';
//    protected $deletedField = 'deleted_at';

    //todo validation rules for required and their formats

    public function addToBasket(Basket $basket, Product $product, int $quantity)
    {

        $price = $this->currentPrice($product);

        $basketProduct = new BasketProduct([
            'basketFK' => $basket->basketID,
            'productFK' => $product->productID,
            'quantity' => $quantity,
            'price' => $price,
        ]);

//todo handle if basket is purchsased then use the non purchased account basket as long as only 1 non purchased one exists
        if ($this->exists($basket, $product)) {

            return $this->updateProduct($basketProduct, $quantity, $price);

        } else {

            // get current price for product for

            try {

                return $this->insert($basketProduct);

            } catch (\ReflectionException $e) {

                return false;

            }
        }

    }

    public function currentPrice(Product $product)
    {

        $model = new ProductModel();

        $price = $model->find($product->productID);

        return $price->price;
    }

    //--------------------------
    public function exists(Basket $basket, Product $product)
    {

        return $this
            ->select()
            ->where('basketFK', $basket->basketID)
            ->where('productFK', $product->productID)
            ->find();
    }

    public function getBasket(Basket $basket)
    {
        return $this
            ->asArray()
            ->select()
            ->where('basketFK', $basket->basketID)
            ->findAll();
    }

    public function getBasketProduct(BasketProduct $basketProduct)
    {
        return $this
            ->select()
            ->where('basketFK', $basketProduct->basketFK)
            ->where('productFK', $basketProduct->productFK)
            ->first();

    }

    public function updateProduct(BasketProduct $basketProduct, int $quantity, $price)
    {
        $bp = $this->getBasketProduct($basketProduct);

//todo +=   quantity is wtong

        $data = [
            'quantity' => $bp->quantity += $quantity,
            'price' => $bp->price = $price //todo do this price update on a timer every 30mins
        ];

        try {
            return $this->update($bp->id, $data);
        } catch (\ReflectionException $e) {
            return $e;
        }
    }

    public function purchased()
    {
//todo soft delete the rows in basket_product and update the basket to purchased, then when checking if basket exists if the basket that exists is purchased, make a new product
    }

    public function deleteProduct()
    {

    }


}