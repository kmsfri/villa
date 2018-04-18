@extends('user.panel.master')
@section('main')


    <div class="row">
        <div class="col-sm-6">
            <canvas id="VillaChart"></canvas>
        </div>
        <div class="col-sm-6">
            <canvas id="ContentChart"></canvas>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>آمار بازدید ویلاها بر اساس کد ویلا
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-vila" style="text-align: center;">
                                    <tr>
                                        <th scope="col">کد ویلا</th>
                                        <th scope="col">تعداد بازدید کل</th>
                                    </tr>
                                    @foreach($villa_visit_table as $vvt => $value)
                                        <tr>
                                            <td>{{$vvt}}</td>
                                            <td>{{count($value)}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i>آمار بازدید مطالب بر اساس کد مطلب
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-vila" style="text-align: center;">
                                    <tr>
                                        <th scope="col">کد مطلب</th>
                                        <th scope="col">تعداد بازدید کل</th>
                                    </tr>
                                    @foreach($content_visit_table as $cvt => $value)
                                        <tr>
                                            <td>{{$cvt}}</td>
                                            <td>{{count($value)}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>






@endsection
@section('mapscript')

    <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js'></script>
    <script >var ctx = document.getElementById('VillaChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['امروز','24 ساعت گذشته','یک هفته','یک ماه'],
                datasets: [{
                    label: 'بازدید',
                    data: [
                        {{$vtoday}} , {{$vlast24}} , {{$vweek}} , {{$vmonth}}
                    ],
                    backgroundColor: "rgba(153,255,51,0.6)"
                }]
            }
        });
        //# sourceURL=pen.js
    </script>
    <script >var ctx = document.getElementById('ContentChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['امروز','24 ساعت گذشته','یک هفته','یک ماه'],
                datasets: [{
                    label: 'بازدید مطالب',
                    data: [
                        {{$ctoday}} , {{$clast24}} , {{$cweek}} , {{$cmonth}}
                    ],
                    backgroundColor: "rgba(153,255,51,0.6)"
                }]
            }
        });
        //# sourceURL=pen.js
    </script>

@endsection