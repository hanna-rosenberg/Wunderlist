<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete new posts in the database.

//i want to add so that it compares the user ID with the logged in users ID before it deletes anything... to be continued.
if (isset($_POST['taskIdToDelete'])) {
    $taskId = $_POST['taskIdToDelete'];
    $statement = $database->prepare('DELETE FROM tasks WHERE id = :id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->execute();
}

redirect('/wunderlists.php');
