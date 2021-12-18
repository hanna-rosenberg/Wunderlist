<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['listName'])) {
    $listName = trim($_POST['listName']);
    $userId = $_SESSION['user']['id'];
    $statement = $database->prepare('INSERT INTO lists(title, user_id) VALUES (:title, :user_id)');
    $statement->bindParam(':title', $listName);
    $statement->bindParam(':user_id', $userId);
    $statement->execute();
}

redirect('/');
