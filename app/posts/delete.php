<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete new posts in the database.

if (isset($_POST['taskIdToDelete'])) {
    $taskId = $_POST['taskIdToDelete'];
    $userId = $_SESSION['user']['id'];
    $statement = $database->prepare('DELETE FROM tasks WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();
}

if (isset($_POST['listIdToDelete'])) {
    $listId = $_POST['listIdToDelete'];
    $userId = $_SESSION['user']['id'];
    $statement = $database->prepare('DELETE FROM lists WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $listId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();

    if (isset($_POST['alsoDeleteTasks'])) {
        $statement = $database->prepare('DELETE FROM tasks WHERE list_id = :list_id AND user_id = :user_id');
        $statement->bindParam(':list_id', $listId, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();
    }
}

redirect('/wunderlists.php');
