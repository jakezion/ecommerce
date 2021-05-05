<?= $this->extend('layout');
helper('html'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>





<?= $this->section('content'); ?>


<div class="col-md-12 border-right">
    <div class="p-3 bg-white">
        <h3 class="heading1 text-center m-4">Shopping Basket</h3>


        <div class="table-hover table-responsive">
            <table class="table table-borderless">

                <thead>
                <th></th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>

                <th></th>

                </thead>

                <tbody>


                <?php foreach (@$products as $product): ?>

                    <tr class="border-top">
                        <td><img src="<?= $product['image'] ?>" height="180" width="180"
                                 alt="<?= $product['name'] ?>"></td>
                        <td><h5 class="text-start">   <?= $product['name']; ?></h5></td>
                        <td>   <?= $product['quantity']; ?></td>
                        <td>&pound;<?= number_format($product['price'], 2); ?></td>
                        <td>&pound;<?= number_format($product['price'] * $product['quantity'], 2); ?></td>

                        <td><i class="fa fa-ellipsis-v"></i></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="border-top">

                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>Total Price:</strong></td>
                    <td><kbd>&pound;<?= number_format($total, 2); ?></kbd></td>
                </tr>

                </tbody>
            </table>
        </div>
        <form action="/basket/purchase" method="post">
            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
            <button class="btn btn-dark form-control">Checkout</button>
        </form>
    </div>


    <?= $this->endSection(); ?>
