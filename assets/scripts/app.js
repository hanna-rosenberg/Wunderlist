const editTask = document.querySelector('.edit-task');
const createTask = document.querySelector('.create-task');
const taskId = document.getElementById('taskId');
const editTaskButtons = document.querySelectorAll('.edit-task-button');

editTaskButtons.forEach((editTaskButton) => {
  editTaskButton.addEventListener('click', () => {
    editTask.classList.add('visible');
    createTask.classList.add('hidden');
    taskId.value = editTaskButton.value;
  });
});
