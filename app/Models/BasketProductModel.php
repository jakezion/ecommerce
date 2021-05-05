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


    /**
     * @param Basket $basket
     * @param Product $product
     * @param int $quantity
     * @return \CodeIgniter\Database\BaseResult|\Exception|object|\ReflectionException|bool|int|string
     * add a product to their current basket
     */
    public function addToBasket(Basket $basket, Product $product, int $quantity)
    {

        $price = $this->currentPrice($product);

        $basketProduct = new BasketProduct([
            'basketFK' => $basket->basketID,
            'productFK' => $product->productID,
            'quantity' => $quantity,
            'price' => $price,
        ]);

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

    /**
     * @param Product $product
     * @return mixed get the current price for an item
     */
    public function currentPrice(Product $product)
    {

        $model = new ProductModel();

        $price = $model->find($product->productID);

        return $price->price;
    }


    /**
     * @param Basket $basket
     * @param Product $product
     * @return array|object|null check if an items already exists within a basket
     */
    public function exists(Basket $basket, Product $product)
    {

        return $this
            ->select()
            ->where('basketFK', $basket->basketID)
            ->where('productFK', $product->productID)
            ->find();
    }

    /**
     * @param Basket $basket
     * @return array get the contents of a basket and join with the corresponding product table
     */
    public function getBasket(Basket $basket)
    {
        return $this
            ->asArray()
            ->select()
            ->where('basketFK', $basket->basketID)
            ->join('product', 'basket_product.productFK = product.productID')
            ->findAll();
    }

    /**
     * @return array get every basket
     */
    public function getAllBaskets()
    {
        return $this
            ->asArray()
            ->select()
            ->join('product', 'basket_product.productFK = product.productID')
            ->findAll();
    }

    /**
     * @param BasketProduct $basketProduct
     * @return array|object|null get the product in a basket
     */
    public function getBasketProduct(BasketProduct $basketProduct)
    {
        return $this
            ->select()
            ->where('basketFK', $basketProduct->basketFK)
            ->where('productFK', $basketProduct->productFK)
            ->first();

    }

    /**
     * @param BasketProduct $basketProduct
     * @param int $quantity
     * @param $price
     * @return bool|\Exception|\ReflectionException update a products price and quantity
     */
    public function updateProduct(BasketProduct $basketProduct, int $quantity, $price)
    {
        $bp = $this->getBasketProduct($basketProduct);


        $data = [
            'quantity' => $bp->quantity += $quantity,
            'price' => $bp->price = $price
        ];

        try {
            return $this->update($bp->id, $data);
        } catch (\ReflectionException $e) {
            return $e;
        }
    }


    /**
     *
     */
    public function deleteProduct()
    {

    }


}