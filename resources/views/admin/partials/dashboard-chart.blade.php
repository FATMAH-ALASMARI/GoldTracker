<div class="card shadow-sm border-0 dashboard-chart-card">

    <div class="card-header bg-white border-0 py-3">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div class="d-flex align-items-center">

                <div>
                    <h5 class="mb-0 fw-bold">
                        تطور أسعار الذهب
                    </h5>

                    <small class="text-muted">
                        آخر 10 تحديثات للأسعار
                    </small>
                </div>

            </div>

            <span class="badge bg-warning text-dark px-3 py-2">
                آخر 10 أسعار
            </span>

        </div>

    </div>

    <div class="card-body">

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

                backgroundColor: 'rgba(212,175,55,.12)',

                fill: true,

                borderWidth: 3,

                tension: 0.35,

                pointRadius: 5,

                pointHoverRadius: 7,

                pointBackgroundColor: '#D4AF37',

                pointBorderColor: '#FFFFFF',

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

                        padding: 18

                    }

                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return ' السعر: ' +
                                Number(context.parsed.y).toFixed(2);

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

                    grace: '10%',

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