<?php


if (empty($_POST['email'])) {
    $emailError = 'Please enter your email.';
} else {
    $email = trim($_POST['email']);
}

if (empty($_POST['password'])) {
    $passwordError = 'Please enter a password.';
} else {
    $password = trim($_POST['password']);
}
