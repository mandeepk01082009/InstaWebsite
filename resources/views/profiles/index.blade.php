@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://cdn-images-1.medium.com/max/1200/1*VtM1PIgAXaE8zcRdT5n6qw.png" class="rounded-circle" style="max-height:150px">
        </div>
        <div class="col-9 pt-5">    
            <div class="d-flex justify-content-between align-items-baseline">
                <h1> {{ $user->username}}</h1>
                
                 @can ('update', $user->profile)
                <a href="/p/create">Add New Post</a>
                @endcan   
            </div>

                @can ('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
                @endcan

            <div class="d-flex">
                <div class="px-1"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="px-5"><strong>132K</strong> followers</div>
                <div class="px-3"><strong>386</strong> following</div>
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
            <a href="/p/{{$post->id}}">
                <img src = "{{asset('storage/' . $post->image) }}" class="w-100" >  
            </a>
        </div>
        @endforeach

    </div>
</div>
@endsection
