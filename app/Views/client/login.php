<?= $this->extend('layout'); ?>
<?= $this->section('title'); ?>
<?= esc($title); ?>
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-center">
    <div class="col-6 mt-5 px-5 login-main">
        <form action="/" method="post">
            <div class="mb-5">
                <h1 class="d-flex justify-content-center">Login</h1>
            </div>
            <div class="mb-3">
                <label for="phonenumber" class="form-label">Phone number</label>
                <input type="tel" class="form-control pt-2 pb-2" id="phonenumber" aria-describedby="phonehelp" value="<?= old('phone_number') ?? '' ?>" required>
                <!-- pattern="[0-9]{10}" -->
                <div id="phonehelp" class="form-text px-4">Enter the Phone Number associated with your account</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label ">Password</label>
                <input type="password" class="form-control pt-2 pb-2" id="password" required>
            </div>
            <div class="d-flex justify-content-center text-center">
                <div class="row">
                    <div class="col">
                    <div class="form-text mb-3">Forgot Password?</div>
                    <button type="submit" class="btn btn-dark mb-3">Sign in</button>
                    <div class="form-text mb-3"><a href="register">Register account</a>
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>


<style>
    .login-main{
        font-family: 'Arvo', sans-serif;
    }

    .login-main input{
        font-size: 22px;
    }
</style>
