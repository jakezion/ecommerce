<?php helper('security'); //TODO check

encode_php_tags('scripts');
?>
<style>
    .site {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
        letter-spacing: 1px;
        font-family: 'Arvo', sans-serif;
        line-height: 25px;
        background: #FFFFFF;
    }

    .main {
        flex: 1;
    }

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $this->renderSection('title'); ?></title>
    <?php helper('requires'); ?>
    <link href="/assets/css/styles.css" type="text/css" rel="stylesheet">
    <!--meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="site">
<?= $this->include('template/header'); ?>

<?= $this->renderSection('features'); ?>
<main class="main">
    <div class="container">
        <div class="row">
            <?= $this->renderSection('content'); ?>
        </div>
    </div>
</main>
<?= $this->include('template/footer'); ?>
<?= $this->renderSection('scripts'); ?>
</body>
</html>
