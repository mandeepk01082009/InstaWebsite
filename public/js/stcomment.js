$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', '.comment_form', function(e) {
        e.preventDefault();
        var data = $(this).serializeArray();    
        $.ajax({
            type: "POST",
            url: "/stcomments",  
            data: $.param(data),     
            success: function(response) {
               console.log(data);
                // myClass = "card card-body shadow-sm mt-3";     
                // $(".comment-area").append($("<div>" + response.data.comment_body + "</div>").addClass(myClass));
            }  


        });

    });




});