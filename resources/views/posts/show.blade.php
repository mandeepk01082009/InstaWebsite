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

                            
                            <a href="/editpost/{{$post->id }}" class="px-3"><span class="text-dark">Edit Post</span></a>
                            
                            <a href="/deletepost/{{$post->id }}" class="px-3"><span class="text-dark">Delete Post</span></a>
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
              <div class="card card-body">
                  <h6 class="card-title">Leave a comment</h6>
                  <form action="{{ url('comments')}}" method="POST">
                      <input type="hidden" name="post_slug" value="{{$post->slug}}">
                      <textarea name="comment_body" class="form-control" rows="3" required></textarea>
                      <button type="submit" class="btn btn-primary mt-3">Submit</button>
                  </form>
              </div> 

              <div class="card card-body shadow-sm mt-3">
                  <div class="detail-area">
                      <h6 class="user-name mb-1">
                          User One
                          <small class="ms-3 text-primary">Commented on: 3-8-2022</small>
                      </h6>
                      <p class="user-comment mb-1">
                          data into database using Laravel Insert data into database data into database using Laravel Insert data into database
                      </p>
                      <a href="" class="btn btn-primary btn-sm me-2">Edit</a>
                      <a href="" class="btn btn-danger btn-sm me-2">Delete</a>
                  </div>
              </div>


                </div>
    </div>
        </div>
</div>
@endsection
