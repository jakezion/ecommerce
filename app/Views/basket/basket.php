<?= $this->extend('layout');
helper('html'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>


<div class="row">
    <div class="col-md-12 border-right">
        <div class="p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="heading1">Recently Sold Items</h6>
                <div class="d-flex flex-row align-items-center text-muted"><span class=" days mr-2">Last 7 Days</span>
                    <i class="fa fa-angle-down"></i></div>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                    <th></th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th></th>
                    </thead>
                    <tbody>
                    <?php foreach (@$products as $product): ?>

                        <tr>


                            <td><img src="https://i.imgur.com/VMsimw4.jpg" width="35"></td>
                            <td>   <?= $product['productFK']; ?></td>
                            <td>   <?= $product['quantity']; ?></td>
                            <td> £<?= $product['price'] * $product['quantity']; ?></td>

                            <td><i class="fa fa-ellipsis-v"></i></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border-top p-3">
            <form action="/basket/purchase" method="post">

                <button class="btn btn-dark btn-block">
                  Checkout
                </button>
            </form>
        </div>
    </div>


    <?= $this->endSection(); ?>
