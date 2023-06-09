<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('js/like.js') }}"></script>
    <script src="{{ asset('js/comment.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
    <title>Home</title>
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row" style="width: 100%;">
            <div class="col-2 bg-white py-5"
                style="position: fixed; border-right: 1px solid lightgray; padding-top: 50;">
                <div class="nav py-5">
                    <img src="{{ asset('images/Instagram_logo.png') }}" class="w-100"
                        style="max-height:100px; max-width:120px">
                    <ul style="list-style: none;" class="px-1 py-5">
                        <li class="nav-item px-1">
                            <a class="nav-link active" href="/home"
                                style="color:black; font-size: 18px; font-weight: bold;">
                                <i class="fa fa-home" aria-hidden="true" style="font-size:28px"></i>
                                <span class="px-1">Home</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color:black; font-size: 18px;">
                                <i class="fa fa-search" aria-hidden="true"style="font-size:28px"></i>
                                <span class="px-1">Search</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color:black; font-size: 18px;">
                                <i class="fa fa-safari" aria-hidden="true"style="font-size:28px"></i>
                                <span class="px-1">Explore</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color:black; font-size: 18px;">
                                <i class="fa fa-youtube-play" aria-hidden="true"style="font-size:28px"></i>
                                <span>Reels</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color:black; font-size: 18px;">
                                <i class="fa fa-telegram" aria-hidden="true"style="font-size:28px"></i>
                                <span class="px-1">Messages</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color:black; font-size: 18px;">
                                <i class="fa fa-heart" aria-hidden="true"style="font-size:28px"></i>
                                <span>Notifications</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="color:black; font-size: 18px;">
                                <i class="fa fa-plus-square-o" aria-hidden="true"style="font-size:28px"></i>
                                <span class="px-1">Create</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile/{{ $user->id }}"
                                style="color:black; font-size: 18px;">
                                <img src="/storage/{{ $user->profile->image }}" class="rounded-circle w-100"
                                    style="max-width: 30px;">
                                <span class="px-1">Profile</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-1 p-3" style="position: relative; margin-left:100px;"></div>
            <div class="col-5 p-3" style="position: relative; margin-left:100px;">

                {{-- <div class="story-container">
                    <button class="btn left-btn hide">
                    <img src="images/arrow.png">
                    </button>
                    <div class="carousel-container">
                        <ul class="carousel">
                            <li class="slide">
                                <div class="story-status">
                                    <img src="images/profile.jpg" alt="" class="story">
                                    <p>Your Story</p>
                                </div>
                                <div class="story-status">
                                    <img src="images/profile.jpg" alt="" class="has-story"> 
                                    <p>John Doe</p>  
                                </div>
                                <div class="story-status">
                                    <img src="images/profile.jpg" alt="" class="has-story">
                                    <p>Perry</p>
                                </div>
                                <div class="story-status">
                                    <img src="images/profile.jpg" alt="" class="has-story">
                                    <p>Coder</p>
                                </div>
                                <div class="story-status">
                                    <img src="images/profile.jpg" alt="" class="has-story">
                                    <p>Harry</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <button class="btn right-btn">
                        <img src="images/right-arrow.png">    
                    </button>
                </div> --}}


                <div class="status-container mt-4">
                    <div class="horizontal-scroll">
                        <button class="btn-scroll" id="btn-scroll-left" onclick="scrollHorizontally(1)"><i
                                class="fa fa-chevron-left" aria-hidden="true"></i></button>
                        <button class="btn-scroll" id="btn-scroll-right" onclick="scrollHorizontally(-1)"><i
                                class="fa fa-chevron-right" aria-hidden="true"></i></i></button>
                        <div class="story-container">
                            <div class="stories-img color">
                                <img src="/storage/{{ $user->profile->image }}" alt="">
                                <div class="add">
                                    <a href="{{ route('create_story') }}"><i class="fa fa-plus" aria-hidden="true"
                                            style="color:white;"></i></a>
                                </div>
                            </div>
                            @foreach ($stories as $story)
                                <div class="story-circle">
                                    {{-- <a target="_blank" href="{{ asset('storage/' . $story->image) }}"> --}}
                                    <img href="#staticBackdrop" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop"
                                        src="{{ asset('storage/' . $story->image) }}" class="modal_img">

                                    {{-- <img src="{{ asset('storage/' . $story->image) }}" class="story"
                                        alt=""> --}}
                                    {{-- </a> --}}
                                </div>
                            @endforeach




                            {{-- <div class="story-circle">
                                <img src="images/profile.jpg" alt="">    
                            </div>
                            <div class="story-circle">
                                <img src="images/profile.jpg" alt="">
                            </div>
                            <div class="story-circle">
                                <img src="images/profile.jpg" alt="">
                            </div>
                            <div class="story-circle">
                                <img src="images/profile.jpg" alt="">
                            </div>
                            <div class="story-circle">
                                <img src="images/profile.jpg" alt="">
                            </div>
                            <div class="story-circle">
                                <img src="images/profile.jpg" alt="">
                            </div>
                            <div class="story-circle">
                                <img src="images/profile.jpg" alt="">
                            </div>
                            <div class="story-circle">
                                <img src="images/profile.jpg" alt="">
                            </div>
                            <div class="story-circle">
                                <img src="images/profile.jpg" alt="">
                            </div> --}}
                        </div>
                    </div>

                </div>

                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                {{-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> --}}
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="gallery-modal"> <img class="modal-content" id="img01">
                                </div>

                            </div>
                            {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Understood</button>
        </div> --}}
                        </div>
                    </div>
                </div>


                <div class="card mx-5 mt-5 post">

                    <div class="mt-2">
                        @if ($posts->count() > 0)
                            @foreach ($posts->all() as $post)
                                <div class="px-3">
                                    <img src="/storage/{{ $user->profile->image }}" class="rounded-circle w-100"
                                        style="max-width: 40px;">
                                    <span class="px-2">
                                        <b>
                                            <a href="/profile/{{ $post->user->id }}"><span
                                                    class="text-dark">{{ $post->user->username }}</span>
                                            </a>
                                        </b>
                                    </span>
                                    {{ $post->caption }}

                                </div>
                                <div class="pt-2" data-post="{{ $post->id }}">
                                    <div class="col-12 pb-4">
                                        <a href="/p/{{ $post->id }}">
                                            @php
                                                $images = json_decode($post->image) ?? [] ;
                                                print_r($images);
                                                // $images = explode(',' , $post->image);
                                            @endphp

                                            @foreach ($images as $img)
                                                <img style="max-width:400; height:400px;" class="w-100"
                                                    src="{{ asset('/storage/' . $img) }}">
                                            @endforeach

                                            {{-- <img src="{{ asset('storage/' . $post->image) }}" class="w-100"
                                                style="max-width:400; height:400px;"> --}}
                                        </a>
                                        <div class="mt-2 px-3">

                                            {{ $post->like()->where(['like' => '1'])->count() }}
                                            <a href="#" class="like">
                                                @if (Auth::user()->like()->where('post_id', $post->id)->first())
                                                    &#9829;
                                                    <!-- <img src="{{ asset('images/logo.png') }}" class="w-100" style="max-height:30px; max-width:30px" /> -->
                                                @elseif (
                                                    !empty(Auth::user()) &&
                                                        Auth::user()->like()->where('post_id', $post->id)->first() != 1)
                                                    &#9825;
                                                    <!--  <img src="{{ asset('images/R.jpeg') }}" class="w-100" style="max-height:30px; max-width:30px"/>  -->
                                                @endif
                                            </a>
                                            <!-- <a href="#" class="like">{{ Auth::user()->like()->where('post_id', $post->id)->first()? (Auth::user()->like()->where('post_id', $post->id)->first()->like == 1? 'You like this post': 'Like'): 'Like' }}</a>  -->
                                        </div>
                                        <div class="comment-area mt-4 px-3" id="comment-area" data-post="$uniqid">

                                            @if (session('message'))
                                                <h6 class="alert alert-warning mb-3">{{ session('message') }}</h6>
                                            @endif
                                            <div class="card card-body">
                                                <h6 class="card-title">Leave a comment</h6>
                                                <form action="{{ url('comments') }}" method="POST"
                                                    class="form_class" id="serializeForm"
                                                    data-post="{{ $post->id }}">
                                                    @csrf
                                                    <input type="hidden" name="post_slug"
                                                        value="{{ $post->slug }}">
                                                    <input type="hidden" name="uniqid"
                                                        value="{{ $post->uniqid }}">
                                                    <input type="hidden" name="post_id" value="{{ $post->id }}"
                                                        id="post_id">
                                                    <input type="hidden" name="user_id"
                                                        value="{{ $post->user_id }}" id="user_id">
                                                    <textarea name="comment_body" class="form-control" rows="3" id="comment_body" required></textarea>
                                                    <!-- <p id="uniqueID"></p> -->
                                                    <button type="submit" name="submit"
                                                        class="btn btn-primary mt-3"
                                                        class="submitButton">Submit</button>   
                                                </form>
                                            </div>


                                            @forelse($post->comments as $comment)
                                                <div class="comment-container card card-body shadow-sm mt-3"
                                                    id="comment-container" data-post=>
                                                    <div class="detail-area">
                                                        <h6 class="user-name mb-1">
                                                            @if ($comment->user)
                                                                {{ $comment->user->name }}
                                                            @endif
                                                            <small class="ms-3 text-primary">Commented on:
                                                                {{ $comment->created_at->format('d-m-Y') }}</small>
                                                        </h6>
                                                        <p class="user-comment mb-1">
                                                            {{ $comment->comment_body }}
                                                        </p>
                                                    </div>
                                                    @if (Auth::check() && Auth::id() == $comment->user_id)
                                                        <div>
                                                            <button type="button" value="{{ $comment->id }}"
                                                                style="border:none; background: none;"
                                                                class="deleteComment"><i class="fa fa-trash"
                                                                    style="font-size:20px; color:black;"></i> </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            @empty
                                                <h6>No Comments Yet.</h6>
                                            @endforelse
                                        </div>


                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!-- ======================= video in post===============-->
                    <div class="mt-2">
                        @if ($posts->count() > 0)
                            @foreach ($posts as $post)
                                <div class="px-3">
                                    <img src="/storage/{{ $post->user->profile->image }}"
                                        class="rounded-circle w-100" style="max-width: 40px;">
                                    <span class="px-2">
                                        <b>
                                            <a href="/profile/{{ $post->user->id }}"><span
                                                    class="text-dark">{{ $post->user->username }}</span>
                                            </a>
                                        </b>
                                    </span>
                                    {{ $post->caption }}

                                </div>
                                <div class="pt-2" data-post="{{ $post->id }}">
                                    <div class="col-12 pb-4">
                                        <a href="/p/{{ $post->id }}">
                                            <video controls src="{{ asset('storage/' . $post->video) }}"
                                                class="w-100" style="max-width:400; height:400px;"> </video>
                                        </a>
                                        <div class="mt-2 px-3">

                                            {{ $post->like()->where(['like' => '1'])->count() }}
                                            <a href="#"
                                                class="like">{{ Auth::user()->like()->where('post_id', $post->id)->first()? (Auth::user()->like()->where('post_id', $post->id)->first()->like == 1? 'You like this post': 'Like'): 'Like' }}</a>
                                        </div>

                                        <div class="comment-area mt-4 px-3" id="comment-area"
                                            data-post="{{ $post->id }}">

                                            @if (session('message'))
                                                <h6 class="alert alert-warning mb-3">{{ session('message') }}</h6>
                                            @endif
                                            <div class="card card-body">
                                                <h6 class="card-title">Leave a comment</h6>
                                                <form action="{{ url('comments') }}" method="POST"
                                                    id="serializeForm" data-post="{{ $post->id }}"
                                                    class="form_class">
                                                    @csrf
                                                    <input type="hidden" name="post_slug"
                                                        value="{{ $post->slug }}">
                                                    <input type="hidden" name="uniqid"
                                                        value="{{ $post->uniqid }}">
                                                    <input type="hidden" name="post_id" value="{{ $post->id }}"
                                                        id="post_id">
                                                    <input type="hidden" name="user_id"
                                                        value="{{ $post->user_id }}" id="user_id">
                                                    <textarea name="comment_body" class="form-control" rows="3" id="comment_body" required></textarea>
                                                    <!-- <p id="uniqueID"></p> -->
                                                    <button type="submit" name="submit"
                                                        class="btn btn-primary mt-3"
                                                        class="submitButton">Submit</button>
                                                </form>
                                            </div>


                                            @forelse($post->comments as $comment)
                                                <div class="comment-container card card-body shadow-sm mt-3">
                                                    <div class="detail-area">
                                                        <h6 class="user-name mb-1">
                                                            @if ($comment->user)
                                                                {{ $comment->user->name }}
                                                            @endif
                                                            <small class="ms-3 text-primary">Commented on:
                                                                {{ $comment->created_at->format('d-m-Y') }}</small>
                                                        </h6>
                                                        <p class="user-comment mb-1">
                                                            {{ $comment->comment_body }}

                                                        </p>
                                                    </div>
                                                    @if (Auth::check() && Auth::id() == $comment->user_id)
                                                        <div>
                                                            <!-- <a href="/delete-comment/{{ $comment->id }}"><i class="fa fa-trash" style="font-size:20px; color:black;"></i> </a> -->
                                                            <button type="button" value="{{ $comment->id }}"
                                                                style="border:none; background: none;"
                                                                class="deleteComment"><i class="fa fa-trash"
                                                                    style="font-size:20px; color:black;"></i> </button>
                                                        </div>    
                                                    @endif
                                                </div>
                                            @empty
                                                <h6>No Comments Yet.</h6>
                                            @endforelse
                                        </div>



                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-3 mt-5">
                @if ($id = Auth::user()->id)
                    <div>
                        <img src="/storage/{{ $user->profile->image }}" class="rounded-circle w-100"
                            style="max-width: 70px;">
                        <span class="px-2">
                            <b>
                                <a href="/profile/{{ $user->profile->id }}"><span
                                        class="text-dark">{{ $user->profile->title }}</span>
                                </a>
                            </b>
                        </span>


                        <span class="mt-3" style="float: right">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Switch') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </span>

                    </div>
                @endif

            </div>

        </div>

    </div>
    <script type="text/javascript">
        var token = '{{ Session::token() }}';
        var urlLike = '{{ route('like') }}';
    </script>
    {{-- <script>
        let currentScrollPosition = 0;
        let scrollAmount = 320;

        const sCont = document.querySelector(".story-container");
        const hScroll = document.querySelector(".horizontal-scroll");

        let maxScroll = -sCont.offsetWidth + hScroll.offsetWidth;

        function scrollHorizontally(val){
            currentScrollPosition += (val * scrollAmount);

            sCont.style.left = currentScrollPosition + "px"; 
        }

    </script> --}}
    <script>
        let currentScrollPosition = 0;
        let scrollAmount = 320;

        const sCont = document.querySelector(".story-container");
        const hScroll = document.querySelector(".horizontal-scroll");
        const btnScrollLeft = document.querySelector("#btn-scroll-left");
        const btnScrollRight = document.querySelector("#btn-scroll-right");

        btnScrollLeft.style.opacity = "0";

        let maxScroll = -sCont.offsetWidth + hScroll.offsetWidth;

        function scrollHorizontally(val) {
            currentScrollPosition += (val * scrollAmount);

            if (currentScrollPosition >= 0) {
                currentScrollPosition = 0
                btnScrollLeft.style.opacity = "0";
            } else {
                btnScrollLeft.style.opacity = "1";
            }

            if (currentScrollPosition <= maxScroll) {
                currentScrollPosition = maxScroll;
                btnScrollRight.style.opacity = "0";
            } else {
                btnScrollRight.style.opacity = "1";
            }
            sCont.style.left = currentScrollPosition + "px";
        }
    </script>
    {{-- <script>
        // Get the modal
        var modal = document.getElementsByClassName("modal");
        console.log(modal);

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementsByClassName("story");
        var modalImg = document.getElementsByClassName("modal-content");
        var captionText = document.getElementsByClassName("caption");
        img.onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            $(".story").click(function() {
                var path = $(this).attr('src');

                $(".large-image").attr('src', path);
                $(".image_popup").fadeIn();
            })

            $(".close-btn").click(function() {
                $(".image_popup").slideUp();
            })
        })
    </script> --}}
    <script>
        $(function() {
            let modal = $('#staticBackdrop')
            $(".modal_img").on("click", function() {
                var src = $(this).attr("src");
                modal.css({
                    "display": "block"
                });
                $("#img01", modal).prop("src", src);
                console.log(src);
            })
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
