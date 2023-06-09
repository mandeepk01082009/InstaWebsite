@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" data-post="{{$post->id}}">
         <div class="col-6">
            @if(session('mess'))
                <h6 class="alert alert-success mb-3">{{ session('mess') }}</h6>
                @endif

                @if(session('del'))
                <h6 class="alert alert-success mb-3">{{ session('del') }}</h6>  
                @endif 
                @php
                $images = json_decode($post->image) ?? [] ;
                print_r($images);
            @endphp

            @foreach ($images as $img)
                <img style="max-width:400; height:400px;" class="w-100"
                    src="{{ asset('/storage/' . $img) }}">
            @endforeach

            {{-- <img src="/storage/{{ $post->image }}" alt="" class="img-fluid" style="max-width:400px; height:400px;"> --}}
            <div class="mt-2">              
                {{ $post->like()->where(['like' => '1'])->count() }}
                <a href="#" class="like">
                @if(Auth::user()->like()->where('post_id', $post->id)->first())
                    ♥
               <!--  "<i class="fa fa-heart" style="max-height:20px; max-width:20px"></i>" -->
                <!-- <img src="{{asset('images/logo.png')}}" class="w-100" style="max-height:30px; max-width:30px"/> -->
                @elseif (!empty(Auth::user()) && Auth::user()->like()->where('post_id', $post->id)->first() != 1) 
                    ♡
              <!--  <img src="{{asset('images/R.jpeg')}}" class="w-100" style="max-height:30px; max-width:30px"/> -->   
                @endif 
                </a>    
                <!-- |       
                {{ $post->like()->where(['like' => '0'])->count() }}
                <a href="#" class="like">{{      Auth::user()->like()->where('post_id',   $post->id)->first() ? Auth::user()->like()->where('post_id', $post->id)->first()->like == 0 ? 'You dont like this post' : 'Dislike' : 'Dislike' }}</a> -->
            </div>
            <hr>
            <video controls src="/storage/{{ $post->video }}" alt=""  style="max-width:500px; height:400px;"></video>
            <div class="mt-2">

                {{ $post->like()->where(['like' => '1'])->count() }}
                <a href="#" class="like">{{ Auth::user()->like()->where('post_id', $post->id)->first() ? Auth::user()->like()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like' }}</a> <!-- |
                {{ $post->like()->where(['like' => '0'])->count() }}
                <a href="#" class="like">{{ Auth::user()->like()->where('post_id', $post->id)->first() ? Auth::user()->like()->where('post_id', $post->id)->first()->like == 0 ? 'You dont like this post' : 'Dislike' : 'Dislike' }}</a> -->
            </div>
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
                            </b> 
                           
                            <!-- <a href="#" class="px-3">Follow</a> -->
                             @if(Auth::check() && Auth::id() == $post->user_id)
                            <a href="/editpost/{{$post->id }}" class="px-3"><span class="text-dark">Edit Post</span></a>
                            
                            <a href="/deletepost/{{$post->id }}" class="px-3"><span class="text-dark">Delete Post</span></a>
                            @endif
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
            <div class="comment-area mt-4" id="comment-area">

                @if(session('message'))     
                <h6 class="alert alert-warning mb-3">{{ session('message') }}</h6>
                @endif
              <div class="card card-body">
                  <h6 class="card-title">Leave a comment</h6>   
                  <form action="{{ url('comments')}}" method="POST" id="serializeForm" data-post="{{$post->id}}" class="form_class">
                    @csrf
                      <input type="hidden" name="post_slug" value="{{$post->slug}}">
                      <input type="hidden" name="post_id" value="{{$post->id}}" id="post_id">
                      <input type="hidden" name="user_id" value="{{$post->user_id}}" id="user_id">
                      <textarea name="comment_body" class="form-control" rows="3" id="comment_body" required></textarea>
                      <button type="submit" name="submit" class="btn btn-primary mt-3" class="submitButton">Submit</button>
                  </form>
              </div>


              @forelse($post->comments as $comment)
              <div class="comment-container card card-body shadow-sm mt-3">
                  <div class="detail-area">
                      <h6 class="user-name mb-1">
                          @if ($comment->user)
                              {{$comment->user->name}}
                          @endif  
                          <small class="ms-3 text-primary">Commented on: {{ $comment->created_at->format('d-m-Y') }}</small>
                      </h6>
                      <p class="user-comment mb-1">
                          {{ $comment->comment_body }}
                          
                      </p>
                  </div>
                  @if(Auth::check() && Auth::id() == $comment->user_id)
                  <div>
                      <!-- <a href="/delete-comment/{{$comment->id }}"><i class="fa fa-trash" style="font-size:20px; color:black;"></i> </a> -->
                      <button type="button" value="{{$comment->id}}" style="border:none; background: none;" class="deleteComment"><i class="fa fa-trash" style="font-size:20px; color:black;"></i> </button>
                  </div> 
                  @endif                 
              </div>   
              @empty
              <h6>No Comments Yet.</h6>
              @endforelse 
                </div>
    </div>
        </div>
</div>
<script type="text/javascript">
    var token = '{{ Session::token() }}';
    var urlLike = '{{ route('like')}}';
</script>
@endsection

<!-- @section('scripts')
<script type="text/javascript">
    $(document).ready(function(){

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        }); 
    $(document).ready(function (){

        $(document).on('click', '.deleteComment', function () {
            alert("Hello ajax");
        });
    });
}
</script>

@endsection
 -->




