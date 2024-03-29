@extends('layouts.app')

@section('content')
<div class="container">
     <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PATCH')  
        <div class="row"> 
        <div>
                    <a href="/profile/{{ $user->id }}" class="btn btn-light" style="float: right; color: black; font: bold;">Back to Profile</a>
                </div> 
             <div class="col-8 offset-2">


                <div class="row">
                    <h1>Edit Profile</h1>
                </div>
                   <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label ">Title</label>

                                <input type= "text" id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}"  autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                    </div>

                    <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label ">Description</label>

                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description"   autocomplete="description" autofocus>{{ old('description') ?? $user->profile->description }} </textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                    </div>


                    <div class="form-group row">
                            <label for="url" class="col-md-4 col-form-label ">URL</label>

                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url }}"  autocomplete="url" autofocus>

                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                    </div>



                        <div class="row">
                            <label for="image" class="col-md-4 col-form-label ">Profile Image</label>
                            <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror ">

                            @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary">Save Profile</button>
                        </div>
                </div>
            </div>    

    </form>
</div>
@endsection
