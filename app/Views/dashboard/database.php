<?= $this->extend('layout'); ?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<?= highlight_string("<?php\n" . var_export($products, true) . ";\n?>"); ?>
<?= $this->endSection(); ?>