@extends('user.panel.masterLists')
@section('tableBody')
    <thead>
    <tr>
        <th scope="col">کدملک</th>
        <th class="width" scope="col">عنوان آگهی</th>
        <th scope="col">نرخ اجاره بها</th>
        <th scope="col">بروزرسانی</th>
        <th scope="col">ویــژه</th>
        <th scope="col">بروزرسانی</th>
        <th scope="col">درخواست</th>
        <th scope="col">آمار</th>
        <th scope="col">وضعیت</th>
        <th scope="col">ویرایش</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="row">
            <input class="form-control" type="text">
        </th>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
        <td>
            <input class="form-control" type="text">
        </td>
    </tr>
    @foreach($villas as $villa)
    <tr>
        <th class="number" scope="row">{{$villa->id}}</th>
        <td>
            <p class="text">{{$villa->villa_title}}</p>
        </td>
        <td>
            <input class="form-control rate" type="text" placeholder="{{$villa->rent_daily_price_from}} تومان">
        </td>
        <td><a class="update" href="" title="بروزرسانی">بروزرسانی</a></td>
        <td><a class="special" href="">ویژه کن</a></td>
        <td><p class="text-update">بروز نشده</p></td>
        <td><span class="request">39</span></td>
        <td><img class="img" onclick="show_visit({{$villa->id}});" src="{{asset('images/icon097.png')}}"></td>
        <td>
            <p class="situation {{($villa->villa_status==1)?'active':''}}">{{($villa->villa_status==1)?'تایید شده':'تایید نشده'}}</p>
        </td>
        <td><a href="{{Route('editVillaForm',$villa->id)}}"><img class="img2" src="{{asset('images/icon098.png')}}"></a></td>
    </tr>
    @endforeach
    </tbody>
    <div class="modal fade" id="visitmodal" tabindex="-1" role="dialog" aria-labelledby="reportmodallabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="rpform">
                    <input type="hidden" value="{{csrf_token()}}" class="rptoken">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">آمار بازدید</h5>
                        <span aria-hidden="true" id="close_first_modal" style="cursor:pointer;">×</span>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-12">
                                <canvas id="VisitChart"></canvas>
                            </div>
                            </div>
                        </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@section('pagination')
    <div class="pagination pull-left">{!! str_replace('/?', '?', $villas->render()) !!}</div>
@endsection
@section('mapscript')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js'></script>

    <script>
        function show_visit(id) {
            $.ajax({
                type: "GET",
                cache: false,
                url: '{{url('VillaVisits')}}'+'/'+id,
                dataType : 'text',
                success: function(data)
                {
                    if (data == "error"){
                        alert('مشکلی در دریافت اطلاعات به وجود آمد.');
                        return false;
                    }
                    var visits = $.parseJSON(data);
                    var ctx = document.getElementById('VisitChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ['امروز','24 ساعت گذشته','یک هفته','یک ماه'],
                            datasets: [{
                                label: 'بازدید',
                                data: [
                                    visits['today'],
                                    visits['last24'],
                                    visits['week'],
                                    visits['month'],
                                ],
                                backgroundColor: "rgba(153,255,51,0.6)"
                            }]
                        }
                    });
                    $("#visitmodal").modal()

                },
                error : function(data)
                {
                    alert('مشکلی در دریافت اطلاعات به وجود آمد.');
                }
            });
        }
    </script>
@endsection