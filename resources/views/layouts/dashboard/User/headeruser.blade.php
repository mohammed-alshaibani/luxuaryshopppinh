<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>لوحة التحكم -رفاهية التسوق</title>
  <link rel="stylesheet" href="{{ asset('/css/bootstrap-337.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/font-awsome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/style2.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;400&display=swap" rel="stylesheet">
</head>

<body>
  
@include('layouts.dashboard.User.sidebaruser')

<div class="content">
@yield('content')
</div>

<script src="{{ asset('/js/jquery-331.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap-337.min.js') }}"></script>
<script src="{{ asset('/js/code.jquery.com_jquery-3.7.1.min.js') }}"></script>
@yield('script')

</body>
</html>