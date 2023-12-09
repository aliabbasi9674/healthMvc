<?php require APPROOT . '/views/includes/admin/header.php' ?>

<?php require APPROOT . '/views/includes/admin/navbar.php' ?>

<div class="container">
    <div class="row mt-5">

        <div class="col-md-7 mx-auto">

            <h5 class="text-center text-primary my-4">ویرایش کالای پزشکی <?php echo $data['name']; ?></h5>
            <div class="card">
                <div class="card-body">
                    <?php flash('product_success') ?>
                    <form action="<?php echo URLROOT; ?>/admin/productEdit/<?php echo $data['id'] ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group text-right">
                            <label for="name"> نام <sup class="text-danger">*</sup> </label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>">
                            <span class="invalid-feedback"> <?php echo $data['name_err'] ?> </span>
                        </div>

                        <div class="form-group text-right">
                            <label for="price"> قیمت<sup class="text-danger">*</sup> </label>
                            <input type="number" name="price" class="form-control <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['price']; ?>">
                            <span class="invalid-feedback"> <?php echo $data['price_err'] ?> </span>
                        </div>


                        <div class="form-group text-right">
                            <label for="image"> تصویر <sup class="text-danger">*</sup> </label>
                            <input type="file" class="form-control" name="image">
                            <span class="text-danger"> <?php echo $data['image_err'] ?> </span>
                        </div>
                        <div class="form-group text-right text-center">
                            <img src="<?php echo URLROOT; ?>/upload/image/<?php echo $data['image'] ?>"  alt="" style="width: 50%">
                        </div>
                        <div class="form-group text-right">
                            <label for="discount"> تخفیف  </label>
                            <input name="discount" type="checkbox" <?php echo $data['discount']==1 ? "checked" : "" ?>>
                        </div>
                        <div class="form-group text-right">
                            <label for="amount"> موجودی انبار  </label>
                            <input type="number" name="amount" class="form-control <?php echo (!empty($data['amount_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['amount']; ?>">
                            <span class="invalid-feedback"> <?php echo $data['amount_err'] ?> </span>
                        </div>


                        <div class="text-center my-4">
                            <button class="btn btn-info" type="submit"> ویرایش اطلاعات </button>
                            <a class="btn btn-dark" href="<?php echo URLROOT; ?>/admin/products"> بازگشت</a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>
<?php require APPROOT . '/views/includes/admin/footer.php' ?>
