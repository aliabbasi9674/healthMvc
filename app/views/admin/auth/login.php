<?php require APPROOT.'/views/includes/admin/header.php' ?>
<?php
$csrf_token = generateCSRFToken();
?>

<div class="container">
    <div class="row mt-5">

        <div class="col-md-7 mx-auto">

            <h5 class="text-center text-primary my-4">ورود به پنل مدیریت سایت</h5>
            <div class="card">
                <div class="card-body">
                    <?php flash('register_success') ?>
                    <form action="<?php echo URLROOT; ?>/admin/login" method="post">
                        <div class="form-group text-right">
                            <label for="email"> ایمیل <sup class="text-danger">*</sup> </label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"> <?php echo $data['email_error'] ?> </span>
                        </div>

                        <div class="form-group text-right">
                            <label for="password"> پسورد <sup class="text-danger">*</sup> </label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($data['pass_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"> <?php echo $data['pass_error'] ?> </span>
                        </div>
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">

                        <div class="text-center my-4">
                            <button class="btn btn-dark" type="submit"> ورود </button>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>
</div>
<?php require APPROOT.'/views/includes/admin/footer.php' ?>
