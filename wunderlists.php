<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';

require __DIR__ . '/views/header.php';
checkUserLoginStatus();
?>

<h2>Your lists:</h2>
<?php

$lists = fetchAllLists($database);

?> <ul><?php
        for ($i = 0; $i < count($lists); $i++) : ?>
        <li class="listNames"> <a href="/tasks.php?listId=<?php echo $lists[$i]['id'] ?>&listName=<?php echo $lists[$i]['title'] ?>" id="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title']; ?> </a> </li>
    <?php endfor; ?>
</ul>


<!--create list form-->
Create a list<br>

<form action="/app/posts/store.php" method="POST">

    <label for="listName">List Name</label>
    <input type="text" id="listName" name="listName" required>

    <button type="submit">Create List</button>
</form>
<br>

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
    <h2>Your tasks:</h2>
    <?php
    $tasks = fetchAllTasks($database);

    for ($i = 0; $i < count($tasks); $i++) : ?>
        <div class="task">
            <article>
                <div class="taskTitle"><b><?php echo $tasks[$i]['task'] ?></b></div>
                <div class="taskDescription"><?php echo $tasks[$i]['description'] ?></div>
                <div>Deadline: <?php echo $tasks[$i]['deadline'] ?></div>
                <div>Completed: <?php echo $tasks[$i]['completed'] ?></div>
                <button class="editTaskButton" name="<?php echo $tasks[$i]['task'] ?>" id="<?php echo $tasks[$i]['id'] ?>" value="<?php echo $tasks[$i]['description'] ?>">Edit</button>
            </article>
        <?php endfor; ?>
        </div>
        <script src="assets/scripts/app.js"></script>
        <?php

        require __DIR__ . '/views/footer.php';
