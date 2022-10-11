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
                    $(".alert-show").show();
                    $(".alert-messages").text(data.messages);
                    console.log(data);
                }else if(data.messages=='Unfollow'){
                    $(".alert-show").show();
                    $(".alert-messages").text(data.messages);
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
    $(".blockform2").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:'/blocks',
            method:'POST',
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            success:function(data){
                let url = '/';
                if(data.messages=='blocked'){
                    $(".alert-show").show();
                    $(".alert-messages").text(data.text);
                    setInterval(function () {  
                        location = url;
                    }, 2000);  
                }
            }
        });
    });
    $(".deleteform").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:'/posts/delete',
            method:'post',
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            success:function(data){
                if(data.messages=='delete'){
                    $(".alert-show").show();
                    $(".alert-messages").text(data.text);
                    $('.delete_post_hide_'+data.deletepost).addClass('d-none');
                    console.log(data);
                }
            }
        });
    });
    $(document).on('click','.post_process_dot', function(){
        $(this).children('.show_acton_dot').toggleClass('toggle');
    });
    $("body").mouseup(function(){ 
        $(".show_acton_dot").addClass('toggle');
        $(".alert-dismissible").hide();
    });
    
  });
