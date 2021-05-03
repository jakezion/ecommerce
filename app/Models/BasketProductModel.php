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

    protected $returnType = 'App\Entities\BasketProduct';
    protected $useSoftDeletes = true; //might be false if multiple baskets are used
    protected $allowedFields = ['basketFK', 'productFK', 'quantity', 'price'];

//    protected $useTimestamps = true;
//    protected $createdField = 'created_at';
//    protected $updatedField = 'updated_at';
//    protected $deletedField = 'deleted_at';

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

//        if ($this->exists($product)) {
//            return $this->updateBasket($product);
//        } else {
        try {
            return $this->insert($basketProduct);
        } catch (\ReflectionException $e) {
            return false;
        }
        //  }

    }

    public function currentPrice(Product $product)
    {

        $model = new ProductModel();

        $price = $model->find($product->productID);

        return $price->price;
    }

    //--------------------------
    public function exists(Product $product)
    {
        $data = $this
            ->select()
            ->where('productFK', $product->productID)
            ->countAllResults();

        return ($data == 1);
    }

    public function getBasket()
    {

    }

    public function updateBasket(Product $product)
    {
//        return $this
//            ->update('quantity')
//            ->where('productFK', $product->productID)
//        return $this->update($product);
    }

    public function purchased()
    {
//todo soft delete the rows in basket_product and update the basket to purchased, then when checking if basket exists if the basket that exists is purchased, make a new product
    }

    public function deleteProduct()
    {

    }


}