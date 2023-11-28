function isEmpty(str){
  return (!str || str.length === 0);
}

$(document).ready(function(){

  $('#registration_form').click(function(e){
    e.preventDefault();
    e.stopPropagation();

    let name= $('#name').val();
    let last_name = $('#last_name').val();
    let username = $('#username').val();
    let email = $('#email').val();
    let password = $('#password').val();
    let pass_verification = $('#verification').val();
    let message = $('#alert p'); //the alert message
    message.text('');

    if(!isEmpty(name) && !isEmpty(last_name) && !isEmpty(username) && !isEmpty(email) && !isEmpty(password) && !isEmpty(pass_verification)){

      if(pass_verification === password){
        $.ajax({
          url: 'server.php',
          type: 'POST',
          data:{
            'action':'register',
            'name': name,
            'last_name': last_name,
            'username': username,
            'email': email,
            'password': password
          },
          success: function(msg){
            console.log('server responded with: ' + msg);
            message = msg;
          }
        })
      }
      else{
        message.text('Passwords do not match');
      }

    }else{
      message.text('Form incomplete, please do not leave anything blank');
      
    }
  })




})