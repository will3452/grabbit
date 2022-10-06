
function error_handling(attr_name, datas){

    if(!datas){
        $("#" + attr_name)
            .addClass('is-valid')
            .removeClass('is-invalid')
            .text('')
        $("." + attr_name).text('')
    }else{
        $("#" + attr_name)
            .addClass('is-invalid')
            .removeClass('is-valid')
        $("." + attr_name).text(datas)
    }
}
$(document).ready(function(){

    $("#create_meetup").on('submit', function(e){
        // just to make response fast in the ui side
        let payload = new FormData(this)
        $(".btn-primary").text('loading...');
        
        e.preventDefault();
        $.ajax({
            url:'/meetup',
            method:'POST',
            data:payload,
            processData:false,
            dataType:'json',
            contentType:false,
            success:function(data){
                if(data.status == 400){
                    error_handling('meetup_date', data.messages.meetup_date);
                    error_handling('remarks', data.messages.remarks);
                    $(".btn-primary").text('Create Meetup');
                    console.log(data);
                }else if(data.status == 404){
                    error_handling('meetup_date', data.messages);
                    $("#remarks")
                        .addClass('is-invalid')
                        .removeClass('is-valid')
                    $(".remarks").text('')
                    console.log(data);
                    $(".btn-primary").text('Create Meetup');
                }
                else{
                    console.log(data);
                    $(".btn-primary").text('Create Meetup');
                    window.location.href = "/meetup/requested-meetup";
                }
             
            }
        });
    });


    $("#process_meetup").on('submit', function(e){
        // just to make response fast in the ui side
        let payload = new FormData(this)
        $(".btn-primary").text('loading...');
        var form = this;
        e.preventDefault();
        $.ajax({
            url:$(form).attr('action'),
            method:$(form).attr('method'),
            data:payload,
            processData:false,
            dataType:'json',
            contentType:false,
            success:function(data){
                if(data.status == 400){
                    error_handling('process', data.messages.process);
                    $(".btn-primary").text('Process Meetup');
                    console.log(data);
                }else if(data.status == 404){
                    error_handling('process', data.messages);
                    $(".btn-primary").text('Process Meetup');
                    console.log(data);
                }else{
                    
                    window.location.href = '/meetup/request-meetup';
                }
            }
        });
    });
});