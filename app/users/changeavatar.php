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
        $statement->bindParam(':image', $fileUrl);
        $statement->execute();
        redirect('/account.php');
    } else {
        echo 'The file must me in a jpg or png format. Please try again.';
    }
}
