var postId = null;
$(document).ready(function(){

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

$('.like').on('click', function(event) {
        event.preventDefault();
        postId = event.target.parentNode.parentNode.dataset['postid'];
        var isLike = event.target.previousElementSibling == null ;
        $.ajax({
                method: 'POST',
                url: urlLike,
                data: {isLike: isLike, postId: postId, _token:token},
                // success: (res) => {
                //         alert(res.message)
                // }
        })

        .done(function(){
                //change the page
        });
});
});