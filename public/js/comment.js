 $(document).ready(function(){

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        }); 

 $('#frmComments').on('submit', function(e) {
        e.preventDefault();
        var comment_body = $('#comment_body').val();
        var post_id = $('#post_id').val();
        var user_id = $('#user_id').val();
        $.ajax({
            type: "POST",
            url: '/comments',
            data: {comment_body:comment_body, post_id:post_id, user_id:userid},
            success: function(msg) {
                a$("body").append("<div>"+msg+"</div>");
            }
        });
    });        


});

