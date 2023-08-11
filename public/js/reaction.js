var postId = null;
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
  
        $(document).on('click', '.react', function () {   
            var thisClicked = $(this); 
            //var story_id = $(this).attr("id");    
            var story_id = thisClicked.val();       
            var user_id = $(this).attr("data-id");    
           // var user_id = $('#user_id').val();          
            var react = "&#128514";

            $.ajax({
                type: "POST",       
                url: "/react",  
                data: {
                    'story_id': story_id, "user_id": user_id, "react": "&#128514",       
                },
                success: function (res) {     
                    console.log(story_id);      
                    console.log(user_id);          
                    console.log(data);   
                }
            });

        });
    });
});

