<?php helper('security');encode_php_tags('scripts'); ?>
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
<html lang="en" prefix="og: https://localhost/">
<head>
    <title><?= $this->renderSection('title'); ?></title>
    <?php helper('requires'); ?>
    <link href="/assets/css/styles.css" type="text/css" rel="stylesheet">

    <!--meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:site_name" content="AWTechnology"/>
    <meta property="og:title" content="<?= $this->renderSection('title'); ?>"/>
    <meta name="language" content="EN">
    <meta name="author" content="Jake Sumner">
    <meta property="og:locale" content="en_GB"/>
    <meta property="og:url" content="https://localhost/<?= base_url(); ?>"/>
    <link href="/awt.ico" rel="shortcut icon" type="image/ico" />
</head>

<!-- view partial creates a template for every page that includes it within its view
repeated data can be placed into their relevant sections/ included and keeps formatting
between pages identical -->
<body class="site">
<?= $this->include('template/login_header'); ?>
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
