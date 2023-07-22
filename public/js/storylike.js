var postId = null; 
$(document).ready(function(){

        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });         

$('.slike').on('click', function(event) {              
        event.preventDefault();
        console.log(event.target.parentNode.parentNode.parentNode.dataset['story']);              
         //var storyId = event.target.parentNode.parentNode.parentNode.dataset['story'];
         var storyId= $(this).attr("data-post");   
        alert(storyId);           
        var isLike = event.target.previousElementSibling == null ;     
        $.ajax({
                method: 'POST',
                url: urlStory,
                data: {isLike: isLike, storyId: storyId, _token:tokeni},                 
                success: function (data) {    
                        alert(storyId);                                                                                                           
        } 
                  
        })

        .done(function(){
                event.target.innerHTML = isLike ? event.target.innerText == 'Like' ? '&#9825' : '&#9829;' : event.target.innerText === 'Dislike' ? 'You don\'t like this post' : 'Dislike';
                if(!isLike) {
                        event.target.previousElementSibling.innerText = '&#9825;';     
                }
        });
});
});

