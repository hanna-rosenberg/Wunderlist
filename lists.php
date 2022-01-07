<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';

require __DIR__ . '/views/header.php';
checkUserLoginStatus();

?>

<div class="list-with-task">

    <h1><?php echo $_GET['listName'] ?> </h1>

    Create a task<br>

    <form action="/app/users/createtask.php" method="POST">

        <label for="taskName">Task name</label>
        <input type="text" id="taskName" name="taskName" required>

        <label for="taskDescription">Task description</label>
        <input type="text" id="taskDescription" name="taskDescription" required>

        <label for="taskDeadline">Deadline</label>
        <input type="date" id="taskDeadline" name="taskDeadline">

        <input type="hidden" id="listId" name="listId" value="<?php echo $_GET['listId']; ?>">

        <input type="hidden" id="listName" name="listName" value="<?php echo $_GET['listName']; ?>">

        <button type="submit">Create Task</button>
    </form>
    <br>
</div>


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
                <div class="col-sm amatic"><button class="editTaskButton" name="<?php echo $tasks[$i]['task'] ?>" id="<?php echo $tasks[$i]['id'] ?>" value="<?php echo $tasks[$i]['description'] ?>">Edit</button></div>
            </div>
        <?php endfor; ?>
    </div>
</div>


<?php
require __DIR__ . '/views/footer.php';
