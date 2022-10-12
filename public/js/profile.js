function error_handling(att_name, errormessage){
    if(!errormessage){
        $("#" + att_name)
            .removeClass('is-invalid')
            .text('')
        $("." + att_name).text('')
    }else{
        $("#" + att_name)
        .addClass('is-invalid')
        $("." + att_name).text(errormessage)
    }
}
$(".submitprofile").on('submit', function(e){
    e.preventDefault();
    let btn = document.getElementById('updatebtmprofile');
    btn.innerHTML = "Updating...";
    $.ajax({
        url:'/profile',
        method:'POST',
        data:new FormData(this),
        processData:false,
        dataType:'json',
        contentType:false,
        success:function(data){
            if(data.status == '200'){
                error_handling('avatar-img', '');
                error_handling('name', '');
                error_handling('address', '');
                error_handling('phone', '');
                error_handling('attachments', '');
                error_handling('descriptions', '');
                $(".alert-show").show();
                $(".alert-messages").text('Update Profile Successful');
                let url = data.location;
                setInterval(function () {  
                    location = url;
                }, 2000);  
            }
            else if(data.status == '400-both'){
                error_handling('avatar-img', data.messages.avatar);
                error_handling('name', data.messages.name);
                error_handling('address', data.messages.address);
                error_handling('phone', data.messages.phone);
                error_handling('attachments', data.messageimage);
                error_handling('descriptions', data.messages.descriptions);
                
            }
            else if(data.status == '404-datas'){
                error_handling('avatar-img', data.messages.avatar);
                error_handling('name', data.messages.name);
                error_handling('address', data.messages.address);
                error_handling('phone', data.messages.phone);
                error_handling('attachments', '');
                error_handling('descriptions', data.messages.descriptions);
                
            }else if(data.status == '404-images'){
                error_handling('avatar-img', '');
                error_handling('name', '');
                error_handling('address', '');
                error_handling('phone', '');
                error_handling('attachments', data.messageimage);
                error_handling('descriptions', '');
                
            }
        }
    });
});