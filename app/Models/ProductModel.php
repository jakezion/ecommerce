<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Product;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'productID';
    protected $useSoftDeletes = true;
    //protected $returnType = 'array';
    protected $returnType = 'App\Entities\Product'; //TODO may be correct testing required
    protected $allowedFields = ['category', 'name', 'brand', 'description', 'price', 'image'];
//    protected $beforeInsert = ['hashPassword'];
//    protected $beforeUpdate = ['hashPassword'];

    public function exists(Product $data)
    {
        $row = $this
            ->where('id', $data->productID)
            ->countAllResults();

        return ($row == 1);


    }

    public function getProductCategory(Product $data)
    {
//        if ($data->category == 'all') {
//            return $this
//                ->select(['productID', 'category', 'name', 'brand', 'description', 'price', 'image'])
//                ->findAll();
//        } else {
        return $this
            ->asArray() //todo check
            ->select(['productID', 'category', 'name', 'brand', 'description', 'price', 'image'])
            ->where('category', $data->category)
            ->findAll();
//            }
    }

    public function getProductBrand(Product $data)
    {
        //todo get for current category only
        return $this
            ->select(['productID', 'category', 'name', 'brand', 'description', 'price', 'image'])
            ->where('brand', $data->brand)
            ->findAll();
    }

    public function getProductID(Product $data)
    {
        return $this
            ->where('id', $data->productID)
            ->first();
    }
}
