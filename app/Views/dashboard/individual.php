<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
    <h2><?= esc($product['title']) ?></h2>
    <p><?= esc($product['body']) ?></p>
<?= $this->endSection(); ?>