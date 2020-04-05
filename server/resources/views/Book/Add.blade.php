@extends('master')
@section('content')

<br>
<br>
<div class="container">        
    <div class="row">
        <div class="col-12">   
            <div class="container">
                <div class="form">                    
                    @if(Session::has('complete'))
                        <div class="alert alert-success">
                            {{Session::get('complete')}}
                        </div>                    
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-danger">
                            {{Session::get('error')}}
                        </div>
                    @endif
                    <h1 class="mt-5">Add</h1>
                    <form action="{{URL::signedRoute('book.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group">
                        <label class="col-3 col-md-5">Name <span class="request-input">*</span></label>
                        <input type="text" name="name" size="40" value="{{old('name')}}"/>
                        <label class="col-3 col-md-5"></label>
                        <span class="error-notice col-9 col-md-7">{{ $errors->first('name') }}</span>
                    </div>
                        
                    <div class="form-group">
                        <label class="col-3 col-md-5">Author <span class="request-input">*</span></label>
                        <input type="text" name="author" size="40" value="{{old('author')}}"/>
                        <label class="col-3 col-md-5"></label>
                        <span class="error-notice col-9 col-md-7">{{ $errors->first('author') }}</span>
                    </div>                   
                    <div class="form-group">
                        <label class="col-3 col-md-5">Image:</label>
                        <input type="file" name="image" size="40" value="{{old('image')}}"/>
                        <label class="col-5"></label>
                        <span class="error-notice col-9 col-md-7">{{ $errors->first('image') }}</span>
                    </div>                    
                    <div class="form-group">
                        <label class="col-3 col-md-5">Upload book:</label>
                        <input type="file" name="book" size="40" value="{{old('book')}}"/>
                        <label class="col-5"></label>
                        <span class="error-notice col-9 col-md-7">{{ $errors->first('book') }}</span>
                    </div>                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            Add
                            <i class="fa fa-upload" aria-hidden="true"></i>
                        </button>
                        <a href="{{action('BookController@index')}}" style="color:white;">
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
</div>

@endsection()
