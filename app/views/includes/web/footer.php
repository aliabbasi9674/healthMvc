<footer class="bg-footer page-footer font-small blue">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="/"> health</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
<script src="<?php echo URLROOT ?>/js/jquery-3.6.3.js"></script>
<script src="<?php echo URLROOT ?>/js/datatables.min.js"></script>
<script src="<?php echo URLROOT ?>/js/bootstrap.min.js"></script>
<script src="<?php echo URLROOT ?>/js/sweetalert.js"></script>
<script src="<?php echo URLROOT ?>/js/script.js"></script>
<script>
    function sort() {
        var select = document.getElementById("selectSort").value;
        $.ajax({
            url: '<?php echo  URLROOT; ?>/products/sort',
            type: 'GET',
            data: { sort: select },
            success: function(data) {
                // به‌روزرسانی بخش نمایش محصولات با داده‌های جدید
                $("#products-container").html(data);
            }
        });
    }
</script>
</body>
</html>
