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
// the form for editing/deleting selcted list
const editListForm = document.querySelector('.editListForm ');
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
// the title in the edit list form
const listTitle = document.getElementById('listTitle');
// div containing "create new list" form
const createList = document.querySelector('.createList');
// "reader friendly" button
const changeFontButton = document.getElementById('changeFont');
// div wrapping the tasks containing the amatic font
const taskContents = document.getElementById('taskContents');

//When clicking on Edit button under tasks this happens: Create task form goes hidden. Edit task form appears. The value of the edit button is set to the task ID and is copied to the hidden task ID value in the edit form.
editTaskButtons.forEach((editTaskButton) => {
  editTaskButton.addEventListener('click', () => {
    editTask.classList.remove('hidden');
    createTask.classList.add('hidden');
    editListForm.classList.add('hidden');
    selectListToEdit.classList.add('hidden');
    createList.classList.add('hidden');
    window.scrollTo({ top: 0, behavior: 'smooth' });
    //give each edit button the correct task ID
    taskIds.forEach((taskId) => {
      taskId.value = editTaskButton.id;
      taskId.value = editTaskButton.id;
    });
    //find the nearest title, description and deadline divs and put the content in the edit field.
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
  //cancel buttons hides all the edit forms and shows the create task form which is the default.
  cancels.forEach((cancel) => {
    cancel.addEventListener('click', () => {
      createTask.classList.remove('hidden');
      editTask.classList.add('hidden');
      createList.classList.add('hidden');
      selectListToEdit.classList.add('hidden');
      editListForm.classList.add('hidden');
    });
  });
});

//reader friendly button changing the font of the sticky notes
changeFontButton.addEventListener('click', () => {
  taskContents.classList.remove('amatic');
  taskContents.classList.add('readerFriendly');
});

//event listeners on buttons to control which forms to display
editListButton.addEventListener('click', () => {
  editListIds.forEach((editListId) => {
    editListId.value = listIdToUpdate.value;
    const listName = listIdToUpdate.options[listIdToUpdate.selectedIndex].text;
    editListName.value = listName;
    editList.value = editListId.value;
    if (editList.value !== '') {
      selectListToEdit.classList.add('hidden');
      editListForm.classList.remove('hidden');
      listTitle.innerHTML = listName;
    }
  });
});

showCreateTask.addEventListener('click', () => {
  createTask.classList.remove('hidden');
  editTask.classList.add('hidden');
  createList.classList.add('hidden');
  selectListToEdit.classList.add('hidden');
  editListForm.classList.add('hidden');
});

showCreateList.addEventListener('click', () => {
  createTask.classList.add('hidden');
  editTask.classList.add('hidden');
  createList.classList.remove('hidden');
  selectListToEdit.classList.add('hidden');
  editListForm.classList.add('hidden');
});

showEditList.addEventListener('click', () => {
  selectListToEdit.classList.remove('hidden');
  createTask.classList.add('hidden');
  editTask.classList.add('hidden');
  createList.classList.add('hidden');
  editListForm.classList.add('hidden');
});
