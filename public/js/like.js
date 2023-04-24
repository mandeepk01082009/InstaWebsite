var postId = null; 
$(document).ready(function(){

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });         

$('.like').on('click', function(event) {     
        event.preventDefault();
        //console.log(event.target.parentNode.parentNode.parentNode.dataset['post']);
        var postId = event.target.parentNode.parentNode.parentNode.dataset['post'];
        var isLike = event.target.previousElementSibling == null ;
        $.ajax({
                method: 'POST',   
                url: urlLike,
                data: {isLike: isLike, postId: postId, _token:token},
                success: function (data) {
                        console.log(postId);           
        } 
                  
        })

        .done(function(){
                event.target.innerHTML = isLike ? event.target.innerText == 'Like' ? 'Like' : 'Like' : event.target.innerText === 'Dislike' ? 'You don\'t like this post' : 'Dislike';
                if(!isLike) {
                        event.target.previousElementSibling.innerText = 'Like';
                }
        });
});
});

