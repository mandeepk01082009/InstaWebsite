<!DOCTYPE html>
<html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{asset('js/like.js')}}"></script>
    <script src="{{asset('css/style.css')}}"></script>
    <title>Home</title>
</head>
<body class="bg-light">
<div class="container">
        <div class="row py-5" style="width: 100%;">
            <div class="col-2" style="position: fixed; border-right: 1px solid black;" >
                <div class="nav">
                    <img src="{{asset('images/Instagram_logo.png')}}"  class="w-100" style="max-height:100px; max-width:120px">
                    <ul style="list-style: none;" class="px-1">
                        <li class="nav-item px-1">
                          <a class="nav-link active" href="#" style="color:black; font-size: 18px; font-weight: bold;">
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
                          <a class="nav-link" href="#" style="color:black; font-size: 18px;">
                         <img src="/storage/{{ $user->profile->image }}" class="rounded-circle w-100" style="max-width: 30px;"> 
                         <span class="px-1">Profile</span></a>
                       </li>
                    </ul>
            </div>
        </div>
        <div class="col-1 p-3" style="position: relative; margin-left:100px;"></div>
        <div class="col-5 p-3" style="position: relative; margin-left:100px;">
                        <div class="card">
                      <div class="row pt-2">
                    
                    @foreach($user->posts as $post)
                    <div class="px-3">
                        <img src="/storage/{{ $post->user->profile->image }}" class="rounded-circle w-100" style="max-width: 40px;"> 
                    <span> 
                        <b>
                            <a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                        </b>
                    </span>
                    {{ $post->caption}}
                
                    </div>
                   <div class="pt-2">
                        <div class="col-12 pb-4">
                        <a href="/p/{{$post->id}}">
                            <img src = "{{asset('storage/' . $post->image) }}" class="w-100" style="max-width:400; height:400px;"> 
                        </a>
                        <div class="mt-2 px-2">
                            {{ $post->like()->where(['like' => '1'])->count() }}
                           <a href="#" class="like">{{ Auth::user()->like()->where('post_id', $post->id)->first() ? Auth::user()->like()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like' }}</a> |
                           {{ $post->like()->where(['like' => '0'])->count() }}
                           <a href="#" class="like">{{ Auth::user()->like()->where('post_id', $post->id)->first() ? Auth::user()->like()->where('post_id', $post->id)->first()->like == 0 ? 'You dont like this post' : 'Dislike' : 'Dislike' }}</a>

                       </div> 
                 <div class="comment-area p-2 mt-4">

                @if(session('message'))
                <h6 class="alert alert-warning mb-3">{{ session('message') }}</h6>
                @endif
              <div class="card card-body ">
                  <h6 class="card-title">Leave a comment</h6>
                  <form action="{{ url('comments')}}" method="POST">
                    @csrf
                      <input type="hidden" name="post_slug" value="{{$post->slug}}">
                      <textarea name="comment_body" class="form-control" rows="3" required></textarea>
                      <button type="submit" class="btn btn-primary mt-3">Submit</button>
                  </form>
              </div>


              @forelse($post->comments as $comment)
              <div class="comment-container card card-body shadow-sm mt-2">
                  <div class="detail-area">
                      <h6 class="user-name mb-1">
                          @if ($comment->user)
                              {{$comment->user->name}}
                          @endif  
                          <small class="ms-3 text-primary">Commented on: {{ $comment->created_at->format('d-m-Y') }}</small>
                      </h6>
                      <p class="user-comment mb-1">
                          {{!! $comment->comment_body !!}}
                          
                      </p>
                  </div>
                  @if(Auth::check() && Auth::id() == $comment->user_id)
                  <div>
                      <a href="/delete-comment/{{$comment->id }}" class="btn btn-success"><span class="text-dark">Delete Comment</span></a>
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
                
                </div>
                <div class="row">
                    @foreach($user->posts as $post)
                    <div class="px-3">
                        <img src="/storage/{{ $post->user->profile->image }}" class="rounded-circle w-100" style="max-width: 40px;"> 
                    <span> 
                        <b>
                            <a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                        </b>
                    </span>
                    {{ $post->caption}}
                
                    </div>
                        <div class="pt-2">
                        <div class="col-12 pb-4">
                        <a href="/p/{{$post->id}}">
                            <video controls src = "{{asset('storage/' . $post->video) }}" class="w-100" style="max-width:400; max-height:400px;" ></video> 
                        </a>
                        <div class="mt-2 px-2">
                            {{ $post->like()->where(['like' => '1'])->count() }}
                           <a href="#" class="like">{{ Auth::user()->like()->where('post_id', $post->id)->first() ? Auth::user()->like()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like' }}</a> |
                           {{ $post->like()->where(['like' => '0'])->count() }}
                           <a href="#" class="like">{{ Auth::user()->like()->where('post_id', $post->id)->first() ? Auth::user()->like()->where('post_id', $post->id)->first()->like == 0 ? 'You dont like this post' : 'Dislike' : 'Dislike' }}</a>

                       </div> 
                 <div class="comment-area p-2 mt-4">

                @if(session('message'))
                <h6 class="alert alert-warning mb-3">{{ session('message') }}</h6>
                @endif
              <div class="card card-body">
                  <h6 class="card-title">Leave a comment</h6>
                  <form action="{{ url('comments')}}" method="POST">
                    @csrf
                      <input type="hidden" name="post_slug" value="{{$post->slug}}">
                      <textarea name="comment_body" class="form-control" rows="3" required></textarea>
                      <button type="submit" class="btn btn-primary mt-3">Submit</button>
                  </form>
              </div>


              @forelse($post->comments as $comment)
              <div class="comment-container card card-body shadow-sm mt-2">
                  <div class="detail-area">
                      <h6 class="user-name mb-1">
                          @if ($comment->user)
                              {{$comment->user->name}}
                          @endif  
                          <small class="ms-3 text-primary">Commented on: {{ $comment->created_at->format('d-m-Y') }}</small>
                      </h6>
                      <p class="user-comment mb-1">
                          {{!! $comment->comment_body !!}}
                          
                      </p>
                  </div>
                  @if(Auth::check() && Auth::id() == $comment->user_id)
                  <div>
                      <a href="/delete-comment/{{$comment->id }}" class="btn btn-success"><span class="text-dark">Delete Comment</span></a>
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
    </div>
            </div>
        </div>
        <div class="col-4 mt-2">
            <div>
                <img src="/storage/{{ $user->profile->image }}" class="rounded-circle w-100" style="max-width: 30px;">
            </div>
            
        </div>
        </div>
    
</div>
<script type="text/javascript">
    var token = '{{ Session::token() }}';
    var urlLike = '{{ route('like')}}';
</script>
</body>
</html>

