<html>
    <head>
        <title>App Name - @yield('title')</title>
        @yield('static')
    </head>
    <body>
        @section('sidebar')
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>