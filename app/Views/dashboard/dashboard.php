<?= $this->extend('layout'); helper('html');?>

<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>



<style>
    .carousel {
        margin-bottom: 4rem;
    }
    /* Since positioning the image, we need to help out the caption */
    .carousel-caption {
        bottom: 3rem;
        z-index: 10;
    }

    /* Declare heights because of positioning of img element */
    .carousel-item {
        height: 32rem;
    }
    .carousel-item > img {
        position: absolute;
        top: 0;
        left: 0;
        min-width: 100%;
        height: 32rem;
    }

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>

<?= $this->section('features'); ?>

<?= $this->endSection(); ?>


<?= $this->section('content'); ?>

<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    let myCarousel = document.querySelector('#myCarousel');
    let carousel = new bootstrap.Carousel(myCarousel);
</script>
<?= $this->endSection(); ?>
