<?php namespace App\Controllers;

use App\Models\AccountModel;
use CodeIgniter\API\ResponseTrait;


class API
{
    use ResponseTrait;

    public function RESTful(int $orderID = null)
    {
if ($this->session->authenticated){
    $model = new AccountModel();

    $account = $model->id($orderID);
    $admin = $model->isAdmin($account);

}
    }
}