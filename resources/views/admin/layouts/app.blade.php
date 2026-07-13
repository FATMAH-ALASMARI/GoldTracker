<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>GoldTracker | لوحة المدير</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- Font Awesome -->

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        rel="stylesheet">


    <!-- Google Font -->

    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">


    <!-- CSS -->

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <link rel="stylesheet" href="{{ asset('css/cards.css') }}">

    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">

    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">

    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

</head>


<body>


    <!-- ===========================
         Navbar
    ============================ -->

    <header class="top-navbar">


        <!-- Brand -->

        <div class="navbar-brand-area">

            <div class="brand-icon">

                <i class="fa-solid fa-coins"></i>

            </div>


            <div class="brand-info">

                <h3 class="brand-title">

                    GoldTracker

                </h3>


                <span class="brand-subtitle">

                    Real-Time Gold Market

                </span>

            </div>

        </div>



        <!-- Navbar Actions -->

        <div class="navbar-actions">


            <button
                type="button"
                class="icon-btn"
                aria-label="الإشعارات">

                <i class="fa-regular fa-bell"></i>

            </button>


            <button
                type="button"
                class="icon-btn"
                aria-label="الإعدادات">

                <i class="fa-solid fa-gear"></i>

            </button>


            @auth

                <div class="navbar-divider"></div>


                <div class="navbar-user">


                    <div class="user-avatar">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    </div>


                    <div class="user-info">

                        <span class="user-name">

                            {{ Auth::user()->name }}

                        </span>


                        <span class="user-role">

                            Administrator

                        </span>

                    </div>


                </div>

            @endauth


        </div>


    </header>



    <!-- ===========================
         Admin Layout
    ============================ -->

    <div class="admin-layout">


        <!-- Sidebar -->

        <aside class="sidebar">

            @include('admin.sidebar')

        </aside>



        <!-- Content -->

        <main class="content-area">


            <div class="page-wrapper">


                @if(session('success'))

                    <div class="alert alert-success">

                        {{ session('success') }}

                    </div>

                @endif



                @if(session('error'))

                    <div class="alert alert-danger">

                        {{ session('error') }}

                    </div>

                @endif



                @yield('content')


            </div>


        </main>


    </div>



    <!-- Bootstrap -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Chart JS -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    @stack('scripts')


</body>

</html>