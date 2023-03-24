@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
             <div class="col-8 offset-2">

                <div class="row">
                    <h1>Add New Post</h1>
                </div>
                   <div class="form-group row">
                            <label for="caption" class="col-md-4 col-form-label ">Post Caption</label>   

                                <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption" autofocus>

                                @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        

                        <div class="row">
                            <label for="image" class="col-md-4 col-form-label ">Post Image</label>
                            <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror ">

                            @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror   
                            
                        </div>

                        <div class="row">
                            <label for="video" class="col-md-4 col-form-label ">Post Video</label>
                            <input type="file" name="video" id="video" class="form-control-file @error('video') is-invalid @enderror ">

                            @error('video')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror 
                            
                        </div>


                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary"> Add Post</button>
                        </div>
                </div>
            </div>    

    </form>

    
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
@endsection
