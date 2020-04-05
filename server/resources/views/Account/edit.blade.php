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
                
                <h1 id="register-title" class="col-3 col-md-7 col-lg-7 mt-5">Update Account</h1>
                <form class="form" method="POST" action="{{ action('AccountController@update',$id) }}" enctype="multipart/form-data">                  
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label class="col-3 col-md-5">Username <span class="request-input">*</span></label>
                        <input type="text" name="user_name" size="40" value="{{$account->loginName}}" disabled="disabled">
                        <label class="col-3 col-md-5"></label>
                    </div>
                     
                     <div class="form-group">
                        <label class="col-3 col-md-5">Password <span class="request-input">*</span></label>
                        <input type="password" name="password_new" size="40">
                        <label class="col-3 col-md-5"></label>
                        <span class="notice-error col-md-7 col-9">{{$errors->first('password_new')}}</span>
                    </div>

                    <div class="form-group">
                        <label class="col-3 col-md-5">First Name</label>
                        <input type="text" name="first_name" size="40" value="{{old('first_name',optional($account)->firstName)}}">
                        <label class="col-3 col-md-5"></label>
                        <span class="notice-error col-md-7 col-9">{{$errors->first('first_name')}}</span>
                    </div>

                    <div class="form-group">
                        <label class="col-3 col-md-5">Last Name</label>
                        <input type="text" name="last_name" size="40" class="input" value="{{old('last_name',optional($account)->lastName)}}">
                        <label class="col-3 col-md-5"></label>
                        <span class="notice-error col-md-7 col-9">{{$errors->first('last_name')}}</span>
                    </div>

                    <div class="form-group">
                        <label class="col-3 col-md-5">Email <span class="request-input">*</span></label>
                        <input type="text" name="email" size="40" value="{{old('email',optional($account)->email)}}">
                        <label class="col-3 col-md-5"></label>
                        <span class="notice-error col-md-7 col-9">{{$errors->first('email')}}</span>
                    </div>

                    <div class="form-group">
                        <label class="col-3 col-md-5" >Phone</label>
                        <input type="text" name="phone" size="40" value="{{old('phone',optional($account)->phone)}}" placeholder="0XX-XXX-XXX">
                        <label class="col-3 col-md-5"></label>
                        <span class="notice-error col-md-7 col-9">{{$errors->first('phone')}}</span>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            Changes
                            <i class="fas fa-exchange-alt"></i>
                        </button>
                        <a href="{{ URL::signedRoute('account.list') }}" style="color:white;">
                            <button type="button" class="back btn btn-info">
                                Back
                                <i class="fa fa-undo" aria-hidden="true"></i>
                            </button>
                        </a>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

@endsection
