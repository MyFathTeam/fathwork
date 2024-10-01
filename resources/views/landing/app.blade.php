<!DOCTYPE html>
<html lang="en">
  @include('landing.layouts.header')
  @include('landing.layouts.style')
  @stack('style')
<!-- Body-->
<body id="page-top">
    @include('landing.layouts.banner')
    @yield('content')
    @include('landing.layouts.modal')
    @include('landing.layouts.footer')
    @include('landing.layouts.script')
    @yield('script')
    @stack('js')
</body>
</html>

