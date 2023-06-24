@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="/storage/{{ $user->profile->image }}" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">    
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h4"> {{ $user->username}}</div>
                    <!-- <button class="btn btn-primary ms-4">Follow</button> -->
                    @if(auth()->user()->id !== $user->id)                
                    <!-- <a href="#" class="btn btn-primary ms-4" >Follow</a> -->
                        @if($user->followers->contains(auth()->user()->id))
                            <a href="{{route('follow', $user->id)}}"  class="btn btn-danger ms-4" >
                                Unfollow   
                            </a>   
                        @else
                            <a href="{{route('follow', $user->id)}}"  class="btn btn-primary ms-4" >
                                Follow
                            </a>
                        @endif

                    @endif
                </div>   
                
                 @can ('update', $user->profile)
                <a href="/p/create">Add New Post</a>
                @endcan    
            </div>

                @can ('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
                @endcan

            <div class="d-flex">
                <div class="px-1"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="px-5"><strong>{{ $user->followers()->count() }}</strong> followers</div>
                <div class="px-3"><strong>{{ $user->followings()->count() }}</strong> following</div>
            </div>
            <div class="pt-4"><b>{{ $user->profile->title }}</b></div>
            <div>{{ $user->profile->description }}
            <div><a href="#">{{ $user->profile->url }}</a></div>   
            </div>
        </div>
    </div>

    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
                @php
                $images = (json_decode($post->image) ?? []);               
            @endphp 
            @if($images)  
            <div class="slider">
                @foreach ($images as $file)
                    <div class="banner">
                        <img src="{{ asset('storage/' . $file) }}" class="w-100"
                            style="max-width:400; height:400px;">
                    </div>
                @endforeach

            </div>                               

            {{-- @foreach ($images as $file )                               
                
           
            <img src="{{ asset('storage/' .$file) }}" class="w-100"
            style="max-width:400; height:400px;">
            @endforeach --}}  
            @else
            <img src="{{ asset('storage/' . $post->image) }}" class="w-100"
                style="max-width:400; height:400px;">
            @endif
        </div>
        @endforeach

    </div>
    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{$post->id}}">
                <video controls src = "{{asset('storage/' . $post->video) }}" class="w-100" style="max-width:400; height:500px;" ></video>  
            </a>
        </div>
        @endforeach

    </div>
</div>
@endsection

@section('scipts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"
        integrity="sha512-WNZwVebQjhSxEzwbettGuQgWxbpYdoLf7mH+25A7sfQbbxKeS5SQ9QBf97zOY4nOlwtksgDA/czSTmfj4DUEiQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.slider').slick({
                dots: false,
                infinite: false,
                cssEase: 'linear',
                arrow: true,
            })
        });
    </script>
@endsection
