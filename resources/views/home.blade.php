@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-3">
                            Pageviews
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="timeline">Timeline</label>
                                <select id="timeline" name="timeline" class="form-control">
                                    @foreach(['7' => 'Last Week', '30' => 'Last Month', '90' => 'Last Quarter',] as $timeline => $label)
                                        <option value="{{ $timeline }}" @if(request()->timeline == $timeline) selected @endif>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="domain">Domain</label>
                                <select id="domain" name="domain" class="form-control">
                                    <option value="">None</option>
                                    @foreach($domains->pluck('domain') as $domain)
                                        <option value="{{ $domain }}" @if(request()->domain == $domain) selected @endif>{{ $domain }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="customer">Customer</label>
                                <select id="customer" name="customer" class="form-control">
                                    <option value="">None</option>
                                    @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" @if(request()->customer == $customer->id) selected @endif>{{ $customer->id }}</option>
                                    @endforeach
                                </select>
                            </div>
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
        var filter = function(e)
        {
            var timeline = $('#timeline').val();
            var domain = $('#domain').val();
            var customer = $('#customer').val();

            window.location = '/home?timeline='+timeline+'&domain='+encodeURI(domain)+'&customer='+customer;
        }

        $('select').change(filter);
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