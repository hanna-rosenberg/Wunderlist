<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update posts in the database.

$taskId = $_POST['editTaskId'];

if (isset($_POST['editTaskName'])) {
    $newTask = $_POST['editTaskName'];
    $statement = $database->prepare('UPDATE tasks SET task = :task WHERE id = :id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':task', $newTask, PDO::PARAM_STR);
    $statement->execute();
}

if (isset($_POST['editTaskDescription'])) {
    $newTaskDescription = $_POST['editTaskDescription'];
    $statement = $database->prepare('UPDATE tasks SET description = :description WHERE id = :id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':description', $newTaskDescription, PDO::PARAM_STR);
    $statement->execute();
}

if (isset($_POST['editTaskDeadline'])) {
    $newTaskDeadline = $_POST['editTaskDeadline'];
    $statement = $database->prepare('UPDATE tasks SET deadline = :deadline WHERE id = :id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':deadline', $newTaskDeadline, PDO::PARAM_STR);
    $statement->execute();
}

if (isset($_POST['editListSelection'])) {
    $newListId = $_POST['editListSelection'];
    if (is_numeric($newListId)) {
        //have to convert string to integer
        $newListIdInt = (int)$newListId;
        $statement = $database->prepare('UPDATE tasks SET list_id = :list_id WHERE id = :id');
        $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
        $statement->bindParam(':list_id', $newListIdInt, PDO::PARAM_INT);
        $statement->execute();
        echo 'is numeric worked';
    } elseif ($newListId === 'removeFromList') {
        $newListId = null;
        $statement = $database->prepare('UPDATE tasks SET list_id = :list_id WHERE id = :id');
        $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
        $statement->bindParam(':list_id', $newListId, PDO::PARAM_INT);
        $statement->execute();
        echo 'removed from list';
    }
}

if (isset($_POST['editTaskCompleted'])) {
    $completed = true;
    $statement = $database->prepare('UPDATE tasks SET completed = :completed WHERE id = :id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':completed', $completed, PDO::PARAM_BOOL);
    $statement->execute();
}

//redirect('/wunderlists.php');
