function isEmpty(str){
  return (!str || str.length === 0);
}

$(document).ready(function(event){
  event.preventDefault(); 
  event.stopPropagation();
    
  $('form').submit(function(event){

    //recover_password.php
    if ($(this).attr('id') === 'send_token') {
      
      let email = $('#email').val();
      let message = $('#alert p'); //the alert message
      message.text('');
  
      if(!isEmpty(email)){
  
        $.ajax({
          url: 'Backend/servers.php',
          type: 'POST',
          data:{
            'action':'send_password_token',
            'email': email
          },
          success: function(msg){
            console.log(msg);
          }
        }).fail(function(msg){
          console.log(msg);
        });
        
      }else{
        message.text('Please output a valid email');
      }
  
    //recover_password.php
    } else if ($(this).attr('id') === 'verify_token') {
      
      let token = $('#token').val();
      let message = $('#alert p'); //the alert message
      message.text('');

      if(!isEmpty(token)){
    
        $.ajax({
          url: 'Backend/servers.php',
          type: 'POST',
          data: {
              'action': 'verify_token',
              'token': token
          },
          success: function(response) {
            console.log(response);
            window.location.href = response;
          }
        });
      }else{
        message.text('Please output a valid email');
      }
      
    } else if($(this).attr('id') === 'recover_username'){
      let email = $('#email').val();
      let message = $('#alert p'); //the alert message
      message.text('');

      if(!isEmpty(email)){

        $.ajax({
          url: 'Backend/servers.php',
          type: 'POST',
          data:{
            'action':'recover_username',
            'email': email
          },
          success: function(response){
            //console.log(response);
            window.location.href = response;
          }
        }).fail(function(msg){
          console.log(msg);
        });
        
      }else{
        message.text('Please enter a valid email');
      }
    }else if(true){
      
    }
  







  });
});