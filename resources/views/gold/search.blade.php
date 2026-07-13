<div class="gold-search-card mb-4">

    <div class="gold-search-header">

        <div>
            <h4 class="gold-search-title">
                <i class="fa-solid fa-magnifying-glass-chart"></i>
                البحث وتصفية الأسعار
            </h4>

            <p class="gold-search-subtitle">
                ابحث حسب العيار أو حدد فترة زمنية
            </p>
        </div>

        <span class="gold-search-badge">
            FILTER
        </span>

    </div>

    <div class="gold-search-body">

        <form method="GET" action="{{ route('gold.index') }}">

            <div class="row g-3 align-items-end">

                <div class="col-lg-4">

                    <label class="gold-form-label">
                        <i class="fa-solid fa-coins"></i>
                        اسم العيار
                    </label>

                    <input
                        type="text"
                        name="search"
                        class="gold-form-control"
                        placeholder="ابحث عن العيار..."
                        value="{{ request('search') }}">

                </div>

                <div class="col-lg-2">

                    <label class="gold-form-label">
                        <i class="fa-regular fa-calendar"></i>
                        من تاريخ
                    </label>

                    <input
                        type="date"
                        name="from_date"
                        class="gold-form-control"
                        value="{{ request('from_date') }}">

                </div>

                <div class="col-lg-2">

                    <label class="gold-form-label">
                        <i class="fa-regular fa-calendar-check"></i>
                        إلى تاريخ
                    </label>

                    <input
                        type="date"
                        name="to_date"
                        class="gold-form-control"
                        value="{{ request('to_date') }}">

                </div>

                <div class="col-lg-2 d-grid">

                    <button type="submit" class="gold-search-btn">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        بحث

                    </button>

                </div>

                <div class="col-lg-2 d-grid">

                    <a href="{{ route('gold.index') }}"
                       class="gold-reset-btn">

                        <i class="fa-solid fa-rotate-left"></i>

                        إعادة تعيين

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>