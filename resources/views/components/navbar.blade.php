<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('gold.index') }}">
            🪙 GoldTracker
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('gold.index') }}">
                        الرئيسية
                    </a>
                </li>

            </ul>

            @guest

                <a href="{{ route('login') }}"
                   class="btn btn-outline-light me-2">
                    تسجيل الدخول
                </a>

                <a href="{{ route('register') }}"
                   class="btn btn-warning">
                    إنشاء حساب
                </a>

            @endguest

            @auth

                <span class="text-white me-3">
                    👤 {{ Auth::user()->name }}
                </span>

                <a href="{{ route('profile.edit') }}"
                   class="btn btn-outline-info me-2">
                    الملف الشخصي
                </a>

                <form action="{{ route('logout') }}"
                      method="POST">

                    @csrf

                    <button class="btn btn-danger">
                        تسجيل الخروج
                    </button>

                </form>

            @endauth

        </div>

    </div>
</nav>
