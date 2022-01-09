<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update posts in the database.
//I opted to always compare the user ID to the sessions user ID in case the forms were tampered with.

$taskId = $_POST['editTaskId'];

if (isset($_POST['editTaskName'])) {
    $newTask = $_POST['editTaskName'];
    $statement = $database->prepare('UPDATE tasks SET task = :task WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':task', $newTask, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
}

if (isset($_POST['editTaskDescription'])) {
    $newTaskDescription = $_POST['editTaskDescription'];
    $statement = $database->prepare('UPDATE tasks SET description = :description WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':description', $newTaskDescription, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
}

if (isset($_POST['editTaskDeadline'])) {
    $newTaskDeadline = $_POST['editTaskDeadline'];
    $statement = $database->prepare('UPDATE tasks SET deadline = :deadline WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':deadline', $newTaskDeadline, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
}

if (isset($_POST['editListSelection'])) {
    $newListId = $_POST['editListSelection'];
}
if ($newListId === 'removeFromList') {
    $newListId = null;
    $statement = $database->prepare('UPDATE tasks SET list_id = :list_id WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':list_id', $newListId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
} else {
    //have to convert string to integer
    $newListIdInt = (int)$newListId;
    $statement = $database->prepare('UPDATE tasks SET list_id = :list_id WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':list_id', $newListIdInt, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
}


if (isset($_POST['editTaskCompleted'])) {
    if (($_POST['editTaskCompleted'] === 'complete')) {
        $completed = 1;
        $statement = $database->prepare('UPDATE tasks SET completed = :completed WHERE id = :id AND user_id = :user_id');
        $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
        $statement->bindParam(':completed', $completed, PDO::PARAM_BOOL);
        $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
        $statement->execute();
    } elseif (($_POST['editTaskCompleted'] === 'incomplete')) {
        $completed = 0;
        $statement = $database->prepare('UPDATE tasks SET completed = :completed WHERE id = :id AND user_id = :user_id');
        $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
        $statement->bindParam(':completed', $completed, PDO::PARAM_BOOL);
        $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
        $statement->execute();
    }
}

if (isset($_POST['editListName'])) {
    $listName = trim($_POST['editListName']);
    $listId = $_POST['listIdToUpdate'];
    $statement = $database->prepare('UPDATE lists SET title = :title WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $listId, PDO::PARAM_INT);
    $statement->bindParam(':title', $listName, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
}

redirect('/wunderlists.php');
