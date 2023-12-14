<!DOCTYPE html>
<html>
    <head>
        @include('admin.layout.head')
    </head>
    <body class="hold-transition layout-top-nav">
        <div class="wrapper">
            @include('admin.layout.header1')
            @yield('content')
        </div>
    </body>
    @include('admin.layout.foot')
    @yield('scripts')
</html>