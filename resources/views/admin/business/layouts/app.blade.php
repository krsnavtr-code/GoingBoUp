<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoingBo Business Admin Portal</title>
    <link rel="stylesheet" href="{{ asset('css/admin_css/business_css/style.css') }}"> <!-- Link to your custom CSS -->
    <link rel="stylesheet" href="{{ url('css/admin_css/forms.css') }}">
    <link rel="stylesheet" href="{{ url('css/master.css') }}">
    <link rel="stylesheet" href="{{ url('css/theme.css') }}">
    <link rel="stylesheet" href="{{ url('icon/css/all.min.css')}}" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @stack('css')
</head>
<body>

    <div class="main-layout">
        <!-- Sidebar -->
        @if (session()->has('businessId')) 
            @include('admin.business.layouts.sidebar')
        @endif

        <div class="main-content">
            <!-- Header -->
            @include('admin.business.layouts.header')

            @if (session()->has('businessId')) 
                <!-- Main Content -->
                <div class="content">
                    @yield('content')
                </div>
            @else
            <div class="page-container">
                <div class="login-container">
                <div class="form-section">
                    <h2>GoingBo Business Admin</h2>
                    <form action="{{ url('admin/business-login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn">Login</button>
                    </form>
                </div>
                <div class="image-section"></div>
                </div>
            </div>
            @endif
            <!-- Footer -->
            @include('admin.business.layouts.footer')
        </div>


    </div>

    <!-- Main Scripts -->
    <script src="{{ url('js/master.js') }}"></script>
    <script src="{{ url('js/form_utils.js') }}"></script>
    <!-- Other Scripts -->
    @stack('js')
    
</body>
</html>
