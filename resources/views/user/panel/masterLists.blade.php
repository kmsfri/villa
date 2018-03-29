@extends('user.panel.master')
@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('user.panel.common.alerts')
                <input class="form-control" type="text" id="myInput" onkeyup="search()" placeholder="جستجو در عنوان مطالب">
                <div class="table-responsive">
                    <table class="table table-bordered table-vila" id="myTable">
                        @yield('tableBody')
                    </table>
                </div>
                @yield('pagination')
            </div>
        </div>
    </div>
@endsection
@section('mapscript')
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

@endsection