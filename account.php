<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
checkUserLoginStatus();

?>

<h1>Account settings</h1>

<div class="container d-flex">
    <div class="p-3">
        <div class="d-flex align-items-center">
            <div> <img src="<?php echo userAvatar(); ?>" width="300"> </div>
            <div class="ml-3 w-100">
                <h3 class="mb-0 mt-0"><?php echo $_SESSION['user']['name'];  ?></h3> <span><?php echo $_SESSION['user']['email'];  ?></span>

            </div>
        </div>
    </div>
</div>

<h2>Change account settings</h2>
<!-- change email form -->
<h3>Update email</h3>
<div class="mb-3">
    <form action="/app/users/updateaccount.php" method="POST">

        <input class="form-control" type="email" id="email" name="email" required>
        <label for="email"> <small class="form-text">Enter a new email.</small></label>
        <div><button class="btn btn-primary" type="submit">Change email</button></div>
    </form>

</div>


<h3>Password</h3>

<!-- change password form -->

<div class="mb-3">
    <form action="/app/users/updateaccount.php" method="POST">

        <input class="form-control" type="password" id="password" name="password" minlength="8" required>
        <label for="password"><small class="form-text">Enter a new password.</small></label>
        <div><button class="btn btn-primary" type="submit">Change password</button></div>
    </form>

</div>

<!-- change avatar form -->
<div class="mb-3">
    <form action="/app/users/updateaccount.php" method="post" enctype="multipart/form-data">

        <input class="form-control" type="file" name="avatar" id="avatar" required>
        <label for="avatar" class="form-label"><small class="form-text">Choose a PNG/JPG image to upload</small></label>
        <div><button class="btn btn-primary" type="submit" class="change-avatar">Upload</button></div>
    </form>
</div>



<!-- delete account form -->
<div class="mb-3">
    <form action="/app/users/deleteaccount.php" method="post">

        <label for="deleteAccount">
            <h3>Delete account</h3> (this can not be undone)
        </label>

        <input class="form-control" type="password" name="deleteAccount" required>
        <label for="deleteAccount"><small class="form-text">Enter your password to confirm</small></label>

        <div><button class="btn btn-primary" type="submit">Delete my account</button></div>
    </form>
</div>
<br>
<?php dialogues($dialogues); ?>
<?php
require __DIR__ . '/views/footer.php'; ?>
