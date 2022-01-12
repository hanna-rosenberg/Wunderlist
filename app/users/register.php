<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //check to see if the email already exists
    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $emailsFound = $statement->fetchAll(PDO::FETCH_DEFAULT);
    $result = count($emailsFound);

    if ($result > 0) {
        $_SESSION['warningMsg'][] = 'The email is already registered. Please log in or register using a different email.';
        redirect('/signup.php');
    } else {
        $statement = $database->prepare('INSERT INTO users(name, email, password, image) VALUES (:name, :email, :password, :image)');
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->execute();
        $_SESSION['successMsg'][] = 'Your account has been successfully created. Please log in.';
        redirect('/login.php');
    }
}




redirect('/signup.php');
