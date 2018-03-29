<?php $__env->startSection('main'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php echo $__env->make('user.panel.common.alerts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <input class="form-control" type="text" id="myInput" onkeyup="search()" placeholder="جستجو در عنوان مطالب">
                <div class="table-responsive">
                    <table class="table table-bordered table-vila" id="myTable">
                        <?php echo $__env->yieldContent('tableBody'); ?>
                    </table>
                </div>
                <?php echo $__env->yieldContent('pagination'); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mapscript'); ?>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
        function confirmaction() {
            var r = confirm("آیا از انجام این عملیات مطمئن هستید؟");
            if (r == true) {
                return true;
            } else {
                event.preventDefault();
                return false;
            }

        }
    </script>

    <script>
        function search() {
            // Declare variables
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.panel.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>