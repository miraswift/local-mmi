<?= $this->extend('Layout/Template_Auth') ?>
<?= $this->section('content') ?>
<?= $this->extend('Layout/Template_Auth') ?>
<?= $this->section('content') ?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-teal rounded-0">
        <div class="card-header text-center">
            <a href="<?= base_url() ?>" class="h1"><b>MMI</b>Report</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Log In</p>

            <form action="/login/validate" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control <?= (validation_show_error('email_user')) ? 'is-invalid' : '' ?>" name="email_user" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <!-- Validation Error Msg -->
                    <div id="email_user_error" class="invalid-feedback">
                        <?= validation_show_error('email_user') ?>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control <?= (validation_show_error('password_user')) ? 'is-invalid' : '' ?>" name="password_user" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    <!-- Validation Error Msg -->
                    <div id="password_user_error" class="invalid-feedback">
                        <?= validation_show_error('password_user') ?>
                    </div>
                </div>
                <hr>
                <div class="col-12">
                    <button type="submit" class="btn bg-teal btn-block rounded-pill">Sign In</button>
                </div>
            </form>


            <!-- <p class="mb-1 mt-2">
                <a href="forgot-password.html" class="btn btn-outline-primary btn-block btn-flat">Lupa Password</a>
            </p> -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
<?= $this->endSection() ?>
<?= $this->endSection() ?>