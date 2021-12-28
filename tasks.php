<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';

require __DIR__ . '/views/header.php';


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

<?php

$statement = $database->prepare('SELECT * FROM tasks WHERE list_id = :list_id');
$statement->bindParam(':list_id', $_GET['listId']);

$statement->execute();

$tasks = $statement->fetchAll(PDO::FETCH_DEFAULT); ?>

<ul><?php
    for ($i = 0; $i < count($tasks); $i++) : ?>
        <li class="task-names"> <?php echo $tasks[$i]['task'] . $tasks[$i]['description'] . $tasks[$i]['deadline'] ?> </li>
    <?php endfor; ?>
</ul>

<?php

require __DIR__ . '/views/footer.php';
