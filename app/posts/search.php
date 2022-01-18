<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// if (isset($_POST['search'])) {
//     $searchedFor = ($_POST['search']);
//     $statement = $database->prepare('SELECT * FROM tasks WHERE task OR description LIKE %:search AND user_id = :user_id');
//     $statement->bindParam(':search', $searchedFor, PDO::PARAM_STR);
//     $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
//     $statement->execute();

//     $searchedTask = $statement->fetch(PDO::FETCH_ASSOC);
// }

// if (isset($_POST['search'])) {

//     $searchedFor = ($_POST['search']);
//     $searchedFor = "%$searchedFor%";

//     $statement = $database->prepare('SELECT * FROM tasks WHERE task OR description LIKE :search AND user_id = :user_id');

//     $statement->bindParam(':search', $searchedFor, PDO::PARAM_STR);
//     $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
//     $statement->execute();

//     $searchedTask = $statement->fetchAll(PDO::FETCH_ASSOC);
// }
// redirect('/wunderlists.php');
