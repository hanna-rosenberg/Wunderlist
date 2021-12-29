<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';

require __DIR__ . '/views/header.php';


?>

<h2>Your lists:</h2>
<?php
$statement = $database->prepare('SELECT * FROM lists WHERE user_id = :user_id');
$statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_STR);
$statement->execute();

$lists = $statement->fetchAll(PDO::FETCH_DEFAULT);

?> <ul><?php
        for ($i = 0; $i < count($lists); $i++) : ?>
        <li class="list-names"> <a href="/tasks.php?listId=<?php echo $lists[$i]['id'] ?>&listName=<?php echo $lists[$i]['title'] ?>" id="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title']; ?> </a> </li>
    <?php endfor; ?>
</ul>

Create a list<br>

<form action="/app/users/createlist.php" method="POST">

    <label for="listName">List Name</label>
    <input type="text" id="listName" name="listName" required>

    <button type="submit">Create List</button>
</form>
<br>

<div class="tasks-parent">

    <h2>Tasks </h2>

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


$statement = $database->prepare('SELECT * FROM tasks WHERE user_id = :user_id');
$statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_STR);
$statement->execute();

$tasks = $statement->fetchAll(PDO::FETCH_DEFAULT);


for ($i = 0; $i < count($tasks); $i++) : ?>
    <div class="task">
        <article>
            <div><b><?php echo $tasks[$i]['task'] ?></b></div>
            <div><?php echo $tasks[$i]['description'] ?></div>
            <div>Deadline: <?php echo $tasks[$i]['deadline'] ?></div>
            <div>Completed: <?php echo $tasks[$i]['completed'] ?></div>
            <button>Edit</button>
        </article>
    <?php endfor; ?>

    <?php

    require __DIR__ . '/views/footer.php';
