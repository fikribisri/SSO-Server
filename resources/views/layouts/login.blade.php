<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="SSO">
    <meta name="author" content="fikribisri@gmail.com">
    <meta name="keyword" content="SSO">
    <meta name="csrf-token" content="{{-- csrf_token() --}}">
    <title>OAuth 2.0 Login</title>
    <link href="{{ asset('vendor/@coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/pace-progress/css/pace.min.css') }}" rel="stylesheet">
    @yield('css')
  </head>
  <body class="app flex-row align-items-center login-container">
    <div class="container">
      @yield('content')
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/pace-progress/pace.min.js') }}"></script>
    <script src="{{ asset('vendor/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('vendor/@coreui/coreui-pro/dist/js/coreui.min.js') }}"></script>
    @yield('js')
  </body>
</html>
