<?php require APPROOT . '/views/includes/admin/header.php' ?>

<?php require APPROOT . '/views/includes/admin/navbar.php' ?>

<?php echo flash('product_message') ?>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-6">
            <p class="text-right">لیست کالای پزشکی</p>
        </div>
        <div class="col-md-6">
            <h4>
                <a href="<?php echo URLROOT;?>/admin/productAdd" class="btn btn-primary">
                    ایجاد کالا
                </a>
            </h4>
        </div>
    </div>
    <div class="table-responsive ">
        <table id="dataTableProduct" class="table cell-border text-center table-striped">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>نام</th>
                <th>کد محصول</th>
                <th>قیمت</th>
                <th>تخفیف</th>
                <th>موجودی انبار</th>
                <th>تاریخ ایجاد</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['products'] as $product) : ?>
                <tr>
                    <td><?php echo $product->id ?></td>
                    <td><?php echo $product->name ?></td>
                    <td><?php echo $product->code ?></td>
                    <td><?php echo number_format($product->price) ?></td>
                    <td><?php  echo $product->discount==1 ? "<span>✅</span>" :  "<span>✖️</span>"?></td>
                    <td><?php echo $product->amount ?></td>
                    <td><?php echo $product->created_at ?></td>
                    <td>
                        <a class="btn btn-primary mx-1 btn-sm" href="<?php echo URLROOT.'/admin/productEdit/'.$product->id ?>" >ویرایش</a>
                        <a class="btn btn-warning mx-1 btn-sm" href="<?php echo URLROOT.'/admin/productShow/'.$product->id ?>" >نمایش</a>
                        <a class="btn btn-danger mx-1 btn-sm" onclick="confirmDelete(<?php echo $product->id?>)" href="<?php echo URLROOT.'/admin/productDelete/'.$product->id ?>" >حذف</a>

                        <form id="delete-form-<?php echo $product->id?>"
                              action="<?php echo URLROOT.'/admin/productDelete/'.$product->id ?>"
                              method="post">
                        </form>

                    </td>

                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>
<?php require APPROOT . '/views/includes/admin/footer.php' ?>
