$(document).ready(function(){
    $(".likeform").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:'/like',
            method:'POST',
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            success:function(data){

                if(data.messages=='like'){
                    $('.like_'+data.id_back).addClass('hide_like_unlike');
                    $('.unlike_'+data.id_back).removeClass('hide_like_unlike');
                    console.log(data);
                }else if(data.messages=='unlike'){
                    $('.unlike_'+data.id_back).addClass('hide_like_unlike');
                    $('.like_'+data.id_back).removeClass('hide_like_unlike');
                    console.log(data);
                }
            }
        });
    });
  });