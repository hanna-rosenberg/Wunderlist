<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $placeholderImg = '/uploads/placeholder.jpg';
    $statement = $database->prepare('INSERT INTO users(name, email, password, image) VALUES (:name, :email, :password, :image)');
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':image', $placeholderImg, PDO::PARAM_STR);
    $statement->execute();
}




redirect('/');
