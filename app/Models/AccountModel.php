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


    /**
     * @param Account $account
     * @return array hash the password provided in the register form
     */
    protected function beforeInsert(Account $account)
    {
        return $this->hashPassword($account);
    }

    /**
     * @param Account $account
     * @return Account return the current account
     */
    protected function beforeUpdate(Account $account)
    {

        return $account;
    }


    /**
     * @param array $account
     * @return array hash a given password using the PASSWORD_BCRYPT algorithm
     */
    protected function hashPassword(array $account)
    {
        if (!isset($account['data']['password'])) return $account;

        $account['data']['password'] = password_hash($account['data']['password'], PASSWORD_BCRYPT);
        // unset($data['data']['password']);

        return $account;
    }


    /**
     * @param Account $account
     * @return bool match a given password with the hashed password in the database
     */
    public function match(Account $account): bool
    {

        //$this->hashPassword($data);

        $details = $this
            ->select('accountID, username, phone, email, password')
            ->where('phone', $account->phone)
            ->first();

        return password_verify($account->password, $details->password);

    }

    /**
     * @param Account $account
     * @return bool try to create an account
     */
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

    /**
     * @param Account $account
     * @return bool check if an account is an admin or not
     */
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

    /**
     * @param Account $account
     * @param bool $array
     * @return array|object|null find the details of an account based on a provided id
     */
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

    /**
     * @param Account $account
     * @return array|object|null get the account details by its phone number
     */
    public function phone(Account $account)
    {
            return $this
                ->select('accountID, username, phone, email')
                ->where('phone', $account->phone)
                ->first();

    }

    /**
     * @param Account $account
     * @return bool check if an account exists and return a boolean
     */
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

