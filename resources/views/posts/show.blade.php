@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
         <div class="col-6">
            @if(session('mess'))
                <h6 class="alert alert-success mb-3">{{ session('mess') }}</h6>
                @endif

                @if(session('del'))
                <h6 class="alert alert-success mb-3">{{ session('del') }}</h6>
                @endif
            <img src="/storage/{{ $post->image }}" alt="" class="img-fluid" style="max-width:400px; height:400px;">
            <div>
                <a href="/likepost/{{$post->id }}"><span class="like">Like</span></a>
                <a href="/disliked/{{$post->id }}"><span class="dislike">Disike</span></a>
            </div>
            <hr>
            <video controls src="/storage/{{ $post->video }}" alt=""  style="max-width:500px; height:400px;"></video>
            <div>
                <a href="/likepost/{{$post->id }}"><span class="like">Like</span></a>
                <a href="/disliked/{{$post->id }}"><span class="dislike">Disike</span></a>
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
                            </b> |
                           
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
            <div class="comment-area mt-4">

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
              <div class="comment-container card card-body shadow-sm mt-3">
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
</div>
<!-- <script type="text/javascript">
    $(document).ready(function(){

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $(document).on('click','.deleteComment', function(){
            if(confirm('Are you sure you want to delete this comment? '))
            {
                var thisClicked = $(this);
                var comment_id = thisClicked.val();
                //alert(comment_id);

                $.ajax({
                    type: "POST",
                    url: "/delete-comment",
                    data: {
                        'comment_id': comment_id
                    },
                    success: function(res){
                        if (res.status == 200) {
                            thisClicked.closest('.comment-container').remove();
                            alert(res.message);
                        }
                         else{
                            alert(res.message);
                        }

                    }
                });
            }    

        });
    });
</script> -->
@endsection





