let to_dos = [];
let id = 0;
function addTodo(todoText) {
  to_dos.push({
    text: todoText,
    completed: false // For example, assuming todos start as incomplete
  });

  // Optional: Update the UI to reflect the new todo
  // Render the todo in the interface
}

// Function to mark a todo as completed
function completeTodo(index) {
  to_dos[index].completed = true;

  // Optional: Update the UI to reflect the completed todo
  // Update the interface to show the todo as completed
}

// Function to remove a todo from the array
function removeTodo(index) {
  to_dos.splice(index, 1);

  // Optional: Update the UI to reflect the removed todo
  // Remove the todo from the interface
}

function addTrash(){
  $('#to-dos').on('click', '.bi-trash', function() {
    let todoId = $(this).parent().attr('id');
    $('#' + todoId).remove(); // Remove the entire todo container
  });
}



/* Example usage:
// Adding a new todo
addTodo("Example todo 1");

// Marking the first todo as completed
completeTodo(0);

// Removing the second todo
removeTodo(1);
*/
$(document).ready(function(event){


  
  $('#add_todo').click(function(e){
    e.preventDefault();
    e.stopPropagation();
    
    let checkbox = $('<i>').addClass('bi bi-app');

    let label = $('<input>').attr({
      type: 'text',
      class: 'to-do',
      id: 'todo_' + id,
      name: id
    });

    let deleteButton = $('<i>').addClass('bi bi-trash'); // Create trash icon
    
    let todoContainer = $('<div>').attr('id', 'todo_' + id).append(checkbox, label, deleteButton);
    $('#to-dos').append(todoContainer);
    
    $('.bi.bi-app').on('click', function(event) {
      const type = $(this).attr('class') === 'bi bi-app' ? 'bi bi-check-square' : 'bi bi-app';
      $(this).attr('class', type);
    });

    id++;
  });

  addTrash();
});


/*
Event delegation
const container = document.getElementById('button-container');

container.addEventListener("click", (event) => 
    alert(event.target.innerText)
)
*/

