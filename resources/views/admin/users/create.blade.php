@extends('admin.layouts.app')

@section('content')

<div class="mb-4">

    <h2 class="fw-bold mb-2">
        <i class="fa-solid fa-user-plus text-warning ms-2"></i>
        إضافة مستخدم جديد
    </h2>

    <p class="text-secondary mb-0">
        إنشاء حساب مستخدم جديد وتحديد صلاحياته في نظام GoldTracker
    </p>

</div>


<div class="card border-0 shadow-lg">

    <div class="card-body p-4">

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form method="POST"
              action="{{ route('admin.users.store') }}">

            @csrf


            <div class="row g-4">


                <div class="col-md-6">

                    <label class="form-label">
                        اسم المستخدم
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        placeholder="أدخل اسم المستخدم"
                        required>

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        البريد الإلكتروني
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="example@email.com"
                        required>

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        كلمة المرور
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="8 أحرف على الأقل"
                        required>

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        تأكيد كلمة المرور
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="أعد إدخال كلمة المرور"
                        required>

                </div>


                <div class="col-md-6">

                    <label class="form-label">
                        الصلاحية
                    </label>

                    <select
                        name="role"
                        class="form-select"
                        required>

                        <option value="user"
                            {{ old('role') == 'user' ? 'selected' : '' }}>
                            مستخدم
                        </option>

                        <option value="admin"
                            {{ old('role') == 'admin' ? 'selected' : '' }}>
                            مدير
                        </option>

                    </select>

                </div>


            </div>


            <div class="d-flex gap-3 mt-5">

                <button
                    type="submit"
                    class="btn btn-gold px-4">

                    <i class="fa-solid fa-user-plus ms-2"></i>

                    إضافة المستخدم

                </button>


                <a href="{{ route('admin.users') }}"
                   class="btn btn-outline-secondary px-4">

                    إلغاء

                </a>

            </div>


        </form>

    </div>

</div>

@endsection