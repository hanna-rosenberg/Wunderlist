<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store/insert new posts in the database.

//task logic
if (isset($_POST['taskName'], $_POST['taskDescription'])) {
    $taskName = trim(filter_var($_POST['taskName'], FILTER_SANITIZE_STRING));
    $taskDescription = trim(filter_var($_POST['taskDescription'], FILTER_SANITIZE_STRING));
    $taskDeadline = trim(filter_var($_POST['taskDeadline'], FILTER_SANITIZE_STRING));
    $taskCompleted = 0;

    $listId = trim(filter_var($_POST['listSelection'], FILTER_SANITIZE_STRING));
    $listIdInt = (int)$listId;

    $statement = $database->prepare('INSERT INTO tasks(task, description, deadline, completed, user_id, list_id) VALUES (:task, :description, :deadline, :completed, :user_id, :list_id)');
    $statement->bindParam(':task', $taskName, PDO::PARAM_STR);
    $statement->bindParam(':description', $taskDescription, PDO::PARAM_STR);
    $statement->bindParam(':deadline', $taskDeadline, PDO::PARAM_STR);
    $statement->bindParam(':completed', $taskCompleted, PDO::PARAM_BOOL);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->bindParam(':list_id', $listId, PDO::PARAM_INT);
    $statement->execute();
    $_SESSION['successMsg'][] = 'The task "' . $taskName . '" was successfully created.';
}


//list logic
if (isset($_POST['listName'])) {
    $listName = trim(filter_var($_POST['listName'], FILTER_SANITIZE_STRING));
    $statement = $database->prepare('INSERT INTO lists(title, user_id) VALUES (:title, :user_id)');
    $statement->bindParam(':title', $listName, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
    $_SESSION['successMsg'][] = 'The list "' . $listName . '" was successfully created.';
}

redirect('/wunderlists.php');
