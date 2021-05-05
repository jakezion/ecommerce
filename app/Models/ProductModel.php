<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Product;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'productID';

    protected $returnType = 'App\Entities\Product';
    protected $allowedFields = ['category', 'name', 'brand', 'description', 'price', 'image'];


    /**
     * @param Product $data
     * @return bool check if a product exists by its id
     */
    public function exists(Product $data): bool
    {
        $data = $this
            ->select()
            ->where('productID', $data->productID)
            ->countAllResults();

        return ($data == 1);
    }

    /**
     * @param Product $data
     * @return array get all products in a  category
     */
    public function getProductCategory(Product $data)
    {
        return $this
            ->asArray()
            ->select(['productID', 'category', 'name', 'brand', 'description', 'price', 'image'])
            ->where('category', $data->category)
            ->findAll();

    }

    /**
     * @param Product $data
     * @return array get all products of a brands for a category
     */
    public
    function getProductBrand(Product $data)
    {

        return $this
            ->asArray()
            ->select(['productID', 'category', 'name', 'brand', 'description', 'price', 'image'])
            ->where('category', $data->category)
            ->where('brand', $data->brand)
            ->findAll();
    }

    /**
     * @param Product $data
     * @return array|object|null get the id of a product
     */
    public
    function getProductID(Product $data)
    {
        return $this
            ->select(['productID', 'category', 'name', 'brand', 'description', 'price', 'image'])
            ->where('productID', $data->productID)
            ->first();

    }

    /**
     * @return array get all products in the database
     */
    public function getAllProducts()
    {
        return $this
            ->asArray()
            ->select(['productID', 'category', 'name', 'brand', 'description', 'price', 'image'])
            ->findAll();
    }


    /**
     * @return array|null get all existing categories
     */
    public
    function getCategories()
    {
        return $this
            ->distinct(true)
            ->asArray()
            ->findColumn('category');
    }

    /**
     * @param $category
     * @return array|null get all existing brand by its category
     */
    public
    function getBrands($category)
    {
        return $this
            ->distinct(true)
            ->asArray()
            ->where('category', $category)
            ->findColumn('brand');
    }


}
