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
            <div><h1>freecodecamp</h1></div>
            <div class="d-flex">
                <div class="px-1"><strong>533</strong> posts</div>
                <div class="px-5"><strong>132K</strong> followers</div>
                <div class="px-3"><strong>386</strong> following</div>
            </div>
            <div class="pt-4" style="font-weight: bold;">freeCodeCamp.org</div>
            <div>We're a global community of millions of people learning to code together.Our mission: to help people learn to code for free. We accomplish this by creating thousands of videos, articles, and interactive coding lessons - all freely available to the public. 
            <div><a href="#">www.freecodecamp.org</a></div>
            </div>
        </div>
    </div>

    <div class="row pt-5">
        <div class="col-4">
            <img src= "images/image1.jpg" alt="" class="w-100">
        </div>
        <div class="col-4">
            <img src= "images/image2.jpg" alt="" class="w-100">
        </div>
        <div class="col-4">
            <img src= "images/image3.jpg" alt="" class="w-100" style="height: 412px;">
        </div>

    </div>
</div>
@endsection
