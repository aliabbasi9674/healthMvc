<?php require APPROOT.'/views/includes/admin/header.php' ?>


<div class="container">
    <div class="row mt-5">

        <div class="col-md-7 mx-auto">

            <div class="card">

                <div class="card-body">

                    <form class="needs-validation" novalidate action="<?php echo URLROOT; ?>/admin/register" method="post">

                        <div class="form-group text-right">
                            <label for="name"> نام <sup>*</sup> </label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($data['name_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                            <div class="invalid-feedback"> <?php echo $data['name_error'] ?> </div>
                        </div>
                        <div class="form-group text-right">
                            <label for="phone"> شماره همراه <sup>*</sup> </label>
                            <input type="tel" name="phone" class="form-control <?php echo (!empty($data['phone_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['phone']; ?>">
                            <div class="invalid-feedback"> <?php echo $data['phone_error'] ?> </div>
                        </div>

                        <div class="form-group text-right">
                            <label for="email"> ایمیل <sup>*</sup> </label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                            <span class="invalid-feedback"> <?php echo $data['email_error'] ?> </span>
                        </div>

                        <div class="form-group text-right">
                            <label for="password"> پسورد <sup>*</sup> </label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($data['pass_error'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"> <?php echo $data['pass_error'] ?> </span>
                        </div>

                        <div class="text-center my-4">
                            <button class="btn btn-dark" type="submit"> عضویت </button>
                        </div>

                        <div class="text-center my-4">
                            <p>
                                عضو هستید؟‌
                                <a href="<?php echo URLROOT; ?>/admin/login" class="text-muted"> وارد شوید </a>
                            </p>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>

<?php require APPROOT.'/views/includes/admin/footer.php' ?>
