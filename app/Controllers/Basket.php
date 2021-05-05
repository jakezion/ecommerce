<?php namespace App\Controllers;

use App\Entities\Product;
use App\Entities\Account;

use App\Models\BasketModel;
use App\Models\AccountModel;
use App\Models\ProductModel;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;


class Basket extends BaseController
{
    use ResponseTrait;

    /**
     * @param int $productID
     * @param int $quantity
     * @return mixed add a product to the basket
     */
    public function add(int $productID, int $quantity = 1)
    {
        if ($quantity < 1) return $this->failValidationError('Product Quantity Invalid.', 404);


        $check = $this->check($productID, true);


        if ($check instanceof Response) {

            return $this->failValidationError('Product not added through ajax', 404);

        } else {
            $account = $check["account"];
            $product = $check["product"];
        }


        $basket = new BasketModel();

        // $add = $basket->add($account, $product, $quantity);

//        return $this->respondCreated($add);

        if ($basket->add($account, $product, $quantity)) {

            return $this->respondCreated([
                'status' => 200,
                'code' => 200,
                'message' => [
                    'success' => 'Product has been added successfully to basket.'
                ]
            ]);


        } else {

            return $this->failValidationError('Product could not be added to the shopping basket', 404);

        }


    }


    /**
     *
     */
    public function remove()
    {

    }

    /**
     *
     */
    public function update()
    {

    }

    /**
     *
     */
    public function delete()
    {

    }

    /**
     * @param int|null $productID
     * @param bool $requireAccount
     * @return array|RedirectResponse|mixed check if a user is signed in and that a product exists
     */
    private function check(int $productID = null, bool $requireAccount = true)
    {
        $data = [];
        //if product exists


        //check if account is authenticated otherwise redirect to login as they need to be signed in
        if (!$this->session->authenticated) {
            return redirect()->to('/login')->with('error', 'No account is signed in. Please sign in to continue.');
            // return $this->failUnauthorized('No account is signed in. Action cannot be completed ');
        }
        //check if user account exists


        if ($requireAccount) {

            $model = new AccountModel();

            $details = $model->id(new Account(['accountID' => $this->session->accountID]), true);

            $account = new Account($details);

            $data['account'] = $account;

        }


        if (isset($productID)) {

            $model = new ProductModel();

            $product = new Product(['productID' => $productID]);

            if (!$model->find($product->productID))
                return $this->failNotFound('Product doesnt exist in database', 404);

            $data['product'] = $product;

        }


        return $data;


        //see if ajax call or http request
    }


    /**
     * @return \CodeIgniter\HTTP\RedirectResponse|mixed|string purchase a basket
     */
    public function purchase()
    {
        $data = [
            'title' => 'Confirmed'
        ];

        if (!$this->session->authenticated)
            return redirect()->to('/login')->with('error', 'An account must be logged in to purchase a basket.');

        $accountModel = new AccountModel();

        $details = $accountModel->id(new Account(['accountID' => $this->session->accountID]), true);

        $account = new Account($details);

        $model = new BasketModel();

        $basket = $model->setPurchased($account);


        if (empty($basket))
            return $this->failNotFound('Basket has no items');

        return view('basket/confirm', $data);

    }


    /**
     * @return \CodeIgniter\HTTP\RedirectResponse|string get the contents of the current users basket
     */
    public function getBasket()
    {


        if (!$this->session->authenticated)
            return redirect()
                ->to('/login')
                ->with('error', 'A valid account must be used to access your basket.');
        //$this->failUnauthorized('User must be logged in to access their basket');

        //get the current account in the session
        $accountModel = new AccountModel();

        $details = $accountModel->id(new Account(['accountID' => $this->session->accountID]), true);

        $account = new Account($details);


        // Get the basket items for the current account in the session.
        $model = new BasketModel();

        //get contents of basket_product database for current id
        $basket = $model->getProducts($account);


        // If the cart has no products return a 404 and empty message.
        if (empty($basket))
            //return $this->failNotFound('Basket has no items');
            return redirect()
                ->to('basket/empty')
                ->with('error', 'Basket has no items.');


        $total = 0;
        foreach ($basket as $product) {
            $subtotal = $product['price'] * $product['quantity'];
            $total += $subtotal;
        }

        $data = [
            'title' => 'Basket',
            'products' => $basket,
            'total' => $total
        ];

        return view('basket/basket', $data);

    }

    /**
     * @return string return an empty basket
     */
    public function empty()
    {
        $data = [
            'title' => 'Empty Basket'

        ];
        return view('basket/empty', $data);
    }

}