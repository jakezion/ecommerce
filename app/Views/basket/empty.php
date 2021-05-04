<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <div class="card mt-4">
        <div class="card-body">
            <h3 class="text-center">Shopping Basket</h3>
            <hr/>
            <br>
            <p class="card-text text-center">Your Shopping Basket is empty</p>
            <br>
        </div>
    </div>
<?= $this->endSection(); ?>