$("#unblocking").on('submit', function(e){
    e.preventDefault();
    $("#unblockingbtn").text('loading...')
    $.ajax({
        url:'/blocks/users/destroy',
        method:'POST',
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false,
        success:function(data){
            if(data.messages=='unblock'){
                window.location.href = data.redirect_link
                $("#unblockingbtn").text('Unblock User')
            }
        }
    });
});