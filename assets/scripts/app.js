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
// current task description
const taskDescription = document.querySelectorAll('.taskDescription');

const deadlines = document.querySelectorAll('.deadline');

const editTaskDeadline = document.getElementById('editTaskDeadline');

const stickyNotes = document.querySelectorAll('.stickyNote');

const editListSelection = document.getElementById('editListSelection');

//When clicking on Edit button under tasks this happens: Create task form goes hidden. Edit task form appears. The value of the edit button is set to the task ID and is copied to the hidden task ID value in the edit form.
editTaskButtons.forEach((editTaskButton) => {
  editTaskButton.addEventListener('click', () => {
    editTask.classList.remove('hidden');
    createTask.classList.add('hidden');
    window.scrollTo({ top: 0, behavior: 'smooth' });

    taskIds.forEach((taskId) => {
      taskId.value = editTaskButton.id;
    });

    stickyNotes.forEach((stickyNote) => {
      stickyNote.addEventListener('click', function (e) {
        if (e.target.className === 'editTaskButton') {
          const taskName = e.target.closest('div').querySelector('.title');
          editTaskTitle.innerHTML = taskName.innerHTML;
          editTaskName.value = taskName.innerHTML;

          const description = e.target
            .closest('div')
            .querySelector('.description');
          editTaskDescription.innerHTML = description.innerHTML;

          const date = e.target.closest('div').querySelector('.deadline');
          editTaskDeadline.value = date.innerHTML;
        }
      });
    });
  });

  cancel.addEventListener('click', () => {
    editTask.classList.add('hidden');
    createTask.classList.remove('hidden');
  });
});
