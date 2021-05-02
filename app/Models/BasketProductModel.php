<?php namespace App\Controllers;

use App\Entities;

use App\Entities\Basket;
use App\Entities\Product;
use CodeIgniter\Model;

class BasketProductModel extends Model
{
    protected $table = 'basket_product';
    protected $primaryKey = 'id';

    protected $returnType = 'App\Entities\BasketProduct';
    protected $useSoftDeletes = true; //might be false if multiple baskets are used
    protected $allowedFields = [ 'basketFK','productFK','quantity','price'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    //todo validation rules for required and their formats

    public function addToBasket(){

    }

    public function exists(){

    }

    public function getBasket(){

    }

    public function updateBasket(){

    }

    public function purchased(){

    }

    public function deleteProduct(){

    }





}