@extends('admin.layouts.app')

@section('content')

<div class="logs-premium-page">

    <div class="logs-page-header">

        <div>
            <span class="logs-badge">
                <i class="bi bi-activity"></i>
                ACTIVITY LOG
            </span>

            <h2 class="logs-title">
                <i class="bi bi-journal-text"></i>
                سجل العمليات
            </h2>

            <p class="logs-subtitle">
                متابعة جميع العمليات والتغييرات المسجلة في نظام GoldTracker
            </p>
        </div>

       <div class="logs-header-icon">
    <i class="fa-solid fa-clock-rotate-left"></i>
</div>
            <i class="bi bi-clock-history"></i>
        </div>

    </div>


    <div class="logs-card">

        <div class="logs-card-header">

            <div>
                <h5>
                    <i class="bi bi-list-check"></i>
                    أحدث العمليات
                </h5>

                <span>
                    إجمالي العمليات: {{ $logs->total() }}
                </span>
            </div>

        </div>


        <div class="table-responsive">

            <table class="table logs-table mb-0">

                <thead>

                    <tr>
                        <th>#</th>
                        <th>المستخدم</th>
                        <th>العملية</th>
                        <th>العيار</th>
                        <th>السعر</th>
                        <th>التاريخ</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($logs as $log)

                        <tr>

                            <td>
                                <span class="log-number">
                                    {{ $logs->firstItem() + $loop->index }}
                                </span>
                            </td>

                            <td>

                                <div class="log-user">

                                    <div class="log-avatar">
                                        {{ strtoupper(substr($log->user?->name ?? 'U', 0, 1)) }}
                                    </div>

                                    <span>
                                        {{ $log->user?->name ?? 'مستخدم محذوف' }}
                                    </span>

                                </div>

                            </td>

                            <td>

                                @if($log->action === 'إضافة سعر ذهب جديد')

                                    <a href="{{ route('gold.create') }}"
                                       class="log-action log-action-add">

                                        <i class="bi bi-plus-circle"></i>

                                        {{ $log->action }}

                                    </a>

                                @else

                                    <span class="log-action">

                                        <i class="bi bi-activity"></i>

                                        {{ $log->action }}

                                    </span>

                                @endif

                            </td>

                            <td>
                                <span class="log-karat">
                                    {{ $log->karat ?? '-' }}
                                </span>
                            </td>

                            <td>

                                @if($log->price > 0)

                                    <span class="log-price">
                                        {{ $log->price }} ريال
                                    </span>

                                @else

                                    <span class="log-empty">
                                        -
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="log-date">

                                    <i class="bi bi-calendar3"></i>

                                    {{ $log->created_at->format('Y-m-d') }}

                                    <small>
                                        {{ $log->created_at->format('H:i') }}
                                    </small>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="logs-empty">

                                <i class="bi bi-inbox"></i>

                                <p>
                                    لا توجد عمليات حتى الآن
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <div class="logs-pagination">

        {{ $logs->links() }}

    </div>

</div>

@endsection