<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
if (isset($_POST['email'])) {

    $newEmail = $_POST['email'];
    $statement = $database->prepare('UPDATE users SET email = :email WHERE id = :id');
    $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->bindParam(':email', $newEmail, PDO::PARAM_STR);
    $statement->execute();
    redirect('/account.php');
}



redirect('/');
