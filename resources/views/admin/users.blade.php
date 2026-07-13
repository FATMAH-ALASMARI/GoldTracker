@extends('admin.layouts.app')

@section('content')

{{-- ===========================
     Page Header
=========================== --}}

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold mb-2">

            <i class="fa-solid fa-users text-warning ms-2"></i>

            إدارة المستخدمين

        </h2>

        <p class="text-secondary mb-0">

            إدارة حسابات المستخدمين والصلاحيات في نظام GoldTracker

        </p>

    </div>


    <a href="{{ route('admin.users.create') }}"
       class="btn btn-gold px-4">

        <i class="fa-solid fa-user-plus ms-2"></i>

        إضافة مستخدم جديد

    </a>

</div>


{{-- ===========================
     Statistics
=========================== --}}

<div class="row g-4 mb-4">

    <div class="col-md-4">

        <div class="stats-card stats-blue">

            <div class="stats-content">

                <span>إجمالي المستخدمين</span>

                <h2>{{ $totalUsers }}</h2>

                <small>جميع الحسابات المسجلة</small>

            </div>


            <div class="stats-icon">

                <i class="fa-solid fa-users"></i>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="stats-card stats-red">

            <div class="stats-content">

                <span>المديرون</span>

                <h2>{{ $totalAdmins }}</h2>

                <small>حسابات الإدارة</small>

            </div>


            <div class="stats-icon">

                <i class="fa-solid fa-user-shield"></i>

            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="stats-card stats-green">

            <div class="stats-content">

                <span>المستخدمون</span>

                <h2>{{ $totalNormalUsers }}</h2>

                <small>الحسابات العادية</small>

            </div>


            <div class="stats-icon">

                <i class="fa-solid fa-user"></i>

            </div>

        </div>

    </div>

</div>


{{-- ===========================
     Users Card
=========================== --}}

<div class="card border-0 shadow-lg">

    <div class="card-body p-4">


        {{-- Search --}}

        <form method="GET"
              action="{{ route('admin.users') }}"
              class="row g-3 mb-4">

            <div class="col-md-10">

                <input
                    type="text"
                    name="search"
                    class="form-control"
                    placeholder="ابحث بالاسم أو البريد الإلكتروني..."
                    value="{{ request('search') }}">

            </div>


            <div class="col-md-2 d-grid">

                <button
                    type="submit"
                    class="btn btn-gold">

                    <i class="fa-solid fa-magnifying-glass ms-2"></i>

                    بحث

                </button>

            </div>

        </form>


        {{-- Users Table --}}

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>الاسم</th>

                        <th>البريد الإلكتروني</th>

                        <th>الصلاحية</th>

                        <th>تاريخ التسجيل</th>

                        <th>الإجراء</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($users as $user)

                        <tr>

                            <td>

                                {{ $user->id }}

                            </td>


                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div class="user-avatar">

                                        {{ strtoupper(substr($user->name, 0, 1)) }}

                                    </div>


                                    <strong>

                                        {{ $user->name }}

                                    </strong>

                                </div>

                            </td>


                            <td>

                                {{ $user->email }}

                            </td>


                            <td>

                                @if($user->role == 'admin')

                                    <span class="badge bg-danger">

                                        Admin

                                    </span>

                                @else

                                    <span class="badge bg-success">

                                        User

                                    </span>

                                @endif

                            </td>


                            <td>

                                {{ $user->created_at->format('Y-m-d') }}

                            </td>


                            <td>

                                @if(auth()->id() != $user->id)

                                    <div class="d-flex gap-2 flex-wrap">


                                        <form
                                            action="{{ route('admin.users.role', $user) }}"
                                            method="POST">

                                            @csrf

                                            @method('PUT')


                                            <button
                                                type="submit"
                                                class="btn btn-warning btn-sm">

                                                @if($user->role == 'admin')

                                                    تحويل إلى User

                                                @else

                                                    تحويل إلى Admin

                                                @endif

                                            </button>

                                        </form>


                                        <form
                                            action="{{ route('admin.users.destroy', $user) }}"
                                            method="POST"
                                            onsubmit="return confirm('هل أنت متأكد من حذف المستخدم؟')">

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm">

                                                <i class="fa-solid fa-trash ms-1"></i>

                                                حذف

                                            </button>

                                        </form>


                                    </div>

                                @else

                                    <span class="badge bg-secondary">

                                        الحساب الحالي

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-5 text-secondary">

                                لا يوجد مستخدمون

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}

        <div class="mt-4">

            {{ $users->links() }}

        </div>


    </div>

</div>

@endsection