<?php require APPROOT . '/views/includes/admin/header.php' ?>

<?php require APPROOT . '/views/includes/admin/navbar.php' ?>



<div class="container">
    <div class="row mt-5">
        <div class="col-md-6">
            <p class="text-right">لیست سفارشات پزشکی</p>
        </div>
    </div>
    <div class="table-responsive ">
        <table id="dataTableProduct" class="table cell-border text-center table-striped">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>شماره همراه</th>
                <th>کد محصول</th>
                <th>مبلغ سفارش</th>
                <th>تاریخ ایجاد</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['orders'] as $order) : ?>
                <tr>
                    <td><?php echo $order->id ?></td>
                    <td><?php echo $order->phone ?></td>
                    <td><?php echo $order->code ?></td>
                    <td><?php echo number_format($order->price) ?></td>
                    <td><?php echo $order->created_at ?></td>

                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
    </div>
</div>
<?php require APPROOT . '/views/includes/admin/footer.php' ?>
