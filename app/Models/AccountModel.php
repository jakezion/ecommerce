<?php namespace App\Models;

use App\Entities\Account;
use CodeIgniter\Model;

class AccountModel extends Model
{
    protected $table = 'account';
    protected $primaryKey = 'accountID';
    protected $returnType = 'App\Entities\Account';
    protected $allowedFields = ['username', 'phone', 'email', 'password']; //TODO MAYBE CHECK IF ADMIN AS WELL?
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];
    protected $skipValidation = false;

    //todo  if register setrValidationRules, setValidationMessages

    protected function beforeInsert(Account $data)
    {
        return $this->hashPassword($data);
    }

    protected function beforeUpdate(Account $data)
    {

        return $data;
    }


    protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) return $data;

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_BCRYPT);
        // unset($data['data']['password']);

        return $data;
    }


    public function match(Account $data): bool
    {

        //$this->hashPassword($data);

        $details = $this
            ->select('accountID, username, phone, email, password')
            ->where('phone', $data->phone)
            ->first();

        return password_verify($data->password, $details->password);

    }

    public function create(Account $data): bool
    {

        try {
            $this->save($data);
            return true;
        } catch (\ReflectionException $e) {
            log_message('err', $e);
        }

        return false;
    }

    public function isAdmin(Account $data)
    {
        $val = $this
            ->select()
            ->where('phone', $data->phone)
            ->select('admin', '1')
            ->countAllResults();

        if ($val == 1) {
            return true;
        }
        return false;

    }

    public function id(Account $data, bool $array = false)
    {
        if (!$array) {
            return $this
                ->select('accountID, username, phone, email')
                ->where('accountID', $data->accountID)
                ->first();
        } else {
            return $this
                ->asArray()
                ->select('accountID, username, phone, email')
                ->where('accountID', $data->accountID)
                ->first();
        }

    }

    public function phone(Account $data)
    {
            return $this
                ->select('accountID, username, phone, email')
                ->where('phone', $data->phone)
                ->first();

    }

    public function exists(Account $data): bool
    {

        $exists = $this
            ->select('accountID,username,email,phone')
            ->where('phone', $data->phone)
            ->first();

        if ($exists)
            return true;

        return false;
    }

}

