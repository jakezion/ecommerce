<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container py-5 ">
    <div class="card mb-3 p-2">
        <div class="row g-0">
            <div class="col-md-4">
                <a href="/inv/<?= $product->productID; ?>">
                    <img class="card-img-top" src="<?= $product->image; ?>" alt="<?= $product->name; ?>">
                </a>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title text-center"><strong><?= $product->name; ?></strong></h3>
                    <hr/>
                    <h5 class="card-subtitle">
                        <strong>Brand</strong>:
                        <?= ucfirst($product->brand); ?>
                    </h5>
                    <br/>
                    <h5 class="card-subtitle">
                        <strong>Price</strong>:&nbsp;&nbsp;<kbd>&pound;<?= $product->price; ?></kbd></h5>
                    <br/>
                    <h5 class="card-subtitle"><strong>Description:</strong></h5>

                    <ul class="card-text">
                        <?php foreach (@explode("-", $product->description) as $description) : ?>
                            <?php if ($description !== '' || empty($description)): ?>
                                <li><?= $description; ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                    <hr/>
                    <?php if (session()->get('authenticated')): ?>

                        <div class="row">
                            <div class="col-md-4">
                                <!-- todo update max to the stock limit value -->
                                <label for="quantity">
                                </label><input type="number" id="quantity" class="form-control"
                                               min="1" max="20" value="1">
                            </div>

                            <div class="col-md-8">
                                <button class="form-control btn btn-dark" type="submit"
                                        id="basketButton<?= $product->productID; ?>"
                                        onclick="addToBasket(<?= $product->productID; ?>);">Add To Cart
                                </button>
                            </div>
                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>



<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
    function addToBasket(productID) {
        let quantity = parseInt($('#quantity').val());


        if (Number.isInteger(quantity)) {

            $.getJSON('/basket/add/' + productID + '/' + quantity, function (data) {
                console.log("data", data);
            })
                .done(function (data) {
                    $("#basketButton" + productID).removeClass('btn-dark').addClass('btn-secondary').html("<i class=\"bi bi-basket3-fill\"> Added");
                    setTimeout(function () {
                        $("#basketButton" + productID).removeClass('btn-secondary').addClass('btn-dark').html("<i class=\"bi bi-basket3\"> Add to Basket");
                    }, 1000);
                })
                .fail(function (e) {
                    console.log('Product wasn\'t added to your basket.\nerror occurred.');
                    console.log('error', e);
                });

        } else {
            alert("Please only use a number!");
        }
    }

</script>
<?= $this->endSection(); ?>
