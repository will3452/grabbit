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
                    $('.followbtn_'+data.followed_id).addClass('unfollow-user')
                    $('.followbtn_'+data.followed_id).removeClass('follow-user')
                    $('.followspn_'+data.followed_id).addClass('hover-unfollow')
                    $('.followspn_'+data.followed_id).removeClass('hover-follow')
                    $('.followspn_'+data.followed_id).text('Unfollow User')
                    $('.followinc_'+data.followed_id).attr("xlink:href", '/vendors/@coreui/icons/svg/free.svg#cil-user-unfollow')
                    console.log(data);
                }else if(data.messages=='Unfollow'){
                    $('.followbtn_'+data.unfollowed_id).addClass('follow-user')
                    $('.followbtn_'+data.unfollowed_id).removeClass('unfollow-user')
                    $('.followspn_'+data.unfollowed_id).removeClass('hover-unfollow')
                    $('.followspn_'+data.unfollowed_id).addClass('hover-follow')
                    $('.followspn_'+data.unfollowed_id).text('Follow User')
                    $('.followinc_'+data.unfollowed_id).attr("xlink:href", '/vendors/@coreui/icons/svg/free.svg#cil-user-follow')
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
