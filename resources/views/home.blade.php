@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))  
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}  
                </div>
            </div>
        </div>
    </div> -->
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://cdn-images-1.medium.com/max/1200/1*VtM1PIgAXaE8zcRdT5n6qw.png" class="rounded-circle" style="max-height:150px">
        </div>
        <div class="col-9 pt-5">
            <div><h1> {{ $user->username}}</h1></div>
            <div class="d-flex">
                <div class="px-1"><strong>533</strong> posts</div>
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
        <div class="col-4">
            <img src= "https://wallpapercave.com/wp/wp5085057.jpg" alt="" class="w-100">
        </div>
        <div class="col-4">
            <img src= "https://www.wallpapertip.com/wmimgs/136-1369543_laptop-coding.jpg" alt="" class="w-100">
        </div>
        <div class="col-4">
            <img src= "https://wallpaperaccess.com/thumb/3617099.jpg" alt="" class="w-100" style="max-height:412px" >
        </div>

    </div>
</div>
@endsection