<?php

namespace App\Models;

use App\Entities\Client;
use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = 'account';
    protected $primaryKey = 'accountID';
    protected $returnType = 'App\Entities\Client';
    protected $allowedFields = ['username', 'phone', 'email', 'password']; //TODO MAYBE CHECK IF ADMIN AS WELL?
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];
    protected $skipValidation = false;
    protected $validationRules = [
        'username' => 'required|max_length[255]',
        'email' => 'required|valid_email|max_length[255]',
        'phone' => 'required|exact_length[10]|numeric',
        'password' => 'required|min_length[4]',
//        'password_confirm' => 'matches[password]'
        //|is_unique[account.phone]'|validate_user[phone,password]
    ];
    protected $validationMessages = [
        'username' => [
            'required' => 'A username must be entered.',
            'max_length' => 'The username must be entered cannot be longer than 255 characters.'
        ],
        'email' => [
            'required' => 'An email must be entered.',
            'valid_email' => 'The email entered must be a valid email address.',
            'max_length' => 'The email entered cannot be longer than 255 characters.'
        ],
        'phone' => [
            'required' => 'A phone number must be entered.',
            'exact_length' => 'The phone number entered must be exactly 10 digits.',
            'numeric' => 'The phone number entered can only contain numbers.',
        ],
        'password' => [
            'required' => 'A password must be entered.',
            'min_length' => 'The password entered must be at least 4 characters.',
//            'validate_user' => 'The phone number or password is incorrect.'

        ],
//        'password_confirm' => [
//            'required' => 'A password must be entered.',
//            'min_length' => 'The password entered must be at least 8 characters.'
//        ]
    ];

    protected function beforeInsert(Client $data)
    {
        return $this->hashPassword($data);
    }

    protected function beforeUpdate(Client $data)
    {

        return $data;
    }


    protected function hashPassword(array $data)
    {
        if (! isset($data['data']['password'])) return $data;

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
       // unset($data['data']['password']);

        return $data;
    }

    /*
    protected function hashPassword(Client $data)
    {
        if (!isset($data->password)) return $data;

        $data->password = password_hash($data->password, PASSWORD_BCRYPT);

        return $data;
    }
*/

    public function match(Client $data): bool
    {

        //$this->hashPassword($data);

        $details = $this
            ->select('password')
            ->where('phone', $data->phone)
            ->first();

        return password_verify($data->password, $details->password);

    }

    public function create(Client $data): bool
    {

        try {
            $this->save($data);
            return true;
        } catch (\ReflectionException $e) {
            echo $e;
        }

        return false;
    }

    public function exists(Client $data): bool
    {

        //echo $data->password;
        //echo $data->phone;
        $exists = $this
            ->select('accountID,username,email,phone')
            ->where('phone', $data->phone)
            ->first();

        if ($exists)
            return true;

        return false;
    }

    public function getPhone(Client $data)
    {

    }
}

