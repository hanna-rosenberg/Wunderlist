<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update posts in the database.

$taskId = $_POST['taskId'];

if (isset($_POST['taskName'])) {
    $newTask = $_POST['taskName'];
    $statement = $database->prepare('UPDATE tasks SET task = :task WHERE id = :id');
    $statement->bindParam(':id', $taskId);
    $statement->bindParam(':task', $newTask);
    $statement->execute();
}

if (isset($_POST['taskDescription'])) {
    $newTaskDescription = $_POST['taskDescription'];
    $statement = $database->prepare('UPDATE tasks SET description = :description WHERE id = :id');
    $statement->bindParam(':id', $taskId);
    $statement->bindParam(':description', $newTaskDescription);
    $statement->execute();
}

if (isset($_POST['taskDeadline'])) {
    $newTaskDeadline = $_POST['taskDeadline'];
    $statement = $database->prepare('UPDATE tasks SET deadline = :deadline WHERE id = :id');
    $statement->bindParam(':id', $taskId);
    $statement->bindParam(':deadline', $newTaskDeadline);
    $statement->execute();
}

if (isset($_POST['listSelection'])) {
    $newListId = $_POST['listSelection'];
    $statement = $database->prepare('UPDATE tasks SET list_id = :list_id WHERE id = :id');
    $statement->bindParam(':id', $taskId);
    $statement->bindParam(':list_id', $newListId);
    $statement->execute();
}

redirect('/wunderlists.php');
