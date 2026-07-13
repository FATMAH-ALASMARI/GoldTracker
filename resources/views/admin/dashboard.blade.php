@extends('admin.layouts.app')

@section('content')

<div class="dashboard-page">

    {{-- بطاقات السوق --}}
    @include('admin.partials.dashboard-stats')

    {{-- بطاقات النظام --}}
    <div class="mt-4">
        @include('admin.partials.dashboard-cards')
    </div>

    {{-- الرسم البياني --}}
    <div class="row mt-4">

        <div class="col-12">
            @include('admin.partials.dashboard-chart')
        </div>

    </div>

    {{-- آخر المستخدمين --}}
    <div class="mt-4">
        @include('admin.partials.latest-users')
    </div>

</div>

@endsection