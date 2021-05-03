<?php namespace App\Controllers;

use App\Entities;
use App\Models\ClientModel;


class Client extends BaseController
{

    public function login()
    {

        if (!$this->request->isSecure()) {
            force_https();
        }

        $data = [
            'title' => ucfirst('login')
        ];


        if ($this->session->authenticated) {
            return redirect()->to('/logout');
        }

        //checks to see if login request is a get or post method
        if ($this->request->getMethod() == 'post') {

            $details = $this->request->getPost();

            $client = new Entities\Client($details);

            $model = new ClientModel();

            // $rules = $this->validation->getRuleGroup('login'); //TODO set up in model and get proper one

            $model->setValidationRules($this->validation->getRuleGroup('login'));

            $rules = $model->getValidationRules();
            //$rules = $validation->getValidationRules(['only' => ['phone', 'password']]);
            //$messages = $model->getValidationMessages();

            if (!$this->validate($rules)) {

                return redirect()
                    ->back()
                    ->with('error', $this->validator->listErrors())
                    ->withInput();


            } else {

                if ($model->exists($client)) {

                    if ($model->match($client)) {

                        $account = $model->phone($client);

                        $this->session->set('accountID', $account->accountID);

                        $this->session->set('authenticated', true);

                        //TODO fix this IMPORTANT
//                        if ($model->isAdmin($client)) $this->session->set('admin', true);

                        return redirect()->to('/');

                    } else {

                        return redirect()
                            ->back()
                            ->with('error', 'The phone number or password entered is incorrect.')
                            ->withInput();

                    }
                } else {

                    return redirect()
                        ->back()
                        ->with('error', 'The phone number entered is not registered to an account.')
                        ->withInput();

                }
            }
        }

        return view('client/login', $data);
    }


    public function register($page = 'register')
    {
        if (!$this->request->isSecure()) {
            force_https();
        }

        $data = [
            'title' => ucfirst($page),
        ];

        if ($this->request->getMethod() == 'post') {

            $details = $this->request->getPost();

            $client = new Entities\Client($details);

            $model = new ClientModel();


            $model->setValidationRules($this->validation->getRuleGroup('register'));

            $rules = $model->getValidationRules();

            if (!$this->validate($rules)) {
                return redirect()
                    ->back()
                    ->with('error', $this->validator->listErrors());

            } else {
                if (!$model->exists($client)) {
                    if ($model->create($client)) {
                        return redirect()
                            ->to('/login')
                            ->with('success', 'You have successfully registered an account.')
                            ->withInput();

                    } else {
                        return redirect()
                            ->back()
                            ->with('error', 'Account could not be registered.');

                    }

                } else {
                    return redirect()
                        ->back()
                        ->with('error', 'The phone number entered is already registered to an account.');

                }
            }

        }

        return view('client/register', $data);


    }

    public function logout()
    {

        if ($this->session->authenticated) {
            $this->session->destroy();
            return redirect()
                ->to('/login')
                ->with('success', 'You have been logged out successfully.'); //TODO Fix to display properly
        } else {
            return redirect()
                ->to('/login')
                ->with('error', 'You must be logged in to sign out.');
        }
    }

//TODO make profile for letting client view their previous purchases and possibly their details
    public function profile()
    {

    }

}