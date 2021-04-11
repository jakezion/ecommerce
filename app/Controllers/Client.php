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
        if($this->session->authenticated){
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

                $data['validation'] = $this->validator;

                // return redirect()->back()->withInput();
            } else {
                // IF EXISTS

                if ($model->exists($client)) {

                    // IF LOGIN CLIENT
                    if ($model->match($client)) {
                        //GET DATABASE ENTITY


                        //SET CLIENT IN SESSION
                        $this->session->set('client', $client->accountID);
                        //$this->session->set('admin'$model->admin);

                        //SET AUTHENTICATED TO TRUE
                        $this->session->set('authenticated', true);
                        //REDIRECT TO DASHBOARD
                        return redirect()->to('/');

                        // ELSE LOGIN CLIENT
                    } else {
                        $data['validation'] = $this->validator;
//                         return redirect()
//                             ->to('/login')
//                             ->with( 'validation','The phone number or password entered is incorrect.')
//                             ->withInput();
                        //REDIRECT BACK
                    }
                    //ELSE EXISTS
                } else {
                    $data['validation'] = $this->validator;
                    // return redirect()->back()->withInput();
                    // REDIRECT BACK
                }

            }

        }

        // else if ($this->request->getMethod() == 'get') {        }


        return view('client/login', $data);
    }

    public function exists($phone, $password)
    {

        //$account = $model->where('phone', $phone)->first();
        // if ($account !== null) {
        //    if (password_verify($password, $account['password'])) {
        //       return $account;
        //    }
        // }
        //   return null;
    }

    public function logout()
    {

        if ($this->session->authenticated) {
            $this->session->destroy();
            return redirect()->to('/')->with('success', 'You have been logged out successfully.');
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
            // echo var_dump($data);
            // $this->session->set('authenticated', $_POST['phone']);
            // return redirect()->to('/');



            $rules = $model->getValidationRules();
            $messages = $model->getValidationMessages();

            if (!$this->validate($rules, $messages)) {
                $data['validation'] = $this->validator;
            } else {
                if (!$model->exists($client)) {
                    if($model->create($client)){
                        return redirect()
                            ->to('/login')
                            ->with('success','You have successfully registered an account.');

                    } else {
                        $data['validation'] = $this->validator;
                    }

                } else {
                    $data['validation'] = $this->validator;
                }
            }


            // if ($this->exists($_POST['phone'], $_POST['password']) !== null) {
            //     $this->session->set('authentication', $_POST['phone']);
            //    return redirect()->to('dashboard/dashboard');
            //  } else {
            // $this->session->setFlashData('phone',$this->session->get('authenticated');
            //      return redirect()->back();
            //   }


        }
        $data['title'] = ucfirst($page);
        return view('client/register', $data);


    }

}