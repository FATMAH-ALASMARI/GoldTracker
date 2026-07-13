<div class="card gold-chart-card border-0 mt-4">

    <div class="gold-chart-header">

        <div>
            <h4 class="gold-chart-title">
                <i class="fa-solid fa-chart-line"></i>
                تطور أسعار الذهب
            </h4>

            <p class="gold-chart-subtitle">
                متابعة حركة أسعار الذهب المسجلة
            </p>
        </div>

        <div class="gold-chart-status">

            <div class="gold-live-badge">

                <div class="gold-live-badge-title">
                    <span class="gold-live-dot"></span>

                    <span>
                        بيانات مباشرة
                    </span>
                </div>

                @if($lastUpdate)
                    <div class="gold-live-badge-time">
                        <i class="fa-regular fa-clock"></i>

                        <span>
                            آخر تحديث:
                            {{ \Carbon\Carbon::parse($lastUpdate)->format('d/m/Y - H:i') }}
                        </span>
                    </div>
                @endif

            </div>

        </div>

    </div>

    <div class="gold-chart-body">

        <div class="gold-chart-wrapper">
            <canvas id="pricesChart"></canvas>
        </div>

    </div>

</div>