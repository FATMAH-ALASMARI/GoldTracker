<div class="row g-4 mb-2">

    {{-- أعلى سعر --}}
    <div class="col-lg-6">

        <div class="card stat-card stat-success">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div class="stat-content">

                    <span class="stat-label">
                        أعلى سعر
                    </span>

                    <div class="stat-price-row">

                        <h2 class="stat-value">
                            {{ number_format(\App\Models\GoldPrice::max('price'), 2) }}
                        </h2>

                        <span class="stat-currency">
                            ر.س
                        </span>

                    </div>

                    <small class="stat-text">
                        أعلى سعر مسجل حاليًا
                    </small>

                </div>

                <div class="stat-icon success">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- أقل سعر --}}
    <div class="col-lg-6">

        <div class="card stat-card stat-danger">

            <div class="card-body d-flex justify-content-between align-items-center">

                <div class="stat-content">

                    <span class="stat-label">
                        أقل سعر
                    </span>

                    <div class="stat-price-row">

                        <h2 class="stat-value">
                            {{ number_format(\App\Models\GoldPrice::min('price'), 2) }}
                        </h2>

                        <span class="stat-currency">
                            ر.س
                        </span>

                    </div>

                    <small class="stat-text">
                        أقل سعر مسجل حاليًا
                    </small>

                </div>

                <div class="stat-icon danger">
                    <i class="fa-solid fa-arrow-trend-down"></i>
                </div>

            </div>

        </div>

    </div>

</div>