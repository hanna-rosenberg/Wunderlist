<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Allows user to delete their account along with their lists and tasks
//Match the password entered with the database and if successful, delete the account along with all lists and tasks associated with that account.

if (isset($_POST['deleteAccount'])) {
    $userId = $_SESSION['user']['id'];

    $statement = $database->prepare('SELECT * FROM users WHERE id = :id');
    $statement->bindParam(':id', $userId, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (password_verify($_POST['deleteAccount'], $user['password'])) {
        $statement = $database->prepare('DELETE FROM tasks WHERE user_id = :user_id');
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();

        $statement = $database->prepare('DELETE FROM lists WHERE user_id = :user_id');
        $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $statement->execute();

        $statement = $database->prepare('DELETE FROM users WHERE id = :id');
        $statement->bindParam(':id', $userId, PDO::PARAM_INT);
        $statement->execute();
        unset($_SESSION['user']);

        $_SESSION['successMsg'][] = 'Your account has been deleted and you are now logged out.';
        redirect('/');
    } else {
        $_SESSION['errorMsg'][] = 'Something went wrong. The account was not deleted.';
        redirect('/account.php');
    }
}

redirect('/account.php');
