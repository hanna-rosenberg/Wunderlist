<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';


?>

<h3>Name</h3> <?php echo $_SESSION['user']['name'];  ?> <br>
<h3>Email</h3> <?php echo $_SESSION['user']['email'];  ?> <button class="change-email">Change Email</button>
<!-- change email form -->

<form action="" method="POST">

    <label for="name">New email:</label>
    <input type="email" id="email" name="email" required>

    <button type="submit">Change email</button>
</form>

<br>
<h3>Password</h3> <button class="change-password">Change password</button><br>
<h3>Avatar</h3> <img src="<?php echo $_SESSION['user']['image']; ?>"><button class="change-avatar">Change avatar</button>

<br>
<?php echo $_SESSION['user']['id']; ?>
<?php
require __DIR__ . '/views/footer.php'; ?>
