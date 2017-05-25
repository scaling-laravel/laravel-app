@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8">
                            Pageviews
                        </div>
                        <div class="col-md-4">
                            <form class="form">
                                <div class="form-group">
                                    <select id="timeline" name="timeline" class="form-control">
                                        @foreach(['week' => 'Last Week', 'month' => 'Last Month', 'quarter' => 'Last Quarter'] as $timeline => $label)
                                            <option value="{{ $timeline }}" @if(request()->timeline == $timeline) selected @endif>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="panel-body">

                    <canvas id="myChart"></canvas>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-js')
<script>
    $(function() {
        $('#timeline').change(function(e) {
            window.location = '/home?timeline='+$(this).val();
        });
    });

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: JSON.parse('{!! $pageviews->pluck('date') !!}'),
            datasets: [{
                label: 'Pageviews',
                data: JSON.parse('{!! $pageviews->pluck('daily_total') !!}'),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
@endsection