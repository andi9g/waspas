<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="" type="image/x-icon">
  @include('layout.header')
  @yield('headers')
  <style>
    .nav-link{
        color: white !important;
    }
    .nav-link:hover{
        color: red !important;
        font-weight: bold;
    }
    .active {
        color: red !important;
        font-weight: bold;
    }
  </style>
</head>
<body class="bg-light">

  @yield('content')


@include('layout.script')

@yield('footers')
@yield('script')
</body>
</html>
