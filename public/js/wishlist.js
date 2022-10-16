$(".wishlist").on('submit', function(e){
    e.preventDefault();
    let btn = $(this).children('.wishlist-user');
    $.ajax({
        url:'/wishlist',
        method:'POST',
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false,
        success:function(data){
            if(data.status == 200 && data.type == 'add'){
                btn.text('Remove To Wishlist');
                $(".alert-show").show();
                $(".alert-messages").text(data.message);
            }
            else if(data.status == 200 && data.type == 'remove'){
                btn.text('Add To Wishlist');
                $(".alert-show").show();
                $(".alert-messages").text(data.message);
            }
        }
    });
});

$(".wishlist2").on('submit', function(e){
    e.preventDefault();
    let cont = $(this).parents('.card');
    $.ajax({
        url:'/wishlist',
        method:'POST',
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false,
        success:function(data){
            if(data.status == 200 && data.type == 'remove'){
                cont.hide();
                $(".alert-show").show();
                $(".alert-messages").text(data.message);
            }
        }
    });
});