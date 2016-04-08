<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>@yield('title')</title>
   <link rel="icon" type="image/x-icon" href="{{asset('favicon.ico')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('src/css/bootstrap.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('src/css/bootstrap-theme.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('src/css/jquery-ui.min.css')}}"/>
   <link rel="stylesheet" type="text/css" href="{{asset('src/css/style.css')}}"/>
</head>
<body>
<main>
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            @yield('content')
         </div>
         <!-- /.col-sm-12 -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container -->
</main>

<script src="{{asset('src/js/jquery-2.2.0.min.js')}}" type="text/javascript"></script>
<script src="{{asset('src/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('src/js/jquery-ui.min.js')}}" type="text/javascript"></script>
@yield('scripts')
</body>
</html>