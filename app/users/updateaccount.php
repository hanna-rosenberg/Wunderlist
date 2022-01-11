<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//array containing allowed file formats
$allowedFiles = [
    'image/jpeg',
    'image/png',
];


if (isset($_FILES['avatar'])) {

    $avatar = $_FILES['avatar'];

    //check to see if the avatar is of the correct file type
    if (in_array($avatar['type'], $allowedFiles)) {
        //make a unique file name using date, time (including seconds) and the users unique ID along with the users file name to minimize the chance of files ending up with the same name.
        $fileDestination =  $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . date('ymd-his') . $_SESSION['user']['id'] . $avatar['name'];
        move_uploaded_file($avatar['tmp_name'], $fileDestination);
        //prepare a url that can be inserted in to the database
        $fileUrl = '/uploads/' . date('ymd-his') . $_SESSION['user']['id'] . $avatar['name'];
        //match the user ID and insert the image url to the correct user
        $statement = $database->prepare('UPDATE users SET image = :image WHERE id = :id');
        $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_STR);
        $statement->bindParam(':image', $fileUrl, PDO::PARAM_STR);
        $statement->execute();
        $_SESSION['user']['image'] = $fileUrl;
        $_SESSION['successMsg'][] = 'Your avatar has been updated.';
    } else {
        $_SESSION['warningMsg'][] = 'The file must me in a jpg or png format. Please try again.';
    }
}


if (isset($_POST['email'])) {
    $newEmail = trim($_POST['email']);
    //check to see if the email already exists
    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $newEmail, PDO::PARAM_STR);
    $statement->execute();
    $emailsFound = $statement->fetchAll(PDO::FETCH_DEFAULT);
    $result = count($emailsFound);
    if ($result > 0) {
        $_SESSION['errorMsg'][] = 'Something went wrong. Please try again.';
        redirect('/account.php');
    } else {
        $statement = $database->prepare('UPDATE users SET email = :email WHERE id = :id');
        $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
        $statement->bindParam(':email', $newEmail, PDO::PARAM_STR);
        $statement->execute();
        $_SESSION['user']['email'] = $newEmail;
        $_SESSION['successMsg'][] = 'Your email has been updated.';
    }
}



if (isset($_POST['password'])) {
    //added extra check to see that the password is 8 characters or more if in case the user manually changed the html.
    $passwordLenght = strlen($_POST['password']);
    if ($passwordLenght < 7) {
        $_SESSION['warningMsg'][] = 'Your need to be at least 8 characters long. Please try again.';
        redirect('/account.php');
    } else {
        $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $statement = $database->prepare('UPDATE users SET password = :password WHERE id = :id');
        $statement->bindParam(':id', $_SESSION['user']['id'], PDO::PARAM_INT);
        $statement->bindParam(':password', $newPassword, PDO::PARAM_STR);
        $statement->execute();
        unset($user['password']);
        $_SESSION['successMsg'][] = 'Your password has been updated.';
    }
}

redirect('/account.php');
