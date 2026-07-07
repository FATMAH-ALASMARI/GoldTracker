<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>GoldTracker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body{
            background:#f5f5f5;
        }

        .card{
            border:none;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,.1);
        }

        h2{
            color:#d4af37;
            font-weight:bold;
        }

        .table th{
            background:#d4af37;
            color:white;
        }

        .btn-gold{
            background:#d4af37;
            color:white;
        }

        .btn-gold:hover{
            background:#b89228;
            color:white;
        }

        /* Dashboard Cards */

        .dashboard-card{
            border-radius:15px;
            transition:.3s;
            box-shadow:0 8px 20px rgba(0,0,0,.15);
        }

        .dashboard-card:hover{
            transform:translateY(-6px);
        }

        .dashboard-card h5{
            font-size:18px;
        }

        .dashboard-card h2{
            font-size:34px;
            font-weight:bold;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="card p-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>💰 أسعار الذهب</h2>
            <div>
                <a href="{{ route('gold.export') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-excel"></i>
                    تصدير Excel
                </a>
                <a href="{{ route('gold.create') }}" class="btn btn-gold">
                    <i class="bi bi-plus-circle"></i>
                    إضافة سعر جديد
                </a>
            </div>
        </div>

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        <div class="row mb-4">

            <div class="col-md-3">

                <div class="card dashboard-card bg-primary text-white">

                    <div class="card-body">

                        <h5>عدد الأسعار</h5>

                        <h2>{{ $totalPrices }}</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card dashboard-card bg-success text-white">

                    <div class="card-body">

                        <h5>أعلى سعر</h5>

                        <h2>{{ $highestPrice }} ريال</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card dashboard-card bg-danger text-white">

                    <div class="card-body">

                        <h5>أقل سعر</h5>

                        <h2>{{ $lowestPrice }} ريال</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card dashboard-card bg-warning text-dark">

                    <div class="card-body">

                        <h5>المتوسط</h5>

                        <h2>{{ $averagePrice }} ريال</h2>

                    </div>

                </div>

            </div>

        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('gold.index') }}">

                    <div class="row g-3">

                        <div class="col-md-4">
                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="ابحث عن العيار"
                                value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3">
                            <input
                                type="date"
                                name="from_date"
                                class="form-control"
                                value="{{ request('from_date') }}">
                        </div>

                        <div class="col-md-3">
                            <input
                                type="date"
                                name="to_date"
                                class="form-control"
                                value="{{ request('to_date') }}">
                        </div>

                        <div class="col-md-2 d-grid">
                            <button class="btn btn-gold">
                                🔍 بحث
                            </button>
                        </div>

                        <div class="col-md-2 d-grid">
                            <a href="{{ route('gold.index') }}" class="btn btn-secondary">
                                إعادة تعيين
                            </a>
                        </div>

                    </div>

                </form>
            </div>
        </div>

        <div class="card p-4 mt-4">
            <h4 class="mb-3">📊 مخطط الأسعار</h4>
            <canvas id="pricesChart"></canvas>
        </div>

        <table class="table table-bordered table-hover text-center align-middle">

            <thead>

            <tr>

                <th>#</th>
                <th>
                    <a href="{{ route('gold.index', array_merge(request()->query(), [
                        'sort' => 'karat',
                        'direction' => request('direction') == 'asc' ? 'desc' : 'asc'
                    ])) }}"
                    class="text-white text-decoration-none">
                        اسم العيار
                        @if(request('sort') == 'karat')
                            {{ request('direction') == 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th>
                    <a href="{{ route('gold.index', array_merge(request()->query(), [
                        'sort' => 'price',
                        'direction' => request('direction') == 'asc' ? 'desc' : 'asc'
                    ])) }}"
                    class="text-white text-decoration-none">

                        السعر

                        @if(request('sort') == 'price')
                            {{ request('direction') == 'asc' ? '▲' : '▼' }}
                        @endif

                    </a>
                </th>
                <th>
                    <a href="{{ route('gold.index', array_merge(request()->query(), [
                        'sort' => 'created_at',
                        'direction' => request('direction') == 'asc' ? 'desc' : 'asc'
                    ])) }}"
                    class="text-white text-decoration-none">
                        التاريخ
                        @if(request('sort') == 'created_at')
                            {{ request('direction') == 'asc' ? '▲' : '▼' }}
                        @endif
                    </a>
                </th>
                <th>العمليات</th>

            </tr>

            </thead>

            <tbody>

            @foreach($prices as $price)

                <tr>

                    <td>{{ $price->id }}</td>

                    <td>{{ $price->karat }}</td>

                    <td>{{ $price->price }} ريال</td>

                    <td>{{ $price->created_at->format('Y-m-d') }}</td>

                    <td>

                        <a href="{{ route('gold.edit',$price->id) }}"
                           class="btn btn-warning btn-sm">
                            تعديل
                        </a>

                        <form action="{{ route('gold.destroy',$price->id) }}"
                              method="POST"
                              style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('هل تريد الحذف؟')">

                                حذف

                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

        <div class="mt-4 d-flex justify-content-center">
            {{ $prices->links() }}
        </div>

        <div class="card mb-4">

            <div class="card-header bg-dark text-white">
                📈 أسعار الذهب
            </div>

            <div class="card-body">

                <canvas id="goldChart" height="90"></canvas>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pricesChart');

    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: 'الأسعار',
                    data: @json($chartPrices),
                    backgroundColor: ['#d4af37', '#c9a227', '#f4d03f', '#b89228'],
                    borderColor: '#d4af37',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>

<script>

const ctx = document.getElementById('goldChart');

if(ctx){

new Chart(ctx,{

type:'line',

data:{

labels:@json($labels),

datasets:[{

label:'سعر الذهب',

data:@json($chartPrices),

borderColor:'#d4af37',

backgroundColor:'rgba(212,175,55,.2)',

fill:true,

tension:.4

}]

},

options:{

responsive:true,

plugins:{

legend:{

display:true

}

}

}

});

}

</script>

</body>
</html>