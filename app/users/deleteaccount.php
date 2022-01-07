<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Allows user to delete their account along with their lists and tasks

if (isset($_POST['deleteAccount'], $_POST['email'])) {
    $deleteMe = $_POST['deleteAccount'];
    $emailInput = trim($_POST['email']);
    $userId = $_SESSION['user']['id'];
    $userEmail = $_SESSION['user']['email'];
    //check to see that the ID fetched from the form is the same as the session ID to prevent accidents
    if (($deleteMe === $userId) && ($emailInput === $userEmail)) {
        $statement = $database->prepare('DELETE FROM tasks WHERE user_id = :user_id');
        $statement->bindParam(':id', $userId, PDO::PARAM_INT);
        $statement->execute();

        $statement = $database->prepare('DELETE FROM lists WHERE user_id = :user_id');
        $statement->bindParam(':id', $userId, PDO::PARAM_INT);
        $statement->execute();

        $statement = $database->prepare('DELETE FROM users WHERE email = :email AND id = :id');
        $statement->bindParam(':id', $userId, PDO::PARAM_INT);
        $statement->bindParam(':email', $userEmail, PDO::PARAM_STR);
        $statement->execute();
        unset($_SESSION['user']);
        $_SESSION['dialogues'][] = 'Your account has been deleted and you are now logged out.';
        redirect('/');
    } else {
        $_SESSION['dialogues'][] = 'Something went wrong. The account was not deleted.';
        redirect('/account.php');
    }
}

redirect('/account.php');
