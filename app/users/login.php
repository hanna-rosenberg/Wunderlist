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
        $_SESSION['errorMsg'] = 'The login information was invalid. Please try again.';
        redirect('/login.php');
    }

    if (password_verify($_POST['password'], $user['password'])) {
        //unset the users password to not save it anywhere
        unset($user['password']);
        $_SESSION['user'] = [
            'name' => $user['name'],
            'email' => $user['email'],
            'image' => $user['image'],
            'id' => $user['id'],
        ];
        $_SESSION['successMsg'] = 'Successfully logged in.';
    } else {
        $_SESSION['errorMsg'] = 'The login information was invalid. Please try again.';
        redirect('/login.php');
    }
}

redirect('/');
