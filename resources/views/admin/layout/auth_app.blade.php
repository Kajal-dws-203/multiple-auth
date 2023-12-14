<!DOCTYPE html>
<html>
    <head>
        @include('admin.layout.auth_head')
    </head>
    <body class="hold-transition login-page">
        @include('admin.layout.navbaar')
        @yield('content')
        @include('admin.layout.auth_foot')
    </body>
</html>



