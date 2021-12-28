<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['taskName'], $_POST['taskDescription'])) {
    $taskName = trim($_POST['taskName']);
    $taskDescription = trim($_POST['taskDescription']);
    $taskDeadline = $_POST['taskDeadline'];
    // $listId = ;
    $taskCompleted = false;

    $statement = $database->prepare('INSERT INTO tasks(task, description, deadline, completed, list_id) VALUES (:task, :description, :deadline, :completed, :list_id)');
    $statement->bindParam(':task', $taskName);
    $statement->bindParam(':description', $taskDescription);
    $statement->bindParam(':deadline', $taskDeadline);
    $statement->bindParam(':completed', $taskCompleted);
    $statement->bindParam(':list_id', $listId);
    $statement->execute();
}

redirect('/');
