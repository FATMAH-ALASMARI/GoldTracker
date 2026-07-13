@extends('layouts.app')

@section('content')

<div class="container-fluid px-4 py-4">

    {{-- Hero --}}
    @include('gold.hero')

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Statistics --}}
    @include('gold.stats')

    {{-- Search --}}
    @include('gold.search')

    {{-- Chart --}}
    @include('gold.chart')

    {{-- Table --}}
    @include('gold.table')

</div>

@endsection


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('pricesChart');

    if (!ctx) {
        return;
    }

    const chartLabels = @json($chartLabels);
    const chartData = @json($chartData);

    /*
    |--------------------------------------------------------------------------
    | Limited Historical Data Message
    |--------------------------------------------------------------------------
    */

    if (chartLabels.length < 2) {

        const chartContainer = ctx.parentElement;

        const oldMessage = chartContainer.querySelector(
            '.chart-data-message'
        );

        if (!oldMessage) {

            const message = document.createElement('div');

            message.className = 'chart-data-message';

            message.innerHTML = `
                <i class="fa-solid fa-circle-info"></i>
                البيانات التاريخية محدودة خلال الفترة المحددة
            `;

            chartContainer.appendChild(message);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Gold Prices Chart
    |--------------------------------------------------------------------------
    */

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: chartLabels,

            datasets: [

                {
                    label: 'عيار 24',

                    data: chartData['24'],

                    borderColor: '#f2c94c',

                    backgroundColor: 'transparent',

                    borderWidth: 3,

                    tension: 0.4,

                    pointRadius: 4,

                    pointHoverRadius: 7,

                    pointBackgroundColor: '#f2c94c',

                    pointBorderColor: '#ffffff',

                    pointBorderWidth: 2,

                    spanGaps: true
                },

                {
                    label: 'عيار 22',

                    data: chartData['22'],

                    borderColor: '#2ecc71',

                    backgroundColor: 'transparent',

                    borderWidth: 3,

                    tension: 0.4,

                    pointRadius: 4,

                    pointHoverRadius: 7,

                    pointBackgroundColor: '#2ecc71',

                    pointBorderColor: '#ffffff',

                    pointBorderWidth: 2,

                    spanGaps: true
                },

                {
                    label: 'عيار 21',

                    data: chartData['21'],

                    borderColor: '#3498db',

                    backgroundColor: 'transparent',

                    borderWidth: 3,

                    tension: 0.4,

                    pointRadius: 4,

                    pointHoverRadius: 7,

                    pointBackgroundColor: '#3498db',

                    pointBorderColor: '#ffffff',

                    pointBorderWidth: 2,

                    spanGaps: true
                },

                {
                    label: 'عيار 18',

                    data: chartData['18'],

                    borderColor: '#e67e22',

                    backgroundColor: 'transparent',

                    borderWidth: 3,

                    tension: 0.4,

                    pointRadius: 4,

                    pointHoverRadius: 7,

                    pointBackgroundColor: '#e67e22',

                    pointBorderColor: '#ffffff',

                    pointBorderWidth: 2,

                    spanGaps: true
                }

            ]
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

                        color: '#ffffff',

                        usePointStyle: true,

                        padding: 20,

                        font: {
                            family: 'Cairo',
                            size: 13
                        }
                    }
                },


                tooltip: {

                    callbacks: {

                        title: function(context) {

                            const label = context[0].label;

                            if (!label) {
                                return '';
                            }

                            const parts = label.split(' ');

                            if (parts.length < 2) {
                                return label;
                            }

                            const time = parts[0];
                            const date = parts[1];

                            return 'التاريخ: '
                                + date
                                + ' | الوقت: '
                                + time;
                        },


                        label: function(context) {

                            return context.dataset.label
                                + ': '
                                + Number(context.parsed.y).toFixed(2)
                                + ' ريال';
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

                        color: '#8f9aaa',

                        autoSkip: true,

                        maxTicksLimit: 8,

                        maxRotation: 0,

                        minRotation: 0,

                        padding: 10,

                        callback: function(value) {

                            const label = this.getLabelForValue(value);

                            if (!label) {
                                return '';
                            }

                            const parts = label.split(' ');

                            if (parts.length < 2) {
                                return label;
                            }

                            const time = parts[0];
                            const date = parts[1];

                            return date + ' ' + time;
                        },

                        font: {
                            family: 'Cairo',
                            size: 12
                        }
                    }
                },


                y: {

                    beginAtZero: false,

                    grid: {
                        color: 'rgba(255,255,255,0.05)'
                    },

                    ticks: {

                        color: '#8f9aaa',

                        font: {
                            family: 'Cairo'
                        }
                    }
                }
            }
        }

    });

});
</script>

@endpush