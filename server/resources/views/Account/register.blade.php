@extends('master')

@section('content')
<div class="clearfix"></div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="notice-output">

                @if(Session::has('complete'))
                    <div class="alert alert-success">{{Session::get('complete')}}</div>
                @endif
            </div>
            <div class="container">

                <h1 id="register-title" class="mt-5 col-3 col-md-5 col-lg-5">Register</h1>
                <form class="form" method="post" action="{{ URL::signedRoute('account.store') }}" enctype="multipart/form-data">                  
                     @csrf

                    <div class="form-group">
                        <label class="col-3 col-md-5">Username <span class="request-input">*</span></label>
                        <input type="text" name="user_name" size="40" value="{{old('user_name')}}">
                        <label class="col-3 col-md-5"></label>
                        <span class="notice-error col-md-7 col-9">{{$errors->first('user_name')}}</span>
                    </div>

                    <div class="form-group">
                        <label class="col-3 col-md-5">Password <span class="request-input">*</span></label>
                        <input type="password" name="pass_word" size="40" placeholder="Your password" >
                        <label class="col-3 col-md-5"></label>
                        <span class="notice-error col-md-7 col-9">{{$errors->first('pass_word')}}</span>
                    </div>

                    <div class="form-group">
                        <label class="col-3 col-md-5">Confirm Password <span class="request-input">*</span></label>
                        <input type="password" name="re_password" size="40" >
                        <label class="col-3 col-md-5"></label>
                        <span class="notice-error col-md-7 col-9">{{$errors->first('re_password')}}</span>
                    </div>

                    <div class="form-group">
                        <label class="col-3 col-md-5">First Name</label>
                        <input type="text" name="first_name" size="40" placeholder="Elizabeth" value="{{old('first_name')}}">
                        <label class="col-3 col-md-5"></label>
                        <span class="notice-error col-md-7 col-9">{{$errors->first('first_name')}}</span>
                    </div>

                    <div class="form-group">
                        <label class="col-3 col-md-5">Last Name</label>
                        <input type="text" name="last_name" size="40" class="input" placeholder="Holmes" value="{{old('last_name')}}">
                        <label class="col-3 col-md-5"></label>
                        <span class="notice-error col-md-7 col-9">{{$errors->first('last_name')}}</span>
                    </div>

                    <div class="form-group">
                        <label class="col-3 col-md-5">Email <span class="request-input">*</span></label>
                        <input type="text" name="email" size="40" placeholder="abc.xyz@gmail.com or whoami@iuh.edu.vn" value="{{ old('email') }}">
                        <label class="col-3 col-md-5"></label>
                        <span class="notice-error col-md-7 col-9">{{$errors->first('email')}}</span>
                    </div>

                    <div class="form-group">
                        <label class="col-3 col-md-5" >Phone</label>
                        <input type="text" name="phone" size="40" placeholder="0XX-XXX-XXXX" value="{{old('phone')}}">
                        <label class="col-3 col-md-5"></label>
                        <span class="notice-error col-md-7 col-9">{{$errors->first('phone')}}</span>
                    </div>
                    <button type="submit" class="btn btn-success">
                        Submit 
                        <i class="fa fa-upload" aria-hidden="true"></i>
                    </button>
                    <a href="{{route('account.list')}}" style="color:white">
                        <button type="button" class="back btn btn-info">
                            Back
                            <i class="fa fa-undo" aria-hidden="true"></i>
                        </button>
                    </a>
                    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
