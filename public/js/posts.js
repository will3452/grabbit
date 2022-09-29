$(document).ready(function(){

    // $(".likeform").on('submit', function(e){
    //     // just to make response fast in the ui side
    //     let payload = new FormData(this)
    //     $('.like_'+payload.get('likeinput')).toggleClass('color_like');

    //     e.preventDefault();
    //     $.ajax({
    //         url:'/like',
    //         method:'POST',
    //         data:payload,
    //         processData:false,
    //         dataType:'json',
    //         contentType:false,
    //         success:function(data){
    //             console.log('data.id_back >> ', data.id_back)
    //             if(data.messages=='like'){
    //                 $('.like_'+data.id_back).addClass('color_like');
    //                 var like = $('.totallike_'+data.id_back).text();
    //                 var convert = parseInt(like) + 1;
    //                 $('.totallike_'+data.id_back).text(convert);;
    //             }else if(data.messages=='unlike'){
    //                 $('.like_'+data.id_back).removeClass('color_like');
    //                 var like = $('.totallike_'+data.id_back).text();
    //                 var convert = parseInt(like) - 1;
    //                 $('.totallike_'+data.id_back).text(convert);;
    //             }
    //         }
    //     });
    // });

    // $(".comment-form").on('submit', function(e){
    //     let payload = new FormData(this)
    //     $(this).hide()
    //     let form = this
    //     e.preventDefault();
    //     $.ajax({
    //         url:'/comments',
    //         method:'POST',
    //         data:payload,
    //         processData:false,
    //         dataType:'json',
    //         contentType:false,
    //         success:function(data){
    //             console.log(data)
    //             $(form).show()
    //         }
    //     });
    // });
    $(".followform").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:'/follows',
            method:'POST',
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            success:function(data){

                if(data.messages=='Follow'){

                    $('.followbtn_'+data.followed_id).text('Unfollow')
                    console.log(data);
                }else if(data.messages=='Unfollow'){
                    $('.followbtn_'+data.unfollowed_id).text('Follow')
                    console.log(data);
                }
            }
        });
    });
    $(".blockform").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:'/blocks',
            method:'POST',
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            success:function(data){
                if(data.messages=='blocked'){
                    $(".alert-show").show();
                    $(".alert-messages").text(data.text);
                    $('.block_post_hide_'+data.block_id).addClass('d-none');
                    console.log(data);
                }
            }
        });
    });
  });
