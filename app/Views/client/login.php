<?= $this->extend('layout'); ?>
<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>
<?= $this->section('content');
$session = Config\Services::session(); ?>

<div class="d-flex justify-content-center">
    <div class="col-6 mt-5 px-5 login-main">
        <form action="/login" method="post">
            <div class="mb-2">
                <h1 class="d-flex justify-content-center">Login</h1>
            </div>
            <?php if ($session->has('success')): ?>
                <div class="mb-2">
                    <div class="alert alert-success" role="alert">
                        <?= $session->getFlashdata('success'); ?>

                    </div>
                </div>
            <?php elseif ($session->has('error')): ?>
                <div class="mb-2">
                    <div class="alert alert-danger" role="alert">
                        <?= $session->getFlashdata('error'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone number</label>
                <div class="input-group">
                    <span class="input-group-text">+44</span>
                    <input type="tel" class="form-control pt-2 pb-2" name="phone" id="phone"
                           aria-describedby="phonehelp" value="<?= old('phone') ?? '' ?>" required>
                    <!-- pattern="[0-9]{10}" -->
                </div>
                <div id="phonehelp" class="form-text px-4">Enter the Phone Number associated with your account</div>

            </div>
            <div class="mb-3">
                <label for="password" class="form-label ">Password</label>
                <input type="password" class="form-control pt-2 pb-2" name="password" id="password" required>
            </div>
            <div class="d-flex justify-content-center text-center">
                <div class="row">
                    <div class="col">
                        <div class="form-text mb-3">Forgot Password?</div>
                        <button type="submit" class="btn btn-dark mb-3">Sign in</button>
                        <div class="form-text mb-3"><a href="/register">Register account</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>


<style>
    .login-main {
        font-family: 'Arvo', sans-serif;
    }

    .login-main input {
        font-size: 22px;
    }
</style>
