const editTask = document.querySelector('.edit-task');
const createTask = document.querySelector('.create-task');
const taskIds = document.querySelectorAll('.taskId');
const editTaskButtons = document.querySelectorAll('.edit-task-button');

//When clicking on Edit button under tasks this happens: Create task form goes hidden. Edit task form appears. The value of the edit button is set to the task ID and is copied to the hidden task ID value in the edit form.
editTaskButtons.forEach((editTaskButton) => {
  editTaskButton.addEventListener('click', () => {
    editTask.classList.add('visible');
    createTask.classList.add('hidden');

    taskIds.forEach((taskId) => {
      taskId.value = editTaskButton.value;
    });
  });
});
