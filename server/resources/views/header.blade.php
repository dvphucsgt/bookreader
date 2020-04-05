<header>
    <img class="col-4 col-md-3 col-lg-2 col-sm-2 col-xl-2" src="source_page/images/logo.png" alt=""/>
</header>
<nav class="navbar navbar-expand-md navbar-expand-sm navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home.index') }}">
            <img src="source_page/images/saigon-tech.png" alt="logo-saigonTech"/>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home.index') }}"><i style="font-size: 25px;" class="fa fa-home" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('book.list') }}"><i class="fa fa-book" aria-hidden="true"> EBook</i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('account.list') }}"><i class="fa fa-user-circle" aria-hidden="true"></i> Account</i></a>
                </li>
                @if(Auth::check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Xin chao: {{ Auth::user()->loginName }}
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" data-toggle="modal" data-target="#infoModal">Info <i class="fa fa-info-circle" aria-hidden="true"></i></a>
                        <a class="dropdown-item" href="{{ url('admin/logout') }}">Logout <i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" id="infoModal">
    <div class="modal-dialog">
        <div class="modal-content">

<!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Information Account</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

<!-- Modal body -->
            <div class="modal-body">
                <form class="form">
                    <div class="form-group">
                        <label>Username: </label>
                        <input type="text" name="user" class="form-control" disabled="disabled" value="{{ Auth::user()->loginName }}">
                    </div>

                  

                    <div class="form-group">
                        <label>First Name:</label>
                        <input type="text" name="first_name" disabled="disabled" class="form-control" value="{{ Auth::user()->firstName }}">
                    </div>

                    <div class="form-group">
                        <label>Last Name:</label>
                        <input type="text" name="last_name" disabled="disabled" class="form-control" value="{{ Auth::user()->lastName }}">
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="Email" name="email" disabled="disabled" class="form-control" value="{{ Auth::user()->email }}">
                    </div>

                    <div class="form-group">
                        <label>Phone:</label>
                        <input type="text" name="phone" disabled="disabled" class="form-control" value="{{ Auth::user()->phone }}">
                    </div>
                </form>
            </div>

		<!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>