<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="container py-5">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-10 mx-auto">
            <div class="card shadow-sm">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="card-body">
                            <?php if ($product->picture): ?>
                                <a href="/catalog/<?= $product->accountID; ?>">
                                    <img class="card-img-top"
                                         src="/images/<?= $product->picture; ?>"
                                         alt="Product Image">
                                </a>
                            <?php else: ?>
                                <a href="/catalog/<?= $product->accountID; ?>">
                                    <img class="card-img-top"
                                         data-src="holder.js/300x300?auto=yes&text=<?= $product->name; ?>"
                                         alt="<?= $product->name; ?>">
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="card-body">
                            <h3 class="card-title"><strong><?= $product->name; ?></strong></h3>
                            <hr/>
                            <h5 class="card-subtitle">
                                <strong>Brand</strong>:
                                <?= $product->brand ?>
                            </h5>
                            <br/>
                            <h5 class="card-subtitle">
                                <strong>Price</strong>:&nbsp;&nbsp;<kbd>&pound;<?= $product->price; ?></kbd></h5>
                            <br/>
                            <h5 class="card-subtitle"><strong>Description:</strong></h5>

                            <ul class="card-text">
                                <?php foreach (@explode("-", $product->description) as $description) : ?>
                                    <?php if ($description !== ''): ?>
                                        <li><?= $description; ?></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>

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
    </div>
</div>

<?= $this->endSection(); ?>



<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>
    function addToBasket(productID) {
        let quantity = parseInt($('#quantity').val());


        if (Number.isInteger(quantity)) {

            $.getJSON("/basket/add/" + productID + "/" + quantity, function (data) {
                console.log("data",data);
            })
            .done(function (data){
                //         $("#addButton-" + productID).html("Added").prop("disabled", true);
                //         setTimeout(function () {
                //             $("#addButton-" + productID).html("<i class=\"fas fa-cart-plus\"></i> Add").prop("disabled", false);
                //         }, 1000);
            })
            .fail(function(e){
                console.log('Product wasn\'t added to your basket.\nerror occurred.');
                console.log('error',e);
            });

        } else {
            alert("Please only use a number!");
        }
    }

</script>
<?= $this->endSection(); ?>
