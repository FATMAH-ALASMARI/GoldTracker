@extends('admin.layouts.app')

@section('content')

<div class="dashboard-page">

    @include('admin.partials.dashboard-stats')

    <div class="row g-4 mt-2">

        <div class="col-lg-8">
            @include('admin.partials.dashboard-chart')
        </div>

    </div>

</div>

@endsection