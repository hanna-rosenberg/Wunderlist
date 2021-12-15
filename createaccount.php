<?php

declare(strict_types=1);
require_once('header.php');
require_once "config.php";


?>

<!--login form-->
<div class="createAccount">
    Create an account:
    <form>
    </form action="createaccount.php" method="POST">

    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Create Account</button>
</div>

<?php

if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
}
?>


<?php require_once('footer.php'); ?>
