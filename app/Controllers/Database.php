<?php


namespace App\Controllers;
use App\Models\database\ClientModel;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;

class Database extends Controller {
    public function index()
    {
        $model = new ClientModel();

        $data = [
            'products' => $model->getProducts(),
            'title' => ucfirst('products')
        ];

        return view('dashboard/database',$data);
    }

    public function view($slug = null)
    {
        $model = new ClientModel();
        $data['product'] = $model->getProducts($slug);

        if (empty($data['product']))
        {
            throw new PageNotFoundException('Cannot find the news item: '. $slug);
        }

        $data['title'] = $data['product']['Name'];

        return view('dashboard/database',$data);

    }
}