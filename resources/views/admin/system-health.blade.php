@extends('admin.layouts.app')

@section('content')

<div class="container system-health-page">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0">
            ❤️ صحة النظام
        </h2>

        <form
            action="{{ route('admin.system-health.update') }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="btn btn-warning px-4 py-2 fw-bold"
            >
                <i class="fa-solid fa-arrows-rotate me-1"></i>

                تحديث الأسعار الآن
            </button>

        </form>

    </div>


    <div class="row g-4">

        <div class="col-md-3">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>
                        <i class="fa-solid fa-cloud text-success"></i>
                        GoldAPI
                    </h5>

                    <h3 class="text-success">
                        متصل
                    </h3>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>
                        <i class="fa-solid fa-chart-line text-warning"></i>
                        الأسعار الحالية
                    </h5>

                    <h3>
                        {{ $totalPrices }}
                    </h3>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>
                        <i class="fa-solid fa-clock-rotate-left text-info"></i>
                        السجل التاريخي
                    </h5>

                    <h3>
                        {{ $historyCount }}
                    </h3>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>
                        <i class="fa-regular fa-clock text-warning"></i>
                        آخر تحديث
                    </h5>

                    @if($lastUpdate)

                        <span>
                            {{ $lastUpdate->fetched_at }}
                        </span>

                    @else

                        <span class="text-muted">
                            لا يوجد
                        </span>

                    @endif

                </div>

            </div>

        </div>

    </div>


    @if($lastActivity)

        <div class="card shadow mt-4">

            <div class="card-body">

                <h5>
                    <i class="fa-solid fa-list-check text-warning"></i>
                    آخر عملية
                </h5>

                <hr>

                <strong>
                    {{ $lastActivity->action }}
                </strong>

                <br>

                <small class="text-muted">
                    {{ $lastActivity->created_at }}
                </small>

            </div>

        </div>

    @endif

</div>

@endsection