<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{

    protected $table = 'laptops';
    protected $allowedFields = [
        'name', 'brand', 'description', 'price'
    ];
    protected $returnType = 'App\Entities\Product';
    protected $useTimestamps = true;


}
