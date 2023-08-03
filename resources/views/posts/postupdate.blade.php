@extends('layouts.app')

@section('content')
<div class="container">
     <form action="/updatepost/{{$posts->id}}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">  
             <div class="col-8 offset-2">

                <div class="row">
                    <h1>Edit Post</h1>
                </div>   
                <input type="hidden" name="id" id="id" value="{{$posts->id}}">
                   <div class="form-group row">
                            <label for="caption"  class="col-md-4 col-form-label ">Caption</label>

                                <textarea id="caption" type="text" class="form-control" name="caption"  placeholder="Caption">{{ $posts->caption }}</textarea>
                    </div>   

                    
                        <div class="row">  
                            <label for="image" class="col-md-4 col-form-label custom-file-label ">Image</label>
                            <input type="file" name="image" id="image" class="custom-file-input" value="{{$posts->image}}">   
                        </div>

                        <div class="row">
                            <label for="video" class="col-md-4 col-form-label custom-file-label ">Video</label>
                            <input type="file" name="video" id="video" class="custom-file-input" value="{{$posts->video}}">
                            
                        </div>


                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary">Save Post</button>
                        </div>
                </div>
            </div>    

    </form>
</div>
@endsection
