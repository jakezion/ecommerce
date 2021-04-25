<?php
namespace App\Entities;

use CodeIgniter\Entity;

class Product extends Entity{
    protected $productID;
    protected $category;
    protected $name;
    protected $brand;
    protected $description;
    protected $price;
    protected $image;
}