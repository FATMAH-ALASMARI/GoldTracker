<div class="row g-4 dashboard-system-stats">

    {{-- عدد المستخدمين --}}
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-metric-card">

            <div class="metric-icon">
                <i class="bi bi-people-fill"></i>
            </div>

            <div class="metric-content">
                <h2>{{ $users }}</h2>
                <p>عدد المستخدمين</p>
            </div>

        </div>
    </div>

    {{-- أسعار الذهب --}}
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-metric-card">

            <div class="metric-icon">
                <i class="bi bi-tag-fill"></i>
            </div>

            <div class="metric-content">
                <h2>{{ $prices }}</h2>
                <p>أسعار الذهب</p>
            </div>

        </div>
    </div>

    {{-- العمليات --}}
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-metric-card">

            <div class="metric-icon">
                <i class="bi bi-folder-fill"></i>
            </div>

            <div class="metric-content">
                <h2>{{ $logs }}</h2>
                <p>العمليات</p>
            </div>

        </div>
    </div>

    {{-- متوسط السعر --}}
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-metric-card">

            <div class="metric-icon">
                <i class="bi bi-graph-up-arrow"></i>
            </div>

            <div class="metric-content">
                <h2>
                    {{ number_format(\App\Models\GoldPrice::avg('price'), 2) }}
                </h2>

                <p>متوسط السعر</p>
            </div>

        </div>
    </div>

</div>