<?php namespace App\Validation;

use App\Models\ClientModel;


class ClientRules
{

    public function validate_client(string $str, string $fields, array $data)
    {
        $model = new ClientModel();
        $client = $model->where('phone', $data['phone'])
            ->first();

        if (!$client) return false;

        return password_verify($data['password'], $client->password);
    }
}