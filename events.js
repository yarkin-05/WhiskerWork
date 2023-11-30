
function isEmpty(str){
  return (!str || str.length === 0);
}

$('#togglePassword').on('click', function() {
  const passwordField = $('#password');
  const fieldType = passwordField.attr('type');
  passwordField.attr('type', fieldType === 'password' ? 'text' : 'password');
  $(this).toggleClass('fa-eye fa-eye-slash');
});

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
            if(msg != -1) window.location.href = 'dashboard.php';

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
            if(msg != -1) window.location.href = 'dashboard.php';
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


  $('#recover_password').click(function(event){
    event.preventDefault();
    event.stopPropagation();
    let email = $('#email').val();
    let message = $('#alert p'); //the alert message
    if(!isEmpty(email)){
      $.ajax({
        url: 'recovery.php',
        type: 'POST',
        data:{ 'email': email },
        success: function(msg){
          console.log('server responded with: ' + msg);
          message.text(msg);
          
        }
      }).fail(function(msg){
        console.log(msg);
      });
    }else{
      message.text('Please provide an email');
    }
    
  })

  
})

/*
 let newInput = $('<input>').attr({
      type: 'checkbox',
      id: 'todo_item',
      name: 'todo_item',
    });

    // Create a label for the checkbox
    let label = $('<input>').attr({
      type: 'text',
      id: 'todo_item',
      name: 'todo_item',
    }); */