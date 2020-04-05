<!DOCTYPE html>
<html>
<head>
    <title>Online Book</title>
    <base href="{{ asset('') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="source_page/css/bootstrap4/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="source_page/css/style.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    <style>
        nav #navbarResponsive ul li a:hover{
            color: #0dd025;
        }
        table#tblListBook thead th{
            border-left: 1px solid black;
            border-right: 1px solid black;
            text-align: center;
            vertical-align: middle;
        }
        table#tblListBook thead th a{
            color: white;
            text-decoration: none;
        }
        table#tblListBook tbody tr td{
            border-left: 1px solid black;
            border-right: 1px solid black;
            text-align: center;
            vertical-align: middle;
        }
        table#tblAccount thead th{
            border-left: 1px solid black;
            border-right: 1px solid black;
            vertical-align: middle;
            text-align: center;
        }
        table#tblAccount tbody tr td{
            vertical-align: middle;
            text-align: center;
            border-left: 1px solid black;
            border-right: 1px solid black;
        }
        table#tblAccount thead th a{
            color: white;
            text-decoration: none;
        }
        
    </style>
</head>
<body>
    @include('header')

    @yield('content')

    @include('footer')

    <script src="source_page/js/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="source_page/js/bootstrap.js" type="text/javascript"></script>
    
    @yield('script')
</body>
</html>
