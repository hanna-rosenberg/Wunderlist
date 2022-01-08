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
    <div class="createTask">

        <!--create task form-->
        Create a task<br>

        <form action="/app/posts/store.php" method="POST">

            <label for="taskName">Task name</label>
            <input type="text" id="taskName" name="taskName" required>

            <label for="taskDescription">Task description</label>
            <textarea id="taskDescription" name="taskDescription" required></textarea>

            <label for="taskDeadline">Deadline</label>
            <input type="date" id="taskDeadline" name="taskDeadline"><br>

            <select id="listSelection" name="listSelection">
                <option disabled selected value>Add to list (optional)</option>
                <?php
                for ($i = 0; $i < count($lists); $i++) : ?>
                    <option value="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title'] ?></option>
                <?php endfor; ?>
            </select>

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

    <div class="editTask hidden">
        <div id="editTaskTitle">
            <h2>test</h2>
        </div>
        <!--update task form-->
        <form action="/app/posts/update.php" method="POST">

            <label for="editTaskName">Update task name</label>
            <input type="text" id="editTaskName" name="editTaskName" value="" required>

            <label for="editTaskDescription">Update task description</label>
            <textarea id="editTaskDescription" name="editTaskDescription"></textarea>

            <label for="editTaskDeadline">Update task deadline</label>
            <input type="date" id="editTaskDeadline" name="editTaskDeadline">

            <select id="editListSelection" name="editListSelection">
                <option disabled selected value>Move task to list:</option>
                <option value="removeFromList">(Remove from list)</option>
                <?php
                for ($i = 0; $i < count($lists); $i++) : ?>
                    <option value="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title'] ?></option>
                <?php endfor; ?>
            </select>
            <select id="editTaskCompleted" name="editTaskCompleted">
                <option disabled selected value>Mark as:</option>
                <option value="complete">Complete</option>
                <option value="incomplete">Incomplete</option>
            </select>

            <input type="hidden" id="editTaskId" name="editTaskId" class="editTaskId" value="">

            <button type="submit">Update Task</button>
        </form>
        <br>Or<br>
        <!--delete task form-->
        <form action="/app/posts/delete.php" method="POST">
            <input type="hidden" id="taskIdtoDelete" name="taskIdToDelete" class="editTaskId" value="">
            <button type="submit" class="editTaskId" value="">Delete task</button>
        </form>
        <br>
        Or
        <br>
        <!--cancel edit/delete task (will hide the edit and cancel forms)-->
        <button id="cancel">Cancel</button>
    </div>
    <h2>Your lists:</h2>
    <ul><?php
        for ($i = 0; $i < count($lists); $i++) : ?>
            <li class="listNames"> <a href="/lists.php?listId=<?php echo $lists[$i]['id'] ?>&listName=<?php echo $lists[$i]['title'] ?>" id="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title']; ?> </a> </li>
        <?php endfor; ?>
    </ul>
    <h2>Your tasks:</h2>






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




    // if-statements that manilpulate the tasks array to filter by complete/incomplete/todays date
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
                    <div class="col-sm permanentMarker"><b><?php echo $tasks[$i]['task'] ?></b></div>
                    <div class="col-sm amatic"><?php echo $tasks[$i]['description'] ?></div>
                    <div class="col-sm amatic">Deadline: <?php echo $tasks[$i]['deadline'] ?></div>
                    <div class="col-sm amatic"> Completed: <?php
                                                            if ($tasks[$i]['completed'] === '1') {
                                                                echo 'Yes';
                                                            } else {
                                                                echo 'No';
                                                            } ?></div>
                    <div class="col-sm amatic">Belongs to list: <?php echo $tasks[$i]['title'] ?></div>
                    <button class="editTaskButton" name="<?php echo $tasks[$i]['task'] ?>" id="<?php echo $tasks[$i]['task_id'] ?>" value="<?php echo $tasks[$i]['description'] ?>">Edit</button>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <?php
    echo '<pre>';
    var_dump($tasks);
    require __DIR__ . '/views/footer.php';
