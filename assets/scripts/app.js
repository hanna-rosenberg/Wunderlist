// div containing edit task form:
const editTask = document.querySelector('.editTask');
// div containing create task form:
const createTask = document.querySelector('.createTask');
// hidden input to store task ID:
const taskIds = document.querySelectorAll('.editTaskId');
// all "edit" buttons next to the tasks:
const editTaskButtons = document.querySelectorAll('.editTaskButton');
// cancel button located inside edit task div:
const cancel = document.getElementById('cancel');
//div displaying title of current task being edited:
const editTaskTitle = document.getElementById('editTaskTitle');
// description textarea in the edit form:
const editTaskDescription = document.getElementById('editTaskDescription');
// task name text box in the edit form:
const taskName = document.getElementById('editTaskName');

const taskDescription = document.querySelectorAll('.taskDescription');

//When clicking on Edit button under tasks this happens: Create task form goes hidden. Edit task form appears. The value of the edit button is set to the task ID and is copied to the hidden task ID value in the edit form.
editTaskButtons.forEach((editTaskButton) => {
  editTaskButton.addEventListener('click', () => {
    editTask.classList.remove('hidden');
    createTask.classList.add('hidden');

    taskIds.forEach((taskId) => {
      taskId.value = editTaskButton.id;
    });
    editTaskTitle.innerHTML = `<h2>${editTaskButton.name}</h2>`;
    taskName.value = editTaskButton.name;
    editTaskDescription.innerHTML = editTaskButton.value;
  });

  cancel.addEventListener('click', () => {
    editTask.classList.add('hidden');
    createTask.classList.remove('hidden');
  });
});

//<label for="editTaskName">Update task name</label>
//<input type="text" id="editTaskName" name="editTaskName" value="" required>
//
//<label for="editTaskDescription">Update task description</label>
//<textarea id="editTaskDescription" name="editTaskDescription" required></textarea>
