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
   * user registration and login
   */

  $('#send_verification_code').submit(function(e){
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
        url: 'Backend/servers.php',
        type: 'POST',
        data:{
          'action':'send_verification_code',
          'name': name,
          'last_name': last_name,
          'username': username,
          'email': email,
        },
        success: function(response){
        }
      }).fail(function(response){
        console.log(response);
      });
    }
    else{
      message.text('Input can not be blank');
    }

    
  });

  $('#verify_code').submit(function(event){
    event.preventDefault();
    event.stopPropagation();

    let temporary_password = $('#temporary_password').val();

    let message = $('#code_verification p'); //the alert message
    message.text('');

    if(!isEmpty(temporary_password)){

      $.ajax({
        url: 'Backend/servers.php',
        type: 'POST',
        data:{
          'action': 'check_temporary_password',
          'temporary_password': temporary_password
        },
        success: function(response){
          window.location.href = response;
        }
      }).fail(function(msg){
        console.log('error: ' + msg);
        message.text(msg);
      });

    }else{
      message.text('Temporary password can not be blank');
    }

  }); 

  $('#login').submit(function(event){

    event.preventDefault();
    event.stopPropagation();
    //console.log('hi');
    let username = $('#username').val();
    let password = $('#password').val();
    let message = $('#alert p'); //the alert message
    message.text('');

    if(!isEmpty(username) && !isEmpty(password)){

      $.ajax({
        url: 'BackEnd/servers.php',
        type: 'POST',
        data:{
          'action':'login',
          'username': username,
          'password': password
        },
        success: function(response){
          //console.log('server responded with: ' + response);
          window.location.href = response;
        }
      }).fail(function(msg){
        console.log(msg);
      });
    }else{
      message.text('Form incomplete, please do not leave anything blank');
    }
  });

 
  /**
   * END OF REGISTRATION
   *///----------------------------

 //change_password.php
  $('#reset_password').submit(function(e){
    e.preventDefault();
    e.stopPropagation();

    let password = $('#new_password').val();
    let confirm = $('#confirm_new_password').val();
    let message = $('#alert p'); //the alert message
    message.text('');

    if(!isEmpty(password) && !isEmpty(confirm)){

      if(password === confirm){
        $.ajax({
          url: 'Backend/servers.php',
          type: 'POST',
          data:{
            'action':'change_password',
            'password': password
          },
          success: function(response){
            console.log('server responded with: ' + response);
            window.location.href = response;
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

  /******************************
  * LOGIN
  */

  //recover_username.php
  $('#recover_username').submit(function(event){
    event.preventDefault();
    event.stopPropagation();

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
  })

  //recover_password.php
  $('#send_token').submit(function(event){
    event.preventDefault();
    event.stopPropagation();

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
        success: function(response){
          console.log(response);
          //window.location.href = response;
        }
      }).fail(function(msg){
        console.log(msg);
      });
      
    }else{
      message.text('Please output a valid email');
    }
  });

  //recover_password.php
  $('#verify_token').submit(function(event){
    event.preventDefault();
    event.stopPropagation();

    let token = $('#token').val();
    let message = $('#alert p'); //the alert message
    let mess = $('#code_verification p')
    message.text('');
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
      mess.text('Token can not be blank');
    }

  });


  /**
   * USER REGISTRATION AND LOGIN DONE
   */


  $('#create_task').submit(function(event){
    event.preventDefault();
    event.stopPropagation();

    let task_name = $('#task_name').val(),
    start_date = $('#start_date').val(),
    end_date = $('#end_date').val(),
    description = $('#description').val()
    importance = $('#importance').val(),
    message = $('#alert p');
    message.text("");

    if(!isEmpty(task_name) && !isEmpty(start_date) && !isEmpty(end_date) && !isEmpty(description) && !isEmpty(importance)){

    $.ajax({
      url: 'Backend/servers.php',
      type: 'POST',
      data: {
        'action':'create_task',
        'task_name': task_name,
        'start_date': start_date,
        'end_date': end_date,
        'description': description,
        'importance': importance
      },
      success: function(msg){
        window.location.href = msg;
      }
    }).fail(function(jqXHR, textStatus, errorThrown){
      console.log('error:  + textStatus');
    });
  }})
  
  $('.bi.bi-check-lg.check').on('click', function(event){

    
    let id = $(this).attr('id');
    console.log(id);
    let message = $('#alert p');
    message.text("");

    $.ajax({
      url: 'Backend/servers.php',
      type: 'POST',
      data: {
        'action':'complete_task',
        'id': id
      },
      success: function(msg){
        if(msg === 'success'){
          openPopup();
        }
        else{
          message.text(msg);
        }
      }
    }).fail(function(jqXHR, textStatus, errorThrown){
      console.log('error:  + textStatus');
    });
  });

  $('.bi.bi-trash3-fill').on('click', function(event){

    
    let id = $(this).attr('id');
    console.log(id);
    let message = $('#alert p');
    message.text("");

    $.ajax({
      url: 'Backend/servers.php',
      type: 'POST',
      data: {
        'action':'delete_task',
        'id': id
      },
      success: function(msg){
        window.location.href = msg;
      }
    }).fail(function(jqXHR, textStatus, errorThrown){
      console.log('error:  + textStatus');
    });
  });
});




  


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
