// div containing edit task form:
const editTask = document.querySelector('.editTask');
// div containing create task form:
const createTask = document.querySelector('.createTask');
// hidden input to store task ID:
const taskIds = document.querySelectorAll('.editTaskId');
// all "edit" buttons next to the tasks:
const editTaskButtons = document.querySelectorAll('.editTaskButton');
// cancel button located inside edit task div:
const cancels = document.querySelectorAll('.cancel');
//div displaying title of current task being edited:
const editTaskTitle = document.getElementById('editTaskTitle');
// description textarea in the edit form:
const editTaskDescription = document.getElementById('editTaskDescription');
// task name text box in the edit form:
const taskName = document.getElementById('editTaskName');
// current task description
const taskDescription = document.querySelectorAll('.taskDescription');
// the deadlines for all displayed tasks
const deadlines = document.querySelectorAll('.deadline');
// the "edit task" deadline field
const editTaskDeadline = document.getElementById('editTaskDeadline');
// div that looks like a sticky note.
const stickyNotes = document.querySelectorAll('.stickyNote');
// the dorpdown of existing lists inside the "edit task" form
const editListSelection = document.getElementById('editListSelection');
// which list ID to update to
const listIdToUpdate = document.getElementById('listIdToUpdate');
// id of the List currently editing
const editListIds = document.querySelectorAll('.editListId');
// "edit list" button
const editListButton = document.getElementById('editList');
// list name input
const editListName = document.getElementById('editListName');
//the "create a new task" button
const showCreateTask = document.getElementById('showCreateTask');
//the "create a new list" button
const showCreateList = document.getElementById('showCreateList');
//the "edit lists" button that shows the list edit section
const showEditList = document.getElementById('showEditList');
//the "select list to edit" div
const selectListToEdit = document.querySelector('.selectListToEdit');
// div containing "create new list" form
const createList = document.querySelector('.createList');

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
  cancels.forEach((cancel) => {
    cancel.addEventListener('click', () => {
      editTask.classList.add('hidden');
      createTask.classList.remove('hidden');
    });
  });
});

editListButton.addEventListener('click', () => {
  editListIds.forEach((editListId) => {
    editListId.value = listIdToUpdate.value;
    const listName = listIdToUpdate.options[listIdToUpdate.selectedIndex].text;
    editListName.value = listName;
  });
});

showCreateTask.addEventListener('click', () => {
  createTask.classList.remove('hidden');
  editTask.classList.add('hidden');
  createList.classList.add('hidden');
  selectListToEdit.classList.add('hidden');
});

showCreateList.addEventListener('click', () => {
  createTask.classList.add('hidden');
  editTask.classList.add('hidden');
  createList.classList.remove('hidden');
  selectListToEdit.classList.add('hidden');
});

showEditList.addEventListener('click', () => {
  selectListToEdit.classList.remove('hidden');
  createTask.classList.add('hidden');
  editTask.classList.add('hidden');
  createList.classList.add('hidden');
});
