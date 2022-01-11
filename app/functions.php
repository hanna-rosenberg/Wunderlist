<?php

declare(strict_types=1);


function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}


function fetchAllTasks($database)
//SELECT lists.id, title, tasks.id AS task_id, tasks.user_id, tasks.list_id, tasks.task, tasks.description, tasks.deadline, tasks.completed
//FROM tasks
//LEFT JOIN lists
//ON tasks.list_id = lists.id
//AND tasks.user_id = lists.user_id
//WHERE tasks.user_id = 1;
{
    //$statement = $database->prepare('SELECT * FROM tasks LEFT JOIN lists ON tasks.list_id=lists.id AND tasks.user_id=lists.user_id WHERE tasks.user_id = :user_id');
    $statement = $database->prepare('SELECT lists.id, title, tasks.id AS task_id, tasks.user_id, tasks.list_id, tasks.task, tasks.description, tasks.deadline, tasks.completed FROM tasks LEFT JOIN lists ON tasks.list_id = lists.id AND tasks.user_id = lists.user_id  WHERE tasks.user_id = :user_id');
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $tasks;
}


function fetchAllLists($database)
{
    $statement = $database->prepare('SELECT * FROM lists WHERE user_id = :user_id');
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->execute();
    $lists = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $lists;
}

//store messages to user, such as errors and confirmation dialogues. deletes them after.
function errors($errorMsg)
{
    $errorMsgs = $_SESSION['errorMsg'];

    foreach ($errorMsgs as $errorMsg) {
        echo  $errorMsg;
    };

    unset($_SESSION['errorMsg']);
}

function success($successMsg)
{
    $successMsgs = $_SESSION['successMsg'];
    foreach ($successMsgs as $successMsg) {
        echo  $successMsg;
    };
    unset($_SESSION['successMsg']);
}

function warnings($warningMsg)
{
    $warningMsgs = $_SESSION['warningMsg'];
    foreach ($warningMsgs as $warningMsg) {
        echo  $warningMsg;
    };
    unset($_SESSION['warningMsg']);
}

function checkUserLoginStatus()
{
    if (is_null($_SESSION['user'])) {
        $_SESSION['dialogues'][] = 'Please log in first.';
        redirect('/login.php');
    }
}

function userAvatar()
{
    if (is_null($_SESSION['user']['image'])) {
        $userAvatar = '/uploads/placeholder.jpg';
        return $userAvatar;
    } else {
        return $_SESSION['user']['image'];
    }
}

function showCompletedOnly($database)
{
    $completed = 1;
    $statement = $database->prepare('SELECT * FROM tasks WHERE user_id = :user_id AND completed = :completed');
    $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
    $statement->bindParam(':completed', $completed, PDO::PARAM_BOOL);
    $statement->execute();
    $completedTasks = $statement->fetchAll(PDO::FETCH_DEFAULT);
    return $completedTasks;
}


function sortBy()
{
    if (isset($_GET['sort'])) {
        usort($tasks, function ($sortby, $sorted) {
            $value = $_GET['sort'];
            return $sortby[$value] <=> $sorted[$value];
        });
    }
}
