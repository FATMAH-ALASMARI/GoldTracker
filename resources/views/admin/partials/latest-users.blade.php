<div class="dashboard-card mt-4">

    <div class="dashboard-card-header">

        <div>
            <h4>
                <i class="bi bi-people-fill text-warning"></i>
                آخر المستخدمين
            </h4>

            <small>
                آخر 5 حسابات تم إنشاؤها
            </small>
        </div>

    </div>

    <div class="table-responsive">

        <table class="table premium-table align-middle mb-0">

            <thead>

                <tr>

                    <th>#</th>

                    <th>المستخدم</th>

                    <th>البريد الإلكتروني</th>

                    <th>الصلاحية</th>

                    <th>تاريخ التسجيل</th>

                </tr>

            </thead>

            <tbody>

            @forelse($latestUsers as $user)

                <tr>

                    <td>{{ $user->id }}</td>

                    <td>

                        <div class="d-flex align-items-center gap-3">

                            <div class="table-avatar">

                                {{ strtoupper(substr($user->name,0,1)) }}

                            </div>

                            <strong>{{ $user->name }}</strong>

                        </div>

                    </td>

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

                    <td>

                        {{ $user->created_at->format('Y-m-d') }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5" class="text-center py-4">

                        لا يوجد مستخدمون.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>