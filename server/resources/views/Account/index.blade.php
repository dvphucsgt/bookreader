@extends('master')

@section('content')

<div class="Account-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <center class="container">
                <div class="row">
                    <div class="col-3 col-md-3"></div>
                    <form action="{{route('account.search')}}" class="mt-5 col-md-6">
                        <div class="input-group">
                            <input type="text" value="{{ request('search') }}" name="search" class="form-control searchFont" placeholder="Search name, user name">
                            <button type="submit" class="btn btn-info searchFont"><i class="fa fa-search" aria-hidden="true"></i>&nbspSearch</button>
                        </div>
                        <input type="hidden" value="{{ request('field') }}" name="field"/>
                        <input type="hidden" value="{{ request('sort') }}" name="sort"/>
                    </form>
                    <div class="col-3 col-md-3"></div>
                </div>
            </center>
        </div>
    </div>
    <div class="container-fluid" style="width: 90%">
        <a href="{{action('AccountController@create')}}" style="color:white">
            <button type="button" class="mt-5 btn btn-info">Add <i class="fas fa-user-plus"></i></button>
        </a>

        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
            <table id="tblAccount" class="mt-5 table table-striped table-dark">
                <thead>
                    <th>ID</th>
                    <th>
                        <a name="firstName" href="{{action('AccountController@index')}}?search={{ request('search') }}&field=firstName&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">
                            Name
                            @if(request('sort','asc') === 'asc' && request('field')==='firstName')
                                <i class="fas fa-sort-alpha-down"></i>
                            @elseif(request('sort','asc') === 'desc' && request('field')==='firstName')
                                <i class="fas fa-sort-alpha-up"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a name="loginName" href="{{action('AccountController@index')}}?search={{ request('search') }}&field=loginName&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">
                            Username
                            @if(request('sort','asc') === 'asc' && request('field')==='loginName')
                                <i class="fas fa-sort-alpha-down"></i>
                            @elseif(request('sort','asc') === 'desc' && request('field')==='loginName')
                                <i class="fas fa-sort-alpha-up"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a name="email" href="{{action('AccountController@index')}}?search={{ request('search') }}&field=email&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">
                            Email
                            @if(request('sort','asc') === 'asc' && request('field')==='email')
                                <i class="fas fa-sort-alpha-down"></i>
                            @elseif(request('sort','asc') === 'desc' && request('field')==='email')
                                <i class="fas fa-sort-alpha-up"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a name="phone" href="{{action('AccountController@index')}}?search={{ request('search') }}&field=phone&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">
                            Phone
                            @if(request('sort','asc') === 'asc' && request('field')==='phone')
                                <i class="fas fa-sort-amount-up"></i>
                            @elseif(request('sort','asc') === 'desc' && request('field')==='phone')
                                <i class="fas fa-sort-amount-down"></i>
                            @endif
                        </a>
                    </th>
                    <th colspan="2">Action</th>
                </thead>
                <tbody>
                    @foreach($accounts as $account)
                        <tr>
                            <td class="js-account-id" data-url="{{ URL::signedRoute('account.delete',['id'=>$account->id]) }}">{{$account->id}}</td>
                            <td>{{$account->lastName}} {{$account->firstName}}</td>
                            <td class="js-account-login-name">{{$account->loginName}}</td>
                            <td>{{$account->email}}</td>
                            <td>{{$account->phone}}</td>
                            <td>
                                <a class="btn btn-info" href="{{ URL::signedRoute('account.edit',['id'=>$account->id]) }}">
                                    Edit <i class="fas fa-user-edit"></i>
                                </a>
                            </td>
                            <td>
                                <button data-toggle="modal" data-target="#noticDelete" class="btn btn-danger js-btn-delete">
                                    Delete <i class="fas fa-user-minus"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @include('Account.delete')
        <div class="pagination justify-content-center">
            {{ $links }}
        </div>
        
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('.js-btn-delete').on('click', function() {
            var urlDelete = $(this).closest('tr').find('.js-account-id').data('url');
            var accountLoginName = $(this).closest('tr').find('.js-account-login-name').html();
            $('#js-account-name').html(accountLoginName);
            $('#js-goto-delete').attr('href', urlDelete);
        });
    });
</script>
@endsection
