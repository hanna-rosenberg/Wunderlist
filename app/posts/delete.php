<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete new posts in the database.

//i want to add so that it compares the user ID with the logged in users ID before it deletes anything... to be continued.
if (isset($_POST['taskIdToDelete'])) {
    $taskId = $_POST['taskIdToDelete'];
    $userId = $_SESSION['user']['id'];
    $statement = $database->prepare('DELETE FROM tasks WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->execute();
}

redirect('/wunderlists.php');
