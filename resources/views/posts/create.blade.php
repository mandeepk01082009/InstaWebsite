@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/p" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">

                    <div class="card card-body shadow-sm mt-3">

                        <div class="row">
                            <h1>Add New Post</h1>

                            {{-- @if (Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                    @php
                                        Session::forget('success');
                                    @endphp
                                </div>
                            @endif
                        </div> --}}

                        {{-- <div class="form-group row">
                            <input type="hidden" name="user_id" id="user_id" class="form-control">

                            @if ($errors->has('user_id'))
                                <span class="text-danger">{{ $errors->first('user_id') }}</span>
                            @endif

                        </div> --}}    

                        <div class="form-group row">    
                            


                            <label for="caption">Post Caption</label>


                            <textarea id="caption" type="text" class="form-control" rows="4" name="caption" autocomplete="caption" autofocus>{{ old('caption') }} </textarea>

                            @if ($errors->has('caption'))
                                <span class="text-danger">{{ $errors->first('caption') }}</span>
                            @endif

                        </div>



                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label">Post Image</label>
                            <input type="file" name="image[]" class="form-control" multiple="multiple">

                            @if ($errors->has('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif

                        </div>

                        <div class="form-group row">
                            <label for="video" class="col-md-4 col-form-label">Post Video</label>
                            <input type="file" name="video" id="video" class="form-control">

                            @if ($errors->has('video'))
                                <span class="text-danger">{{ $errors->first('video') }}</span>
                            @endif

                        </div>

                        <h3 class="mt-3">Status</h3>
                        <div class="form-group row">
                            <div class="mb-3">
                                <label for="status">Status</label>
                                <input type="checkbox" name="status">
                            </div>

                        </div>

                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary"> Add Post</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>


        
    </div>
@endsection
