<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Check if both email and password exists in the POST request.
if (isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);

    // Prepare, bind email parameter and execute the database query.
    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    // Fetch the user as an associative array.
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // If we couldn't find the user in the database, redirect back to the login
    // page with our custom redirect function.
    if (!$user) {
        redirect('/login.php');
    }

    if (password_verify($_POST['password'], $user['password'])) {

        unset($user['password']);

        $_SESSION['user'] = [
            'name' => $user['name'],
            'email' => $user['email'],
            'image' => $user['image'],
            'id' => $user['id']
        ];
    } else {
        redirect('/login.php');
    }
}

// We should put this redirect in the end of this file since we always want to
// redirect the user back from this file. We don't know
redirect('/');
