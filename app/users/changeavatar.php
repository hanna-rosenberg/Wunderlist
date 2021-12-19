<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//array containing allowed file formats
$allowedFiles = [
    'image/jpeg',
    'image/jpg',
    'image/png',
];


if (isset($_FILES['avatar'])) {

    $avatar = $_FILES['avatar'];

    if (in_array($avatar['type'], $allowedFiles)) {
        //make a unique file name using date, time (including seconds) and the users unique ID along with the users file name to minimize the chance of files ending up with the same name.
        $fileDestination =  $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . date('ymd-his') . $_SESSION['user']['id'] . $avatar['name'];
        move_uploaded_file($avatar['tmp_name'], $fileDestination);
        $fileUrl = '/uploads/' . date('ymd-his') . $_SESSION['user']['id'] . $avatar['name'];
    } else {
        echo 'The file must me in a jpg, jpeg or png format. Please try again.';
    }
}
