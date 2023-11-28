function isEmpty(str){
  return (!str || str.length === 0);
}

//toggle passwords
const togglePasswords = document.querySelectorAll('#togglePassword');
const passwords = document.querySelectorAll('input[type=password]');

togglePasswords.forEach(function(togglePassword, index) {
  togglePassword.addEventListener('click', function(event) {
    const type = passwords[index].getAttribute('type') === 'password' ? 'text' : 'password';
    passwords[index].setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
  });
});

//end of toggle passwords


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
            message.text(msg);
            //window.location.href = 'dashboard.php';

          }
        }).fail(function(jqXHR, textStatus, errorThrown){
          console.log('error:  + textStatus');
        });
      }
      else{
        message.text('Passwords do not match');
      }

    }else{
      message.text('Form incomplete, please do not leave anything blank');
      
    }
  });

  $('#login_form').click(function(e){
    e.preventDefault();
    e.stopPropagation();

    let username = $('#username').val();
    let password = $('#password').val();
    let message = $('#alert p'); //the alert message
    message.text('');

    if(!isEmpty(username) && !isEmpty(password)){

        $.ajax({
          url: 'server.php',
          type: 'POST',
          data:{
            'action':'login',
            'username': username,
            'password': password
          },
          success: function(msg){
            console.log('server responded with: ' + msg);
            message.text(msg);
            window.location.href = 'dashboard.php';
          }
        }).fail(function(msg){
          console.log(msg);
        });
    }else{
      message.text('Form incomplete, please do not leave anything blank');
    }
  });

  $('#reset_password').click(function(e){
    e.preventDefault();
    e.stopPropagation();

    let username = $('#username').val();
    let password = $('#new_password').val();
    let confirm = $('#confirm_new_password').val();
    let message = $('#alert p'); //the alert message
    message.text('');

    if(!isEmpty(username) && !isEmpty(password) && !isEmpty(confirm)){

      if(password === confirm){
        $.ajax({
          url: 'server.php',
          type: 'POST',
          data:{
            'action':'reset_password',
            'username': username,
            'password': password
          },
          success: function(msg){
            console.log('server responded with: ' + msg);
          }
        }).fail(function(msg){
          console.log(msg);
        });
      }else{
        message.text('Passwords do not match');
      }
    }else{
      message.text('Form incomplete, please do not leave anything blank');
    }
  });





  //toggle passwords
  
})