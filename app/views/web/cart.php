<?php require APPROOT . '/views/includes/web/header.php' ?>

<?php require APPROOT . '/views/includes/web/navbar.php' ?>

<div class="container" style="height: 100vh">


    <main role="main">
        <div class="row my-5">
            <div class="col-md-6">
                <p class="text-right">خرید شما</p>
            </div>
        </div>
        <?php flash('order_message') ?>
        <?php if (isset($data['product'])) : ?>
            <div class="table-responsive ">
                <table class="table cell-border text-center table-striped">
                    <thead>
                    <tr>
                        <th>نام</th>
                        <th>کد محصول</th>
                        <th>قیمت</th>
                        <th>تخفیف</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $data['product']->name ?></td>
                        <td><?php echo $data['product']->code ?></td>
                        <td><?php echo price($data['product']) ?> تومان</td>
                        <td><?php echo $data['product']->discount == 1 ? "<span>✅</span>" : "<span>✖️</span>" ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <hr>
            <h5 class="text-center font-weight-bold mt-5">برای خرید اطلاعات زیر را پر کنید </h5>
            <form method="post" action="<?php echo URLROOT; ?>/orders/store">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group text-right">
                                <label for="phone"> شماره همراه <sup class="text-danger">*</sup> </label>
                            <input type="tel" name="phone"
                                   class="form-control <?php echo (!empty($data['phone_error'])) ? 'is-invalid' : ''; ?>">
                            <div class="invalid-feedback"> <?php echo $data['phone_error'] ?> </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group text-right">
                            <label for="code"> کد محصول <sup class="text-danger">*</sup> </label>
                            <input type="code" name="code"
                                   class="form-control <?php echo (!empty($data['code_error'])) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"> <?php echo $data['code_error'] ?> </span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="product_id" value="<?php echo $data['product']->id ?>">
                <div class="text-center my-4">
                    <a class="btn btn-dark" href="<?php echo URLROOT; ?>"> بازگشت</a>
                    <button type="submit" class="btn btn-success" href=""> خرید کالا ها</button>
                </div>
            </form>
        <?php else: ?>
            <div class="my-5">
                <h4 class="text-danger font-weight-bold text-center">سبد خرید شما خالی هست </h4>
                <div class="text-center">
                    <a class="btn btn-dark" href="<?php echo URLROOT; ?>"> بازگشت</a>
                </div>
            </div>
        <?php endif; ?>


    </main>
</div>
<?php require APPROOT . '/views/includes/web/footer.php' ?>
