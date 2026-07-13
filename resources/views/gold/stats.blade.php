<div class="row g-4 mb-5">

    <div class="col-lg-3 col-md-6">
        <div class="stats-card stats-blue">

            <div class="stats-icon">
                <i class="bi bi-bar-chart-fill"></i>
            </div>

            <div class="stats-content">
                <span>عدد الأسعار</span>
                <h2>{{ $totalPrices }}</h2>
            </div>

        </div>
    </div>


    <div class="col-lg-3 col-md-6">
        <div class="stats-card stats-green">

            <div class="stats-icon">
                <i class="bi bi-graph-up-arrow"></i>
            </div>

            <div class="stats-content">
                <span>أعلى سعر</span>
                <h2>
                    {{ $highestPrice }}
                    <small>ريال</small>
                </h2>
            </div>

        </div>
    </div>


    <div class="col-lg-3 col-md-6">
        <div class="stats-card stats-red">

            <div class="stats-icon">
                <i class="bi bi-graph-down-arrow"></i>
            </div>

            <div class="stats-content">
                <span>أقل سعر</span>
                <h2>
                    {{ $lowestPrice }}
                    <small>ريال</small>
                </h2>
            </div>

        </div>
    </div>


    <div class="col-lg-3 col-md-6">
        <div class="stats-card stats-gold">

            <div class="stats-icon">
                <i class="bi bi-cash-stack"></i>
            </div>

            <div class="stats-content">
                <span>المتوسط</span>
                <h2>
                    {{ $averagePrice }}
                    <small>ريال</small>
                </h2>
            </div>

        </div>
    </div>

</div>