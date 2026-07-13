<div class="row g-4">

    <div class="col-lg-3 col-md-6">
        <div class="card dashboard-card users-card h-100 border-0 shadow-sm">
            <div class="card-body text-center">

                <div class="card-icon bg-primary-subtle text-primary">
                    <i class="bi bi-people-fill"></i>
                </div>

                <h2 class="mt-4 fw-bold">{{ $users }}</h2>

                <p class="text-muted mb-0">
                    عدد المستخدمين
                </p>

            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card dashboard-card prices-card h-100 border-0 shadow-sm">
            <div class="card-body text-center">

                <div class="card-icon bg-success-subtle text-success">
                    <i class="bi bi-cash-stack"></i>
                </div>

                <h2 class="mt-4 fw-bold">{{ $prices }}</h2>

                <p class="text-muted mb-0">
                    أسعار الذهب
                </p>

            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card dashboard-card logs-card h-100 border-0 shadow-sm">
            <div class="card-body text-center">

                <div class="card-icon bg-warning-subtle text-warning">
                    <i class="bi bi-clock-history"></i>
                </div>

                <h2 class="mt-4 fw-bold">{{ $logs }}</h2>

                <p class="text-muted mb-0">
                    العمليات
                </p>

            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card dashboard-card avg-card h-100 border-0 shadow-sm">
            <div class="card-body text-center">

                <div class="card-icon bg-danger-subtle text-danger">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>

                <h2 class="mt-4 fw-bold">
                    {{ number_format(\App\Models\GoldPrice::avg('price'), 2) }}
                </h2>

                <p class="text-muted mb-0">
                    متوسط السعر
                </p>

            </div>
        </div>
    </div>

</div>