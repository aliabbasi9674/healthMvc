<?php require APPROOT . '/views/includes/web/header.php' ?>

<?php require APPROOT . '/views/includes/web/navbar.php' ?>

<section>
    <div class="container my-5" style="height: 100vh">
       <div class="bg-light p-5">
           <h1 class="text-center text-success my-4">  ✅ با تشکر</h1>
           <?php flash('order_message') ?>
          <h6 class="text-center mt-5"> <a href="<?php echo URLROOT  ?>" >بازگشت به صفحه ی اصلی</a></h6>
       </div>
    </div>
</section>
