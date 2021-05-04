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


    protected function beforeInsert(Account $account)
    {
        return $this->hashPassword($account); //todo check
    }

    protected function beforeUpdate(Account $account)
    {

        return $account;
    }


    protected function hashPassword(array $account)
    {
        if (!isset($account['data']['password'])) return $account;

        $account['data']['password'] = password_hash($account['data']['password'], PASSWORD_BCRYPT);
        // unset($data['data']['password']);

        return $account;
    }


    public function match(Account $account): bool
    {

        //$this->hashPassword($data);

        $details = $this
            ->select('accountID, username, phone, email, password')
            ->where('phone', $account->phone)
            ->first();

        return password_verify($account->password, $details->password);

    }

    public function create(Account $account): bool
    {

        try {
            $this->save($account);
            return true;
        } catch (\ReflectionException $e) {
            log_message('err', $e);
        }

        return false;
    }

    public function isAdmin(Account $account)
    {
        $val = $this
            ->select()
            ->where('accountID', $account->accountID)
            ->where('admin', true)
            ->countAllResults();

        if ($val == 1) {
            return true;
        }
        return false;

    }

    public function id(Account $account, bool $array = false)
    {
        if (!$array) {
            return $this
                ->select('accountID, username, phone, email')
                ->where('accountID', $account->accountID)
                ->first();
        } else {
            return $this
                ->asArray()
                ->select('accountID, username, phone, email')
                ->where('accountID', $account->accountID)
                ->first();
        }

    }

    public function phone(Account $account)
    {
            return $this
                ->select('accountID, username, phone, email')
                ->where('phone', $account->phone)
                ->first();

    }

    public function exists(Account $account): bool
    {

        $exists = $this
            ->select('accountID,username,email,phone')
            ->where('phone', $account->phone)
            ->first();

        if ($exists)
            return true;

        return false;
    }

}

