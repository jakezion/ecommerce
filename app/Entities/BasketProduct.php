<?php namespace App\Entities;

use CodeIgniter\Entity;

class BasketProduct extends Entity
{
    protected $id;
    protected $basketFK;
    protected $productFK;
    protected $quantity;
    protected $price;


}
