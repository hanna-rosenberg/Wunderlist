<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete new posts in the database.

//I opted to always compare the user ID to the sessions user ID in case the forms were tampered with.

if (isset($_POST['taskIdToDelete'])) {
    $taskId = $_POST['taskIdToDelete'];
    $statement = $database->prepare('DELETE FROM tasks WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $taskId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
    $_SESSION['successMsg'][] = 'The task was successfully deleted.';
}

if (isset($_POST['listIdToDelete'])) {
    $listId = $_POST['listIdToDelete'];
    $statement = $database->prepare('DELETE FROM lists WHERE id = :id AND user_id = :user_id');
    $statement->bindParam(':id', $listId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
    $_SESSION['successMsg'][] = 'The list was successfully deleted.';

    if (isset($_POST['alsoDeleteTasks'])) {
        $statement = $database->prepare('DELETE FROM tasks WHERE list_id = :list_id AND user_id = :user_id');
        $statement->bindParam(':list_id', $listId, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
        $statement->execute();
        $_SESSION['successMsg'][] = ' The tasks related to it were also successfully deleted.';
    } else {
        // if the user decides to delete the list but keep the tasks then set their list_id to NULL
        $makeNull = null;
        $statement = $database->prepare('UPDATE tasks SET list_id = :list_id WHERE list_id = :id AND user_id = :user_id');
        $statement->bindParam(':list_id', $makeNull, PDO::PARAM_INT);
        $statement->bindParam(':id', $listId, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
        $statement->execute();
        $_SESSION['successMsg'][] = ' Any related tasks no longer belongs to a list.';
    }
}

redirect('/wunderlists.php');
