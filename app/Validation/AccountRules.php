<?php namespace App\Validation;

use App\Models\AccountModel;


class AccountRules
{

    public function validate_client(string $str, string $fields, array $data)
    {
        $model = new AccountModel();
        $account = $model->where('phone', $data['phone'])
            ->first();

        if (!$account) return false;

        return password_verify($data['password'], $account->password);
    }
}