<?php

declare(strict_types=1);
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';


?>

<!--login form-->
<div class="createAccount">
    Create an account:
    <form>
    </form action="/app/users/register.php" method="POST">

    <label for="name">Name</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Create Account</button>
</div>

<?php
require __DIR__ . '/views/footer.php'; ?>
