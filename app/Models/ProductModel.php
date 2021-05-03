<?php namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Product;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'productID';
    // protected $useSoftDeletes = true;
    //protected $returnType = 'array';
    protected $returnType = 'App\Entities\Product'; //TODO may be correct testing required
    protected $allowedFields = ['category', 'name', 'brand', 'description', 'price', 'image'];
//    protected $beforeInsert = ['hashPassword'];
//    protected $beforeUpdate = ['hashPassword'];

    public function exists(Product $data): bool
    {
        $data = $this
            ->select()
            ->where('productID', $data->productID) //TODO productID poss
            ->countAllResults();

        return ($data == 1);
    }

    public function getProductCategory(Product $data)
    {
        return $this
            ->asArray()
            ->select(['productID', 'category', 'name', 'brand', 'description', 'price', 'image'])
            ->where('category', $data->category)
            ->findAll();

    }

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

    public
    function getProductID(Product $data)
    {
            return $this
                ->select(['productID', 'category', 'name', 'brand', 'description', 'price', 'image'])
                ->where('productID', $data->productID)
                ->first();

    }

    public function getAllProducts()
    {
        return $this
            ->asArray()
            ->select(['productID', 'category', 'name', 'brand', 'description', 'price', 'image'])
            ->findAll();
    }


    public
    function getCategories()
    {
        return $this
            ->distinct(true)
            ->asArray()
            ->findColumn('category');
    }

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
