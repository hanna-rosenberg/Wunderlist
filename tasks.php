<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';

require __DIR__ . '/views/header.php';


?>

<div class="list-with-task">

    <h1>list name placeholder</h1>

    Create a task<br>

    <form action="/app/users/createtask.php" method="POST">

        <label for="taskName">Task name</label>
        <input type="text" id="taskName" name="taskName" required>

        <label for="taskDescription">Task description</label>
        <input type="text" id="taskDescription" name="taskDescription" required>

        <label for="taskDeadline">Deadline</label>
        <input type="date" id="taskDeadline" name="taskDeadline">

        <button type="submit">Create Task</button>
    </form>
    <br>
</div>

<?php

echo $_GET['tasks'];
require __DIR__ . '/views/footer.php';
