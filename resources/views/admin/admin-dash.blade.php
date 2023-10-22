@extends('layouts.admin')

@section('page-title')
    {{ __('Dashboard') }}
@endsection
@section('content')
    <div class="main-container" style="overflow: auto">
        <br>Aktivni korisnici (poslednjih 5 minuta): {{ $active ?? 0}}<br><br>
        Danas prijavljeni radnici: {{ $workers ?? 0 }}<br>
        Radnici prijavljeni u poslednjih 30 dana: {{ $workers_last_30_days ?? 0 }}<br>
        Najviše poseta radnika: {{ $max_visit->worker->name ?? 'null'}} klikovi: {{ $max_visit->hits ?? 0 }}<br><br>
        Ukupna poseta danas: {{ $overall_visit_today ?? 0 }}<br>
        Ukupne posete u poslednjih 30 dana: {{ $overall_visit_last_30_days ?? 0 }}<br><br>
        Danas prijavljeni nalozi sa različitim IP adresama: {{ $diff_ip ?? 0}}<br>
        Različiti IP u poslednjih 30 dana: {{ $diff_ip_last_30_days ?? 0 }}<br><br>
        @php
            $totalSumBrowser = $browserType->firefox + $browserType->chrome + $browserType->opera + $browserType->safari + $browserType->ie + $browserType->edge + $browserType->unknown;
            $totalSumDevice = $deviceType->desktop + $deviceType->mobile + $deviceType->tablet + $deviceType->bot + $deviceType->unknown;
        @endphp
        @if ($totalSumBrowser + $totalSumDevice)
            <div class="container">
                @if($totalSumBrowser)
                <div id="pie-chart-browser" style="width: 900px; height: 500px"></div>
                @endif
                @if($totalSumDevice)
                <div id="pie-chart-device" style="width: 900px; height: 500px"></div>
                @endif
            </div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(drawChart);
        
                function drawChart() {
                    @if($totalSumBrowser)
                    var data = google.visualization.arrayToDataTable([
                        ['Browser', 'Count'],    
                        ['Chrome', {{ $browserType->chrome }}],
                        ['Firefox', {{ $browserType->firefox }}],
                        ['Opera', {{ $browserType->opera }}],
                        ['Safari', {{ $browserType->safari }}],
                        ['Internet Explorer', {{ $browserType->ie }}],
                        ['Microsoft Edge', {{ $browserType->edge }}],
                        ['Nepoznat', {{ $browserType->unknown }}],
                    ]);
        
                    var options = {
                        title: 'Detalji pretraživača danas (radnici) - Ukupan broj pretraživača: {{ $totalSumBrowser }}',
                        is3D: true,
                    };
        
                    var chart = new google.visualization.PieChart(document.getElementById('pie-chart-browser'));
        
                    chart.draw(data, options);
                    @endif
                    @if($totalSumDevice)
                    var data_device = google.visualization.arrayToDataTable([
                        ['Device', 'Count'],    
                        ['Desktop', {{ $deviceType->desktop }}],
                        ['Mobile', {{ $deviceType->mobile }}],
                        ['Tablet', {{ $deviceType->tablet }}],
                        ['Bot', {{ $deviceType->bot }}],
                        ['Nepoznat', {{ $deviceType->unknown }}],
                    ]);
        
                    var options_device = {
                        title: 'Detalji uređaja danas (radnici) - Ukupan broj uređaja: {{ $totalSumDevice }}',
                        is3D: true,
                    };

                    var chart_device = new google.visualization.PieChart(document.getElementById('pie-chart-device'));

                    chart_device.draw(data_device, options_device);
                    @endif
                }
        
            </script>
        @endif

    </div>
@endsection


