@extends('admin.layouts.app')

@section('content')

<div class="dashboard-page">

    {{-- Dashboard Hero --}}
    <section class="admin-dashboard-hero">
        <div class="admin-dashboard-hero-content">

            <span class="admin-dashboard-badge">
                <i class="bi bi-circle-fill"></i>
                LIVE DASHBOARD
            </span>

            <h1>
                لوحة تحكم GoldTracker
            </h1>

            <p>
                راقب أسعار الذهب وإحصائيات النظام وإدارة المنصة من مكان واحد.
            </p>

        </div>

        <div class="admin-dashboard-hero-status">
            <i class="bi bi-activity"></i>

            <div>
                <span>حالة النظام</span>
                <strong>يعمل بشكل طبيعي</strong>
            </div>
        </div>
    </section>

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