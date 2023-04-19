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
            data: {comment_body:comment_body, post_id:post_id, user_id:user_id},
            success : function(data) {
                $('body').append("<div>"+data+"</div>");
                window.location.reload();          
        }                                  
        });   
    });  


    $(document).ready(function () {

        $(document).on('click', '.deleteComment', function() {
            if(confirm('Are you sure you want to delete this comment?'))
                {
                    var thisClicked = $(this);
                    var comment_id = thisClicked.val();

                    $.ajax({
                        type: "POST",
                        url: "/delete-comment",
                        data:{
                            'comment_id': comment_id
                        },
                        success: function (res){
                            if(res.status == 200){
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


});

