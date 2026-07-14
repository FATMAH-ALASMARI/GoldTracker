<div class="card gold-chart-card">

    <div class="gold-chart-header">

        <div>
            <h5 class="gold-chart-title">
                <i class="bi bi-graph-up-arrow"></i>
                تطور أسعار الذهب
            </h5>

            <p class="gold-chart-subtitle">
                متابعة أحدث تحديثات أسعار الذهب
            </p>
        </div>

        <div class="gold-chart-status">

            <div class="gold-live-badge">

                <span class="gold-live-badge-title">
                    <span class="gold-live-dot"></span>
                    السوق مباشر
                </span>

                <span class="gold-live-badge-time">
                    <i class="bi bi-clock"></i>
                    آخر 10 أسعار
                </span>

            </div>

        </div>

    </div>

    <div class="card-body gold-chart-body">

        <div class="gold-chart-wrapper">
            <canvas id="goldChart"></canvas>
        </div>

    </div>

</div>


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const chartData = @json($chartData);

    const labels = chartData.map((item, index) => {
        return item.karat ?? `تحديث ${index + 1}`;
    });

    const prices = chartData.map(item => {
        return Number(item.price);
    });

    const ctx = document.getElementById('goldChart');

    if (!ctx || !chartData.length) {
        return;
    }

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: labels,

            datasets: [{

                label: 'سعر الذهب',

                data: prices,

                borderColor: '#D4AF37',

                backgroundColor: 'rgba(212,175,55,.08)',

                fill: true,

                borderWidth: 2.5,

                tension: 0.4,

                pointRadius: 4,

                pointHoverRadius: 7,

                pointBackgroundColor: '#D4AF37',

                pointBorderColor: '#111B29',

                pointBorderWidth: 2

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            interaction: {
                intersect: false,
                mode: 'index'
            },

            plugins: {

                legend: {

                    display: true,

                    labels: {
                        color: '#AEB8C8',
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 20
                    }

                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return ' السعر: ' +
                                Number(context.parsed.y).toFixed(2) +
                                ' ر.س';

                        }

                    }

                }

            },

            scales: {

                x: {

                    grid: {
                        display: false
                    },

                    ticks: {
                        color: '#8FA0B8'
                    }

                },

                y: {

                    beginAtZero: false,

                    grace: '8%',

                    grid: {
                        color: 'rgba(255,255,255,.05)'
                    },

                    ticks: {

                        color: '#8FA0B8',

                        callback: function(value) {
                            return Number(value).toFixed(0);
                        }

                    }

                }

            }

        }

    });

});

</script>

@endpush