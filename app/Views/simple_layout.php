
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $this->renderSection('title'); ?></title>
    <?php helper('requires'); ?>
</head>
<body>
<main>
    <div class="container">

        <div class="row">
            <?= $this->renderSection('content'); ?>
        </div>
    </div>
</main>
<?= $this->renderSection('scripts'); ?>
</body>
</html>
