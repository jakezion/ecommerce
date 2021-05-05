<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <div class="card mt-4">
        <div class="card-body">
            <h3 class="text-center">Order Confirmed</h3>
            <hr/>
            <br>
            <p class="card-text text-center">Your order has been confirmed!</p>
            <br>
        </div>
    </div>
<?= $this->endSection(); ?>