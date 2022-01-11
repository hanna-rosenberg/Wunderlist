<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';


?>

<!--login form-->
<div class="createAccount">
    Create an account:

    <form action="/app/users/register.php" method="POST">

        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" minlength="8" required>

        <button type="submit">Create Account</button>
    </form>
    <!-- do not create any spaces in the below alert divs. js is looking for content to display. -->
    <div class="alert hidden alert-success" role="alert"><?php success($successMsg); ?></div>
    <div class="alert hidden alert-danger" role="alert"><?php errors($errorMsg); ?></div>
    <div class="alert hidden alert-warning" role="alert"><?php warnings($warningMsg); ?></div>
</div>

<?php
require __DIR__ . '/views/footer.php'; ?>
