<?php helper('security'); //TODO check

encode_php_tags('scripts');
?>
<style>
    .site {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
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
</head>
<body class="site">
<?= $this->include('template/header'); ?>
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
