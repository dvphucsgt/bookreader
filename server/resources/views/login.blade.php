<!DOCTYPE html>
<html>
<head>
        <title>Online Book</title>
        <base href="{{ asset('') }}">
        <link rel="stylesheet" type="text/css" href="source_page/css/bootstrap4/bootstrap.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" type="text/css" href="source_page/css/style.css">
</head>
<body>
        <div class="login-container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="wrapper">
                            <div class="form-login">
                                <h2 class="form-login-title text-center">Login</h2>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                        <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                                @if(session('thongbao'))
                                <div class="alert alert-danger">
                                    <p>{{ session('thongbao') }}</p>
                                </div>
                                @endif
                                <form class="form" method="POST">
                                    <input class="form-control" placeholder="User Name" name="username" type="text" autofocus="">
                                    <input class="form-control" id="password" placeholder="Password" name="password" type="password" value="">
                                    <div class="checkbox">
                                        <label>
                                            <input name="show-password" type="checkbox" onclick="showPassword()"> Show Password
                                        </label>
                                    </div>
                                    <button class="btn btn-lg btn-block btn-primary" type="submit">Login</button>
                                    {{ 	csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="source_page/js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="source_page/js/bootstrap.js"></script>
    
    <script>
        function showPassword(){
            var s = document.getElementById('password');
            if(s.type === "password"){
                s.type = "text";
            } else{
                s.type = "password";
            }
        }
    </script>
</body>
</html>

