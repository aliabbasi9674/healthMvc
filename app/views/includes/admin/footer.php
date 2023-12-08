
<!-- Footer -->
<script src="<?php echo URLROOT ?>/js/jquery-3.6.3.js"></script>
<script src="<?php echo URLROOT ?>/js/bootstrap.min.js"></script>
<script src="<?php echo URLROOT ?>/js/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        var TProduct = "";
        datatable_menu();

        function datatable_menu() {
            TProduct = $('#dataTableProduct').DataTable({
                "order": [4],
                "searching": true,
                "pageLength": 20, "bLengthChange" : false,
                language: {
                    "lengthMenu": "نمایش _MENU_ داده در هر صفحه",
                    "zeroRecords": "هیچ اطلاعاتی با این مشخصات یافت نشد!!!",
                    "info": "صفحه _PAGE_ از _PAGES_",
                    "infoEmpty": "داده‌ای موجود نیست!",
                    "search": "جستجو: ",
                    "paginate": {
                        "first": "اول",
                        "last": "آخر",
                        "next": "بعدی",
                        "previous": "قبلی"
                    },
                    "infoFiltered": "(نتیجه جستجو در بین اطلاعات _MAX_ اطلاعاتی)"
                }
            });
        }
    });

    function confirmDelete(id) {
        if (confirm('آیا آیتم مورد نظر حذف شود؟')) {
            event.preventDefault();
            document.getElementById('delete-form-' + id).submit();
        } else {
            event.preventDefault();
        }
    }
</script>
</body>
</html>
