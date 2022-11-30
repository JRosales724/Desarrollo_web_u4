$(document).ready(function() {
    // Global Settings
    let edit = false;
  
    // Testing Jquery
    console.log('jquery is working!');
    fetchTasks();
    $('#task-result').hide();
  
  
    // search key type event
    $('#search').keyup(function() {
      if($('#search').val()) {
        let search = $('#search').val();
        $.ajax({
          url: 'task-search.php',
          data: {search},
          type: 'POST',
          success: function (response) {
            if(!response.error) {
              let tasks = JSON.parse(response);
              let template = '';
              tasks.forEach(task => {
                template += `
                           <tr taskId="${task.id}">
                 
                    <td>
                    <a href="#" class="task-item">* 
                      ${task.name} 
                    </a>
                    </td>
                  
                    </tr>
                      ` 
              });
              $('#task-result').show();
              $('#container').html(template);
            }
          } 
        })
      }
    });

    $('#search').keydown(function() {
        if($('#search').val()) {
          let search = $('#search').val();
          $.ajax({
            url: 'task-search.php',
            data: {search},
            type: 'POST',
            success: function (response) {
              if(!response.error) {
                let tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(task => {
                  template += `
                    

                    <tr taskId="${task.id}">
                 
                    <td>
                    <a href="#" class="task-item">* 
                      ${task.name} 
                    </a>
                    </td>
                  
                    </tr>
                        ` 
                });
                $('#task-result').hide();
                $('#container').html(template);
              }
            } 
          })
        }
      });
  
    $('#task-form').submit(e => {
      e.preventDefault();
      const postData = {
        name: $('#name').val(),
        description: $('#description').val(),
        id: $('#taskId').val()
      };
      const url = edit === false ? 'task-add.php' : 'task-edit.php';
      console.log(postData, url);
      $.post(url, postData, (response) => {
        console.log(response);
        $('#task-form').trigger('reset');
        fetchTasks();
      });
    });
  
    // Fetching Tasks
    function fetchTasks() {
      $.ajax({
        url: 'tasks-list.php',
        type: 'GET',
        success: function(response) {
          const tasks = JSON.parse(response);
          let template = '';
          tasks.forEach(task => {
            template += `
                    <tr taskId="${task.id}">
                    <td>${task.id}</td>
                    <td>
                    <a href="#" class="task-item">
                      ${task.name} 
                    </a>
                    </td>
                    <td>${task.description}</td>
                    <td>${task.foto}</td>
                    <td>
                      <button class="task-delete btn btn-danger">
                       Eliminar
                      </button>
                    </td>
                    </tr>
                  `
          });
          $('#tasks').html(template);
        }
      });
    }
  
    // Get a Single Task by Id 
    $(document).on('click', '.task-item', (e) => {
      const element = $(this)[0].activeElement.parentElement.parentElement;
      const id = $(element).attr('taskId');
      $.post('task-single.php', {id}, (response) => {
        const task = JSON.parse(response);
        $('#name').val(task.name);
        $('#description').val(task.description);
        $('#taskId').val(task.id);
        edit = true;
      });
      e.preventDefault();
    });
  
    // Delete a Single Task
    $(document).on('click', '.task-delete', (e) => {
      if(confirm('Estas seguro de querer eliminarlo?')) {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('taskId');
        $.post('task-delete.php', {id}, (response) => {
          fetchTasks();
        });
      }
    });
  });  