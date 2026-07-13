<div class="hero-section mb-4">

    <div class="hero-content">

        <div class="hero-left">

            <span class="hero-badge">
                <i class="bi bi-circle-fill"></i>
                LIVE MARKET
            </span>

            <div class="hero-welcome">
                مرحباً بك في
            </div>

            <h1 class="hero-title">
                <span>Gold</span>Tracker
            </h1>

            <h3 class="hero-subtitle">
                Real-Time Gold Market
            </h3>

            <p class="hero-text">
                تابع أسعار الذهب المباشرة وتحليل السوق لحظة بلحظة
                <br>
                مع تحديثات فورية وإحصائيات دقيقة.
            </p>

            <div class="hero-actions">

                <a href="#prices" class="btn btn-gold">
                    عرض الأسعار
                    <i class="bi bi-graph-up-arrow"></i>
                </a>

                @auth
                    <a href="{{ route('gold.create') }}"
                       class="hero-outline-btn">

                        إضافة سعر جديد
                        <i class="bi bi-plus-circle"></i>

                    </a>
                @endauth

            </div>

        </div>

        <div class="hero-right">

            <div class="gold-market-art">

                <img src="{{ asset('images/gold-hero.png') }}"
                     alt="Gold Market"
                     class="gold-hero-image">

            </div>

        </div>

    </div>

</div>