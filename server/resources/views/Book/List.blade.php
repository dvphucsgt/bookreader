@extends('master')
@section('content')

<div class="ebook-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <center class="container">
                <div class="row">
                    <div class="col-3 col-md-3"></div>
                    <form action="{{ route('book.search') }}" class="mt-5 col-md-6">
                        <div class="input-group">
                            <input type="text" value="{{ request('search') }}" name="search" class="form-control" placeholder="Search name">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i>&nbspSearch</button>
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
        <a href="{{action('BookController@create')}}" style="color:white">
            <button type="button" class="mt-5 btn btn-info">Add <i class="fa fa-plus" aria-hidden="true"></i></button>
        </a>
        <div class="table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xl">
            <table id="tblListBook" class="mt-5 table table-striped table-dark">
                <thead>
                    <th>ID</th>
                    <th>Image</th>
                    <th>
                        <a name="name" href="{{route('book.list')}}?search={{ request('search') }}&field=name&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">
                            Name
                            @if(request('sort','asc') === 'asc' && request('field')==='name')
                                <i class="fas fa-sort-alpha-down"></i>
                            @elseif(request('sort','asc') === 'desc' && request('field')==='name')
                                <i class="fas fa-sort-alpha-up"></i>
                            @endif
                        </a>
                    </th>
                    <th >
                        <a name="author" href="{{route('book.list')}}?search={{ request('search') }}&field=author&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">
                            Author
                            @if(request('sort','asc') === 'asc' && request('field')==='author')
                                <i class="fas fa-sort-alpha-down"></i>
                            @elseif(request('sort','asc') === 'desc' && request('field')==='author')
                                <i class="fas fa-sort-alpha-up"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a name="uploadBy" href="{{route('book.list')}}?search={{ request('search') }}&field=loginName&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">
                            Upload by
                            @if(request('sort','asc') === 'asc' && request('field')==='loginName')
                                <i class="fas fa-sort-alpha-down"></i>
                            @elseif(request('sort','asc') === 'desc' && request('field')==='loginName')
                                <i class="fas fa-sort-alpha-up"></i>
                            @endif
                        </a>
                    </th>
                    <th colspan="2">
                        <a name="uploadAt" href="{{route('book.list')}}?search={{ request('search') }}&field=uploadAt&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">
                            UploadAt
                            @if(request('sort','asc') === 'asc' && request('field')==='uploadAt')
                                <i class="fas fa-sort-alpha-down"></i>
                            @elseif(request('sort','asc') === 'desc' && request('field')==='uploadAt')
                                <i class="fas fa-sort-alpha-up"></i>
                            @endif
                        </a>
                    </th>
                    <th>
                        <a name="size" href="{{route('book.list')}}?search={{ request('search') }}&field=size&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">
                            Size&nbsp(MB)
                            @if(request('sort','asc') === 'asc' && request('field')==='size')
                                <i class="fas fa-sort-amount-up"></i>
                            @elseif(request('sort','asc') === 'desc' && request('field')==='size')
                                <i class="fas fa-sort-amount-down"></i>
                            @endif
                        </a>
                    </th>
                    <th colspan="2">Action</th>
                </thead>

                <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td class="js-book-id" data-url="{{ URL::signedRoute('book.delete',['id'=>$book->id]) }}">{{$book->id}}</td>
                        <td>
                            <img src="source_page/{{$book->imagePath}}" height="90px" width="75px" alt=""/>                        
                        </td>
                        <td class="js-book-name">
                            @if($book->sourcePath != NULL)
                                <a style="text-decoration: none" href="admin/book/{{$book->sourcePath}}" download="{{$book->sourcePath}}" data-toggle="tooltip" data-placement="right" title="Download now.!!">
                                    {{$book->name}}
                                </a>
                            @else
                                <a style="text-decoration: none; color: red;" href="admin/book/{{$book->sourcePath}}" data-toggle="tooltip" data-placement="right" title="File not found.!">
                                    {{$book->name}}
                                </a>
                            @endif   
                        </td>
                        <td>{{$book->author}}</td>
                        <td>{{$book->loginName}}</td>
                        <td>{{date('H:i:sa',strtotime($book->uploadAt))}}</td>
                        <td>{{date('Y:m:d',strtotime($book->uploadAt))}}</td>
                        @if($book->size==null)
                            <td>0</td>
                        @else
                            <td>{{$book->size}}</td>
                        @endif
                        <td>
                            <a class="edit btn btn-info" style="color: white" href="{{URL::signedRoute('book.edit',['id'=>$book->id])}}">
                                Edit <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <button data-toggle="modal" data-target="#noticDelete" class="btn btn-danger js-btn-delete">
                                    Delete <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>                
                    @endforeach              
                </tbody>
            </table>
        </div>
        
        @include('Book.delete')
        <div class="pagination justify-content-center">
            {{ $links }}
        </div>
    </div>  
</div>
</div>
@endsection()

@section('script')
<script>
    $(document).ready(function () {
        $('.js-btn-delete').on('click', function() {
            var urlDelete = $(this).closest('tr').find('.js-book-id').data('url');
            var bookName = $(this).closest('tr').find('.js-book-name').html();
            $('#js-book-name').html(bookName);
            $('#js-goto-delete').attr('href', urlDelete);
        });
        $('[data-toggle="tooltip"]').tooltip(); 
    });

</script>
@endsection


