<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['password'])) {
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $statement = $database->prepare('UPDATE users SET password = :password WHERE id = :id');
    $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
    $statement->bindParam(':password', $newPassword);
    $statement->execute();
}



redirect('/');
