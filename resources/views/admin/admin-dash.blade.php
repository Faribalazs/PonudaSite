@extends('layouts.admin')

@section('page-title')
    {{ __('Dashboard') }}
@endsection
@section('content')
    <div class="main-container" style="overflow: auto">
        <br>Active users (last 5 minutes): {{ $active }}<br><br>
        Today logged in workers: {{ $workers }}<br>
        Workers logged in last 30 days: {{ $workers_last_30_days }}<br>
        The most visits from worker: {{ $max_visit->worker_id }} hits: {{ $max_visit->hits }}<br><br>
        Overall visits today: {{ $overall_visit_today }}<br>
        Overall visits the last 30 days: {{ $overall_visit_last_30_days }}<br><br>
        Today logged in with different ip addresses: {{ $diff_ip }}<br>
        Last 30 day distinct ip: {{ $diff_ip_last_30_days }}<br><br>

    </div>
@endsection


