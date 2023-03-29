$(document).ready(function(){

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
$('.like').on('click', function(event){
	
        event.preventDefault();
        postId = event.target.parentNode.parentNode.database['post_id'];
        var isLike = event.target.previousElementSibling == null;

        $.ajax({
                method : 'POST',
                url : urlLike,
                data : {like: isLike, post_id: postId, _token:token}
        })

        .done(function(){
                even.target.innerText = isLike ? event.target.innerText == 'Dislike' ? 'You like  this post' : 'Like':

                even.target.innerText = 'Dislike' ? 'You dont like  this post' : 'Dislike';
                if(isLike.target.innerHtML);

                if (isLike) {
                        event.target.nextElementSibling.innerText = 'Dislike';
                }else{
                        event.target.previousElementSibling.innerText = 'like';

                }
        });
});
});