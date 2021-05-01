<?php namespace App\Controllers;

use App\Entities;

use App\Entities\Basket;
use CodeIgniter\Model;

class BasketModel extends Model
{

    protected $table = 'basket';
    protected $primaryKey = 'basketID';
    protected $returnType = 'App\Entities\Basket';
    protected $allowedFields = ['accountID', 'product', 'quantity']; //TODO MAYBE CHECK IF ADMIN AS WELL?
    protected $skipValidation = false;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';
    protected $useAutoIncrement = true;

}
