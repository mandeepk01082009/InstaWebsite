 $(document).ready(function(){

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        }); 

             $(document).on('submit', '.form_class', function(e){
                e.preventDefault();
                //var dataString = $("#serializeForm").serialize();
                var data = $(this).serializeArray();
                $.ajax({
                  type: "POST",
                  url: "/comments",    
                  data: $.param(data),
                  success: function(data)    
                  {
                    $(".comment-area").append("<div class= 'card card-body shadow-sm mt-3'> + dataString + </div>");
                    //  window.location.reload();     
                  }
                          
          
          });
                 
               });

            

    // $('#uniqueID').on('submit', function(e) {        
    //     e.preventDefault();  //prevents the form from autosubmitting
    //     var comment_body = $('#comment_body').val();
    //     var post_id = $('#post_id').val();  
    //     var user_id = $('#user_id').val();
    //     var uniqid = $('#uniqid').val();   

    //     $.ajax({
    //         type: "POST",
    //         url: '/comments',        
    //         data: {comment_body:comment_body, uniqid:uniqid, post_id:post_id, user_id:user_id},
    //         success : function(data) {
    //             let d = new Date().getTime().toString();       
    //             let crediv = document.getElementById('comment-area');
    //             let item = document.createElement('div');
    //             console.log(d);                  

    //             item.className = "card card-body shadow-sm mt-3";    

    //             item.textContent =  comment_body;   

    //             crediv.appendChild(item);              
    //     }                                  
    //     });   
    // });  


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

