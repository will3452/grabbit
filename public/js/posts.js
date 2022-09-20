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
                    $('.like_'+data.id_back).addClass('color_like');
                    var like = $('.totallike_'+data.id_back).text();
                    var convert = parseInt(like) + 1;
                    $('.totallike_'+data.id_back).text(convert);;
                }else if(data.messages=='unlike'){
                    $('.like_'+data.id_back).removeClass('color_like');
                    var like = $('.totallike_'+data.id_back).text();
                    var convert = parseInt(like) - 1;
                    $('.totallike_'+data.id_back).text(convert);;
                }
            }
        });
    });
  });