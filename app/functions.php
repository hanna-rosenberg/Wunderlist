<?php

declare(strict_types=1);


function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}


function fetchAllTasks($database)
{
    $statement = $database->prepare('SELECT * FROM tasks WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
    $tasks = $statement->fetchAll(PDO::FETCH_DEFAULT);
    return $tasks;
}


function fetchAllLists($database)
{
    $statement = $database->prepare('SELECT * FROM lists WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
    $lists = $statement->fetchAll(PDO::FETCH_DEFAULT);
    return $lists;
}
