<?php

namespace App\Models\database;

use CodeIgniter\Model;

class DatabaseModel extends Model{
    protected $table = 'laptops';

    public function getProducts($slug = false){
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['slug' => $slug])
            ->first();
    }
}

