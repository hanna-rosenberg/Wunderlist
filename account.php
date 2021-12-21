<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';


?>

<h3>Name</h3> <?php echo $_SESSION['user']['name'];  ?> <br>
<h3>Email</h3> <?php echo $_SESSION['user']['email'];  ?>
<!-- change email form -->

<form action="/app/users/changeemail.php" method="POST">

    <label for="email">New email:</label>
    <input type="email" id="email" name="email" required>

    <button type="submit">Change email</button>
</form>

<br>

<h3>Password</h3>

<!-- change password form -->


<form action="/app/users/changepassword.php" method="POST">

    <label for="password">New password:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Change password</button>
</form>



<h3>Avatar</h3> <img src="<?php echo $_SESSION['user']['image']; ?>">

<!-- change password form -->
<form action="/app/users/changeavatar.php" method="post" enctype="multipart/form-data">
    <div>
        <label for="avatar">Choose a PNG/JPG image to upload</label>
        <input type="file" name="avatar" id="avatar" required>
    </div>
    <button type="submit" class="change-avatar">Upload</button>
</form>


<br>
<?php echo $_SESSION['user']['id']; ?>
<?php
require __DIR__ . '/views/footer.php'; ?>
