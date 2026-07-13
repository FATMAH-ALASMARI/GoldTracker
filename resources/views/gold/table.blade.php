<div class="gold-table-card mt-4">

    <div class="gold-table-header">

        <div>
            <h4 class="gold-table-title">
                <i class="fa-solid fa-table-cells"></i>
                جدول أسعار الذهب
            </h4>

            <p class="gold-table-subtitle">
                عرض وإدارة أسعار الذهب المسجلة
            </p>
        </div>

        <span class="gold-table-count">
            {{ $prices->total() }} سعر
        </span>

    </div>

    <div class="table-responsive">

        <table class="table gold-premium-table align-middle mb-0">

            <thead>
                <tr>

                    <th>#</th>

                    <th>
                        <a href="{{ route('gold.index', array_merge(request()->query(), [
                            'sort' => 'karat',
                            'direction' => request('direction') == 'asc' ? 'desc' : 'asc'
                        ])) }}">

                            اسم العيار

                            @if(request('sort') == 'karat')
                                <span class="sort-icon">
                                    {{ request('direction') == 'asc' ? '▲' : '▼' }}
                                </span>
                            @endif

                        </a>
                    </th>

                    <th>
                        <a href="{{ route('gold.index', array_merge(request()->query(), [
                            'sort' => 'price',
                            'direction' => request('direction') == 'asc' ? 'desc' : 'asc'
                        ])) }}">

                            السعر

                            @if(request('sort') == 'price')
                                <span class="sort-icon">
                                    {{ request('direction') == 'asc' ? '▲' : '▼' }}
                                </span>
                            @endif

                        </a>
                    </th>

                    <th>
                        <a href="{{ route('gold.index', array_merge(request()->query(), [
                            'sort' => 'created_at',
                            'direction' => request('direction') == 'asc' ? 'desc' : 'asc'
                        ])) }}">

                            التاريخ

                            @if(request('sort') == 'created_at')
                                <span class="sort-icon">
                                    {{ request('direction') == 'asc' ? '▲' : '▼' }}
                                </span>
                            @endif

                        </a>
                    </th>

                    <th>العمليات</th>

                </tr>
            </thead>

            <tbody>

                @forelse($prices as $price)

                    <tr>

                        <td>
                            <span class="row-number">
                                {{ $prices->firstItem() + $loop->index }}
                            </span>
                        </td>

                        <td>
                            <div class="karat-cell">

                                <span class="karat-icon">
                                    <i class="fa-solid fa-coins"></i>
                                </span>

                                <strong>
                                    {{ $price->karat }}
                                </strong>

                            </div>
                        </td>

                        <td>
                            <span class="gold-price-value">
                                {{ number_format($price->price, 2) }}
                            </span>

                            <small class="currency-label">
                                ريال
                            </small>
                        </td>

                        <td>
                            <span class="date-value">
                                <i class="fa-regular fa-calendar"></i>

                                {{ $price->created_at->format('Y-m-d') }}
                            </span>
                        </td>

                        <td>

                            @auth

                                <div class="gold-table-actions">

                                    <a href="{{ route('gold.edit', $price->id) }}"
                                       class="table-edit-btn">

                                        <i class="fa-solid fa-pen"></i>

                                        تعديل

                                    </a>

                                    <form action="{{ route('gold.destroy', $price->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="table-delete-btn"
                                            onclick="return confirm('هل تريد حذف هذا السعر؟')">

                                            <i class="fa-solid fa-trash"></i>

                                            حذف

                                        </button>

                                    </form>

                                </div>

                            @endauth

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="gold-empty-table">

                            <i class="fa-solid fa-box-open"></i>

                            <p>
                                لا توجد أسعار محفوظة.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


<div class="gold-pagination mt-4">

    {{ $prices->links() }}

</div>