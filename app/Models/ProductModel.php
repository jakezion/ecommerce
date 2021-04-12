<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Product;
class ProductModel extends Model
{
    protected $table = 'laptops';
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Product';
    protected $allowedFields = ['category', 'name', 'brand', 'description', 'price', 'image'];
//    protected $beforeInsert = ['hashPassword'];
//    protected $beforeUpdate = ['hashPassword'];

    public function exists(Product $data)
    {

        $exists = $this
            ->select(['productID','category', 'name', 'brand', 'description', 'price', 'image'])
            ->where('category', $data->category)
            ->where('brand', $data->brand)
            ->findAll();

        if ($exists)
            return true;

        return false;
    }

    public function getProduct(Product $data)
    {

        //$this->hashPassword($data);

        $details = $this
            ->select('password')
            ->where('phone', $data->phone)
            ->first();

        return password_verify($data->password, $details->password);

    }

}
