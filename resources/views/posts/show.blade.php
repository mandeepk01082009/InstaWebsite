@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <img src="/storage/{{ $post->image }}" alt="" class="img-fluid" style="max-width:550px; height:500px;">
            <hr>
            <video controls src="/storage/{{ $post->video }}" alt=""  style="max-width:550px; height:500px;"></video>
        </div>
        <div class="col-6">
            <div>
                <div class="d-flex align-items-center">
                    <div class="px-3">
                        <img src="/storage/{{ $post->user->profile->image }}" class="rounded-circle w-100" style="max-width: 40px;">
                    </div>
                    <div>   
                        <div>
                            <b>
                                <a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span>
                                </a>
                            </b> |
                           
                            <!-- <a href="#" class="px-3">Follow</a> -->
                            <a href="/editpost/{{$post->id }}" class="px-3"><span class="btn btn-success">Edit Post</span></a>
                            
                            <a href="/deletepost/{{$post->id }}" class="px-3"><span class="btn btn-success">Delete Post</span></a>
                        </div>
                    </div>
                </div>
                <hr>

                <p>
                    <span> 
                        <b>
                            <a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                        </b>
                    </span>
                    {{ $post->caption}}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
