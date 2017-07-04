function send_email(form){
    $.ajax({
        type:'post',
        url: 'user/addUser',
        data: form,
        error: function(){},
        success: function(){}
    })
}

