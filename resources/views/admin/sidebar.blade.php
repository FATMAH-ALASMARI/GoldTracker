<nav class="nav flex-column">

    <a href="{{ route('admin.dashboard') }}"
       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

        <span>
            <i class="bi bi-speedometer2 me-2"></i>
            لوحة التحكم
        </span>

    </a>

    <a href="{{ route('admin.users') }}"
       class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">

        <span>
            <i class="bi bi-people me-2"></i>
            إدارة المستخدمين
        </span>

    </a>

    <a href="{{ route('admin.logs') }}"
       class="nav-link {{ request()->routeIs('admin.logs') ? 'active' : '' }}">

        <span>
            <i class="bi bi-clock-history me-2"></i>
            سجل العمليات
        </span>

    </a>

    <a href="{{ route('gold.index') }}"
       class="nav-link {{ request()->routeIs('gold.*') ? 'active' : '' }}">

        <span>
            <i class="bi bi-currency-dollar me-2"></i>
            أسعار الذهب
        </span>

    </a>

    <a href="{{ route('admin.system-health') }}"
       class="nav-link {{ request()->routeIs('admin.system-health*') ? 'active' : '' }}">

        <span>
            <i class="bi bi-heart-pulse me-2"></i>
            صحة النظام
        </span>

    </a>

    <hr>

    <a href="{{ route('profile.edit') }}"
       class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">

        <span>
            <i class="bi bi-person-circle me-2"></i>
            الملف الشخصي
        </span>

    </a>

    <form action="{{ route('logout') }}" method="POST">

        @csrf

        <button type="submit"
                class="nav-link w-100 border-0 bg-transparent text-start">

            <span class="text-danger">
                <i class="bi bi-box-arrow-right me-2"></i>
                تسجيل الخروج
            </span>

        </button>

    </form>

</nav>