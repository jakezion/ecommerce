<?php namespace App\Controllers;

use App\Entities;
use App\Models\ClientModel;

class Client extends BaseController
{


    public function login()
    {
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

            $rules = $model->getValidationRules(['only' => ['phone', 'password']]);
            $messages = $model->getValidationMessages();

            if (!$this->validate($rules, $messages)) {

                return redirect()
                    ->back()
                    ->with('error', $this->validator->listErrors())
                    ->withInput();


            } else {
                // IF EXISTS

                if ($model->exists($client)) {

                    // IF LOGIN CLIENT
                    if ($model->match($client)) {
                        //GET DATABASE ENTITY


                        //SET CLIENT IN SESSION
                        $this->session->set('client', $client->accountID); //TODO fix

                        //$this->session->set('admin'$model->admin);

                        //SET AUTHENTICATED TO TRUE
                        $this->session->set('authenticated', true);
                        //REDIRECT TO DASHBOARD
                        return redirect()->to('/');

                        // ELSE LOGIN CLIENT
                    } else {
                        // $data['validation'] = $this->validator;
                        return redirect()
                            ->back()
                            ->with('error', 'The phone number or password entered is incorrect.')
                            ->withInput();
                        //REDIRECT BACK
                    }
                    //ELSE EXISTS
                } else {
                    // $data['validation'] = $this->validator;
                    return redirect()
                        ->back()
                        ->with('error', 'The phone number entered is not registered to an account.')
                        ->withInput();
                    // return redirect()->back()->withInput();
                    // REDIRECT BACK
                }

            }

        }

        return view('client/login', $data);
    }

    public function logout()
    {

        if ($this->session->authenticated) {
            $this->session->destroy();
            return redirect()->to('/')->with('success', 'You have been logged out successfully.'); //TODO Fix to display properly
        } else {
            return redirect()->to('/login')->with('error', 'You must be logged in to sign out.');
        }
    }

    public function register($page = 'register')
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $details = $this->request->getPost();

            $client = new Entities\Client($details);
            $model = new ClientModel();

            $rules = $model->getValidationRules();
            //$rules = $model->getRuleGroup('signup'); //TODO fix
            $messages = $model->getValidationMessages();

            if (!$this->validate($rules, $messages)) {
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
        $data['title'] = ucfirst($page);
        return view('client/register', $data);


    }

}