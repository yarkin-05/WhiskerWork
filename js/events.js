
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

  /***************************************
   * REGISTRATION
   */

  //buttons on registration.php
  $('#register_pt1').click(function(e){
    e.preventDefault();
    e.stopPropagation();

    let name= $('#name').val();
    let last_name = $('#last_name').val();
    let username = $('#username').val();
    let email = $('#email').val();
    let message = $('#alert p'); //the alert message
    message.text('');

    if(!isEmpty(name) && !isEmpty(last_name) && !isEmpty(username) && !isEmpty(email)){

      $.ajax({
        url: './BackEnd/server.php',
        type: 'POST',
        data:{
          'action':'send_verification_code',
          'name': name,
          'last_name': last_name,
          'username': username,
          'email': email,
        },
        success: function(msg){
          console.log('server responded with: ' + msg);
          message.text(msg);

        }
      }).fail(function(jqXHR, textStatus, errorThrown){
        console.log('error:  + textStatus');
      });
    }
    else{
      message.text('Passwords do not match');
    }

    
  });

  $('#temporary_registration').click(function(event){
    event.preventDefault();
    event.stopPropagation();

    let temporary_password = $('#temporary_password').val();

    let message = $('#alert p'); //the alert message
    message.text('');

    if(!isEmpty(temporary_password)){

      $.ajax({
        url: './BackEnd/server.php',
        type: 'POST',
        data:{
          'action': 'check_temporary_password',
          'temporary_password': temporary_password
        },
        success: function(msg){
          console.log('server responded with: ' + msg);
          message.text(msg);
          window.location.href = './change_password.php';
        }
      }).fail(function(msg){
        console.log('error: ' + msg);
        message.text(msg);
      });

    }else{
      message.text('Temporary password can not be blank');
    }

  }); 

  //button on change_password.php
  $('#reset_password').click(function(e){
    e.preventDefault();
    e.stopPropagation();

    let password = $('#new_password').val();
    let confirm = $('#confirm_new_password').val();
    let message = $('#alert p'); //the alert message
    message.text('');

    if(!isEmpty(password) && !isEmpty(confirm)){

      if(password === confirm){
        $.ajax({
          url: './Backend/server.php',
          type: 'POST',
          data:{
            'action':'reset_password',
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


  /**
   * END OF REGISTRATION
   *///----------------------------









  $('#send_email').click(function(event){
    e.preventDefault();
    e.stopPropagation();
    let email = $('#email').val();

    $.ajax({
      url: './BackEnd/server.php',
      type: 'POST',
      data: {
        'action':'send_verification_code',
        'email': email
      },
      success: function(msg){
        console.log('server responded with: ' + msg);
        message.text(msg);

      }
    }).fail(function(jqXHR, textStatus, errorThrown){
      console.log('error:  + textStatus');
    });
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
          url: './BackEnd/server.php',
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