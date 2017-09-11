<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="/assets/css/home.css">
    @yield('custom_css')
  </head>
  <body>
    @yield('content')
    <script src="/assets/js/home.js"></script>
    @yield('custom_js')
  </body>
</html>
