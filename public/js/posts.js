$(document).ready(function(){

    $(".likeform").on('submit', function(e){
        // just to make response fast in the ui side
        let payload = new FormData(this)
        $('.like_'+payload.get('likeinput')).toggleClass('color_like');

        e.preventDefault();
        $.ajax({
            url:'/like',
            method:'POST',
            data:payload,
            processData:false,
            dataType:'json',
            contentType:false,
            success:function(data){
                console.log('data.id_back >> ', data.id_back)
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
