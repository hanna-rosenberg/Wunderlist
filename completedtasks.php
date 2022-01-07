<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';

require __DIR__ . '/views/header.php';
checkUserLoginStatus();
?>

<?php

$lists = fetchAllLists($database);
$completed = showCompletedOnly($database);

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

            <label for="listSelection">Add task to a list (optional)</label>
            <select id="listSelection" name="listSelection">
                <option value=""> </option>
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

            <label for="editListSelection">Move task to list (optional)</label>
            <select id="editListSelection" name="editListSelection">
                <option value="keepInList"> </option>
                <option value="removeFromList">(Remove from list)</option>
                <?php
                for ($i = 0; $i < count($lists); $i++) : ?>
                    <option value="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title'] ?></option>
                <?php endfor; ?>
            </select>
            <label for="editTaskCompleted">Mark as completed?</label>
            <input type="checkbox" name="editTaskCompleted" id="editTaskCompleted" value="">

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
            <li class="listNames"> <a href="/tasks.php?listId=<?php echo $lists[$i]['id'] ?>&listName=<?php echo $lists[$i]['title'] ?>" id="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title']; ?> </a> </li>
        <?php endfor; ?>
    </ul>
    <h2>Your tasks:</h2>
    <h3>Sort by:</h3>





    <form action="wunderlists.php" method="GET">
        <p><input type="radio" id="female" name="gender" value="female">
            <label for="female" id="radio-label">Females</label>
        </p>
        <p><input type="radio" id="male" name="gender" value="male">
            <label for="male">Males</label>
        </p>
        <p> <input type="radio" id="all" name="gender" value="all">
            <label for="all">Show All</label>
        </p>

        <select name="sort" class="box">
            <option disabled selected value>Sort by:</option>
            <option value="deadline" name="deadline">Deadline</option>
            <option value="age" name="Age">Age</option>
            <option value="eye color" name="Eye color">Eye color</option>
            <option value="fur color" name="Fur color">Fur color</option>
        </select>
        <button type="submit">Sort</button>
    </form>

    <p><?php
        // if-statements looking at whether the user as selected male or female cats. "show all" does nothing which by result resets the choice to null.
        if (isset($_GET['gender'])) {
            if ($_GET['gender'] === 'female') {
                $catsByGender = array_filter($cats, function ($var) use ($femaleCats) {
                    return ($var['gender'] == $femaleCats);
                });

                $catsByGenderResult = array_values($catsByGender);
                $cats = $catsByGenderResult;
            } elseif ($_GET['gender'] === 'male') {
                $catsByGender = array_filter($cats, function ($var) use ($maleCats) {
                    return ($var['gender'] == $maleCats);
                });

                $catsByGenderResult = array_values($catsByGender);
                $cats = $catsByGenderResult;
            }
            $gender = $_GET['gender'];
            echo "Showing cats where gender = $gender. ";
        }
        // if the user picks a "sort by" option then the usort function will compare the value selected and return the array sorted by that value.
        if (isset($_GET['sort'])) {
            usort($tasks, function ($sortby, $sorted) {
                $value = $_GET['sort'];
                return $sortby[$value] <=> $sorted[$value];
            });
            echo "sorted by " . $_GET['sort'] . ".";
        }
        ?> </p>


    Lists, Completed, Deadline, To be completed today
    <div class="container corkBoard">
        <div class="row">
            <?php
            for ($i = 0; $i < count($completed); $i++) : ?>
                <div class="stickyNote">
                    <div class="col-sm permanentMarker"><b><?php echo $completed[$i]['task'] ?></b></div>
                    <div class="col-sm amatic"><?php echo $completed[$i]['description'] ?></div>
                    <div class="col-sm amatic">Deadline: <?php echo $completed[$i]['deadline'] ?></div>
                    <div class="col-sm amatic"> Completed: <?php echo $completed[$i]['completed'] ?></div>
                    <div class="col-sm amatic"><button class="editTaskButton" name="<?php echo $completed[$i]['task'] ?>" id="<?php echo $completed[$i]['id'] ?>" value="<?php echo $completed[$i]['description'] ?>">Edit</button></div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <script src="assets/scripts/app.js"></script>
    <?php
    var_dump($completed);
    require __DIR__ . '/views/footer.php';
