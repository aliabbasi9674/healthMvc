<?php require APPROOT . '/views/includes/admin/header.php' ?>

<?php require APPROOT . '/views/includes/admin/navbar.php' ?>

<div class="container">
    <div class="row mt-5">

        <div class="col-md-7 mx-auto">

            <h5 class="text-center text-primary my-4">نمایش کالای پزشکی</h5>
            <div class="card">
                <div class="card-body">
                    <div class="form-group text-right">
                        <label for="name"> نام <sup class="text-danger">*</sup> </label>
                        <input type="text" name="name" disabled class="form-control "
                               value="<?php echo $data['product']->name; ?>">
                    </div>

                    <div class="form-group text-right">
                        <label for="price"> قیمت<sup class="text-danger">*</sup> </label>
                        <input type="number" disabled name="price" class="form-control "
                               value="<?php echo $data['product']->price; ?>">
                    </div>


                    <div class="form-group text-right text-center">
                        <img src="<?php echo URLROOT; ?>/upload/image/<?php echo $data['product']->image ?>" alt=""
                             style="width: 50%">
                    </div>
                    <div class="form-group text-right">
                        <label for="discount"> تخفیف </label>
                        <input name="discount" <?php echo $data['product']->discount == 1 ? "checked" : "" ?>
                               type="checkbox">
                    </div>
                    <div class="form-group text-right">
                        <label for="amount"> موجودی انبار  </label>
                        <input type="number" name="amount"
                               class="form-control <?php echo (!empty($data['amount_err'])) ? 'is-invalid' : ''; ?>"
                               value="<?php echo $data['product']->amount; ?>">
                        <span class="invalid-feedback"> <?php echo $data['amount_err']; ?> </span>
                    </div>

                    <div class="text-center my-4">
                        <a class="btn btn-dark" href="<?php echo URLROOT; ?>/admin/products"> بازگشت</a>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
<?php require APPROOT . '/views/includes/admin/footer.php' ?>
