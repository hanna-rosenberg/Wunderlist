<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';

require __DIR__ . '/views/header.php';
checkUserLoginStatus();
?>

<?php

$lists = fetchAllLists($database);
$tasks = fetchAllTasks($database);

?>


<div class="tasksParent">
    <div class="createTask stickyNote">

        <!--create task form-->
        <h2 class="permanentMarker">Create task</h2>

        <form action="/app/posts/store.php" method="POST">

            <div class="col-sm"><label for="taskName">Task name</label>
                <input class="form-control" type="text" id="taskName" name="taskName" required>
                <label for="taskName"><small class="form-text">Enter a name for your new task.</small></label>
            </div>

            <div class="col-sm"><label for="taskDescription">Task description</label>
                <textarea class="form-control" id="taskDescription" name="taskDescription" required></textarea>
                <label for="taskDescription"><small class="form-text">Enter a description for your new task.</small></label>
            </div>

            <div class="col-sm"><label for="taskDeadline">Deadline</label>
                <input class="form-control" type="date" id="taskDeadline" name="taskDeadline">
                <label for="tasDeadline"><small class="form-text">Enter a dealine date. This is optional.</small></label>
            </div>

            <div class="col-sm"><label for="listSelection">Add to list</label>
                <select class="form-control" id="listSelection" name="listSelection">
                    <option disabled selected value>Add to list</option>
                    <?php
                    for ($i = 0; $i < count($lists); $i++) : ?>
                        <option value="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title'] ?></option>
                    <?php endfor; ?>
                </select>
                <label for="taskName"><small class="form-text">You can add your task to a list (if you have one. This is optional).</small></label>
            </div>

            <button type="submit" value="submit">Create Task</button>
        </form>
    </div>
    <!--create list form-->
    Create a list<br>

    <form action="/app/posts/store.php" method="POST">

        <label for="listName">List Name</label>
        <input type="text" id="listName" name="listName" required>

        <button type="submit">Create List</button>
    </form>
    <br>

    <div class="editTask stickyNote hidden">
        <div id="editTaskTitle" class="permanentMarker">

        </div>
        <!--update task form-->
        <form action="/app/posts/update.php" method="POST">

            <label for="editTaskName">Update task name</label>
            <input class="form-control" type="text" id="editTaskName" name="editTaskName" value="" required>

            <label for="editTaskDescription">Update task description</label>
            <textarea class="form-control" id="editTaskDescription" name="editTaskDescription"></textarea>

            <label for="editTaskDeadline">Update task deadline</label>
            <input class="form-control" type="date" id="editTaskDeadline" name="editTaskDeadline" value="">

            <select class="form-control" id="editListSelection" name="editListSelection">
                <option disabled selected value>Move task to list:</option>
                <option value="removeFromList">(Remove from current list)</option>
                <?php
                for ($i = 0; $i < count($lists); $i++) : ?>
                    <option value="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title'] ?></option>
                <?php endfor; ?>
            </select>
            <select class="form-control" id="editTaskCompleted" name="editTaskCompleted">
                <option disabled selected value>Mark as:</option>
                <option value="complete">Complete</option>
                <option value="incomplete">Incomplete</option>
            </select>

            <input type="hidden" id="editTaskId" name="editTaskId" class="editTaskId" value="">

            <button type="submit">Update Task</button>
        </form>

        <!--delete task form-->
        <form action="/app/posts/delete.php" method="POST">
            <input type="hidden" id="taskIdtoDelete" name="taskIdToDelete" class="editTaskId" value="">
            <button type="submit" class="editTaskId" value="">Delete task</button>
        </form>

        <!--cancel edit/delete task (will hide the edit and cancel forms)-->
        <button id="cancel">Cancel</button>
    </div>
    <select id="userLists" name="userLists">
        <option disabled selected value>Your lists:</option>
        <?php
        for ($i = 0; $i < count($lists); $i++) : ?>
            <option value="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title'] ?></option>
        <?php endfor; ?>
    </select>
    <h2>Your tasks:</h2>



    <div class="test">test</div>


    <form action="wunderlists.php" method="GET">

        <select name="show" class="box">
            <option disabled selected value>Show only:</option>
            <option value="completed" name="completed">Completed</option>
            <option value="incomplete" name="incomplete">Incomplete</option>
            <option value="toDoToday" name="toDoToday">To be completed today</option>
            <option value="showAll" name="showAll">Show All</option>
        </select>


        <select name="showListItemsOnly" class="box">
            <option disabled selected value>Filter by list:</option>
            <?php
            for ($i = 0; $i < count($lists); $i++) : ?>
                <option value="<?php echo $lists[$i]['id'] ?>" name="<?php echo $lists[$i]['title'] ?>"><?php echo $lists[$i]['title'] ?></option>
            <?php endfor; ?>
        </select>

        <select name="sort" class="box">
            <option disabled selected value>Sort by:</option>
            <option value="deadline" name="deadline">Deadline</option>
            <option value="task" name="task">Title</option>
            <option value="completed" name="completed">Completed</option>
        </select>


        <button type="submit">Sort</button>
    </form>
    <?php
    // if the user picks a "sort by" option then the usort function will compare the value selected and return the array sorted by that value.
    if (isset($_GET['sort'])) {
        usort($tasks, function ($sortby, $sorted) {
            $value = $_GET['sort'];
            return $sortby[$value] <=> $sorted[$value];
        });
    }




    // if-statements that manilpulate the tasks array to filter by complete/incomplete/todays date. Because showAll is not defined it will return the full list by default.
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
                    <div class="col-sm amatic"> Completed: <?php
                                                            if ($tasks[$i]['completed'] === '1') {
                                                                echo 'Yes';
                                                            } else {
                                                                echo 'No';
                                                            } ?></div>
                    <div class="col-sm amatic">Belongs to list:<span class="list" id="<?php echo $tasks[$i]['list_id'] ?>"><?php echo $tasks[$i]['title'] ?></span></div>
                    <button class="editTaskButton" id="<?php echo $tasks[$i]['task_id'] ?>">Edit</button>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <?php
    echo '<pre>';
    var_dump($tasks);
    require __DIR__ . '/views/footer.php';
