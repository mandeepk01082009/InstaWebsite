@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('store_story') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">

                    <div class="card card-body shadow-sm mt-3">

                    <div class="row">
                        <h1>Add story</h1>
                    </div>

                    <div class="row">
                        <label for="image" class="col-md-4 col-form-label">Post Image</label>
                        <input type="file" name="image[]" id="image"
                            class="form-control-file @error('image') is-invalid @enderror" multiple>

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="row">
                        <label for="video" class="col-md-4 col-form-label">Post Video</label>
                        <input type="file" name="video" id="video"
                            class="form-control-file @error('video') is-invalid @enderror ">

                        @error('video')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary">Add Story</button>
                    </div>
                    </div>
                </div>
            </div>

        </form>


    </div>
@endsection
