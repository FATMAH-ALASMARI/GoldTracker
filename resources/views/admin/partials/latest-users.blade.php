<div class="card mt-5 shadow">

    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">
            👥 آخر المستخدمين
        </h5>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الصلاحية</th>
                    <th>تاريخ التسجيل</th>
                </tr>
            </thead>

            <tbody>

            @foreach($latestUsers as $user)

                <tr>

                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

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

                    <td>{{ $user->created_at->format('Y-m-d') }}</td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>