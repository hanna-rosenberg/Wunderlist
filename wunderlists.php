<?php

require __DIR__ . '/app/autoload.php';

require __DIR__ . '/views/header.php';
checkUserLoginStatus();
?>

<?php

$lists = fetchAllLists($database);
$tasks = fetchAllTasks($database);

?>
<div class="d-flex flex-row justify-content-center">

    <div class=" p-2"> <button type="button" id="showCreateTask" class="btn btn-link"><b>Create new task</b></button>
    </div>
    <div class="p-2">
        <button type="button" id="showCreateList" class="btn btn-link"><b>Create new list</b></button>
    </div>
    <div class="p-2">
        <button type="button" id="showEditList" class="btn btn-link"><b>Edit lists</b></button>
    </div>
</div>


<div class="tasksParent">
    <div class=" createTask">

        <div class="col-lg-7 mx-auto">
            <div class="card mt-2 mx-auto p-4 stickyNote">
                <div class="card-body">
                    <div class="container">
                        <h2 class="permanentMarker">Create a new task</h2>

                        <!--update task form-->
                        <form action="/app/posts/store.php" method="POST">
                            <div class="controls">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="taskName"><b>Title</b></label>
                                        <input class="form-control" type="text" id="taskName" name="taskName" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="taskDeadline"><b>Deadline</b></label>
                                        <input class="form-control" type="date" id="taskDeadline" name="taskDeadline">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">

                                        <label for="taskDescription"><b>Task description</b></label>
                                        <textarea class="form-control" id="taskDescription" name="taskDescription" required></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="listSelection"><b>Add to list</b></label>
                                        <select class="form-control" id="listSelection" name="listSelection">
                                            <option disabled selected value>Add to list</option>
                                            <?php
                                            for ($i = 0; $i < count($lists); $i++) : ?>
                                                <option value="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title'] ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary margin10px">Create Task</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 editTask stickyNote hidden">
            <div class="card-body">
                <div class="container">
                    <div id="editTaskTitle" class="permanentMarker">
                    </div>
                    <!--update task form-->
                    <form action="/app/posts/update.php" method="POST">
                        <div class="controls">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="editTaskName"><b>Title</b></label>
                                    <input class="form-control" type="text" id="editTaskName" name="editTaskName" value="" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="editTaskDeadline"><b>Deadline</b></label>
                                    <input class="form-control" type="date" id="editTaskDeadline" name="editTaskDeadline" value="">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <label for="editTaskDescription"><b>Description</b></label>
                                    <textarea class="form-control" id="editTaskDescription" name="editTaskDescription"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="editListSelection"><b>List</b></label>
                                    <select class="form-control" id="editListSelection" name="editListSelection">
                                        <option disabled selected value><b>Move task to list:</b></option>
                                        <option value="removeFromList">(Remove from current list)</option>
                                        <?php
                                        for ($i = 0; $i < count($lists); $i++) : ?>
                                            <option value="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title'] ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="editTaskCompleted"><b>Complete/incomplete</b></label>
                                    <select class="form-control" id="editTaskCompleted" name="editTaskCompleted">
                                        <option disabled selected value>Mark as:</option>
                                        <option value="complete">Complete</option>
                                        <option value="incomplete">Incomplete</option>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" id="editTaskId" name="editTaskId" class="editTaskId" value="">
                            <div class="col-sm margin10px">
                                <button type="submit" class="btn btn-primary">Update Task</button>
                                <!--cancel edit/delete task (will hide the edit and cancel task forms)-->
                                <button class="btn btn-secondary margin10px">Cancel</button>

                            </div>
                            <!--delete task form-->

                    </form>
                    <form action="/app/posts/delete.php" method="POST">
                        <input type="hidden" id="taskIdToDelete" name="taskIdToDelete" class="editTaskId" value="">
                        <div class="col-sm"><button type="submit" class="editTaskId btn btn-danger" value="">Delete task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>




<!-- form for selecting a list to edit -->
<div class="row">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 stickyNote selectListToEdit hidden">
            <div class="card-body">
                <div class="container">
                    <h2 class="permanentMarker">Edit list</h2>
                    <form>
                        <label for="listIdToUpdate"><b>Select the list you want to edit</b></label>
                        <select id="listIdToUpdate" name="listIdToUpdate" class="form-control">
                            <option disabled selected value>Your lists:</option>
                            <?php
                            for ($i = 0; $i < count($lists); $i++) : ?>
                                <option value="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title'] ?></option>
                            <?php endfor; ?>
                        </select>
                        <button type="button" id="editList" class="btn btn-primary margin10px">Edit list</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<!--create list form-->
<div class="row">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 stickyNote createList hidden">
            <div class="card-body">
                <div class="container">
                    <h2 class="permanentMarker">Create a new list</h2>
                    <form action="/app/posts/store.php" method="POST">


                        <label for="listName"><b>Enter a list name</b></label>
                        <input type="text" class="form-control" id="listName" name="listName" required>


                        <button type="submit" class="btn btn-primary margin10px">Create List</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- form for updating / deleting a list -->
<div class="editListForms hidden">
    <form action="/app/posts/update.php" method="POST">
        <input type="hidden" id="listIdToUpdate" name="listIdToUpdate" class="editListId" value="">
        <label for="editListName">List Name</label>
        <input type="text" id="editListName" name="editListName" value="" required>
        <button type="submit">Update list</button>
    </form>
    <form action="/app/posts/delete.php" method="POST">
        <input type="hidden" id="listIdToDelete" name="listIdToDelete" class="editListId" value="">
        <input type="checkbox" id="alsoDeleteTasks" name="alsoDeleteTasks">
        <label for="alsoDeleteTasks">Also delete tasks associated with the list</label>
        <button type="submit">Delete</button>
    </form>
    <button class="btn btn-warning">Cancel</button>
</div>

<!-- do not create any spaces in the below alert divs. js is looking for content to display. -->
<div class="alert hidden alert-success" role="alert"><?php success($successMsg); ?></div>
<div class="alert hidden alert-danger" role="alert"><?php errors($errorMsg); ?></div>
<div class="alert hidden alert-warning" role="alert"><?php warnings($warningMsg); ?></div>


<form action="wunderlists.php" method="GET">
    <div class="d-flex justify-content-end">
        <div class="p-2">
            <select class="form-control" name="show">
                <option disabled selected value>Show only:</option>
                <option value="completed" name="completed">Completed</option>
                <option value="incomplete" name="incomplete">Incomplete</option>
                <option value="toDoToday" name="toDoToday">To be completed today</option>
                <option value="showAll" name="showAll">Show All</option>
            </select>
        </div>

        <div class="p-2">

            <select class="form-control" name="showListItemsOnly">
                <option disabled selected value>Filter by list:</option>
                <?php
                for ($i = 0; $i < count($lists); $i++) : ?>
                    <option value="<?php echo $lists[$i]['id'] ?>" name="<?php echo $lists[$i]['title'] ?>"><?php echo $lists[$i]['title'] ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="p-2">
            <select class="form-control" name="sort">
                <option disabled selected value>Sort by:</option>
                <option value="deadline" name="deadline">Deadline</option>
                <option value="task" name="task">Title</option>
                <option value="completed" name="completed">Completed</option>
            </select>
        </div>
        <div class="p-2">
            <button type="submit" class="btn btn-primary">Sort</button>
        </div>
    </div>
</form>


<?php
// if the user picks a "sort by" option then the usort function will compare the value selected and return the array sorted by that value.
if (isset($_GET['sort'])) {
    usort($tasks, function ($sortBy, $sorted) {
        $value = $_GET['sort'];
        return $sortBy[$value] <=> $sorted[$value];
    });
}




// if-statements that manipulate the tasks array to filter by complete/incomplete/today's date. Because showAll is not defined it will return the full list by default.
if (isset($_GET['show'])) {
    if ($_GET['show'] === 'completed') {
        $tasksCompleted = array_filter($tasks, function ($var) {
            return ($var['completed'] == '1');
        });

        $showResult = array_values($tasksCompleted);
        $tasks = $showResult;
    } elseif ($_GET['show'] === 'incomplete') {
        $tasksIncomplete = array_filter($tasks, function ($var) {
            return ($var['completed'] == '0');
        });

        $showResult = array_values($tasksIncomplete);
        $tasks = $showResult;
    } elseif ($_GET['show'] === 'toDoToday') {
        $tasksToday = array_filter($tasks, function ($var) {
            return ($var['deadline'] == date("Y-m-d"));
        });

        $showResult = array_values($tasksToday);
        $tasks = $showResult;
    }
}
// filter by list ID
if (isset($_GET['showListItemsOnly'])) {
    $tasksWithListId = array_filter($tasks, function ($var) {
        return ($var['list_id'] == $_GET['showListItemsOnly']);
    });

    $showResult = array_values($tasksWithListId);
    $tasks = $showResult;
}



?>


<div class="container corkBoard">
    <div class="row">
        <?php
        for ($i = 0; $i < count($tasks); $i++) : ?>
            <div class="stickyNote">
                <div class="col-sm permanentMarker"><b><span class="title"><?php echo $tasks[$i]['task'] ?></span></b></div>
                <div class="col-sm amatic"><span class="description"><?php echo $tasks[$i]['description'] ?></span></div>
                <div class="col-sm amatic">Deadline: <span class="deadline"><?php echo $tasks[$i]['deadline'] ?></div>
                <div class="col-sm amatic"> Completed:
                    <?php
                    if ($tasks[$i]['completed'] === '1') {
                        echo 'Yes';
                    } else {
                        echo 'No';
                    } ?>
                </div>
                <div class="col-sm amatic">Belongs to list:<span class="list" id="<?php echo $tasks[$i]['list_id'] ?>"><?php echo $tasks[$i]['title'] ?></span></div>
                <button class="editTaskButton" id="<?php echo $tasks[$i]['task_id'] ?>">Edit</button>
            </div>
        <?php endfor; ?>
    </div>
</div>
<script src="/assets/scripts/wunderlist.js"></script>
<?php
require __DIR__ . '/views/footer.php';
