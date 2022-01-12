<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
checkUserLoginStatus();

?>

<div class="row">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4">
            <div class="card-body">
                <div class="container">

                    <img src="<?php echo userAvatar(); ?>" width="300">

                    <h3 class="mb-0 mt-0"><?php echo $_SESSION['user']['name'];  ?></h3> <span><?php echo $_SESSION['user']['email'];  ?></span><br>

                    <?php
                    if (isset($_SESSION['successMsg'])) : ?>
                        <div class="alert alert-success" role="alert"><?php success($successMsg); ?></div>
                    <?php endif;
                    if (isset($_SESSION['errorMsg'])) : ?>
                        <div class="alert alert-danger" role="alert"><?php success($errorMsg); ?></div>
                    <?php endif;
                    if (isset($_SESSION['warningMsg'])) : ?>
                        <div class="alert alert-warning" role="alert"><?php success($warningMsg); ?>
                        </div>
                    <?php endif; ?>


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

                    <h3>Avatar</h3>
                    <!-- change avatar form -->
                    <div class="mb-3">
                        <form action="/app/users/updateaccount.php" method="post" enctype="multipart/form-data">
                            <label for="avatar" class="fileUpload"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z" />
                                    <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z" />
                                </svg> Select a file to upload

                            </label><input class="form-control" type="file" name="avatar" id="avatar" required>
                            <div><button class="btn btn-primary" type="submit" class="change-avatar">Upload</button></div>
                        </form>
                    </div>



                    <!-- delete account form -->
                    <div class="mb-3">
                        <form action="/app/users/deleteaccount.php" method="post">

                            <label for="deleteAccount">
                                <h3>Delete account</h3> (this cannot be undone)
                            </label>

                            <input class="form-control" type="password" name="deleteAccount" required>
                            <label for="deleteAccount"><small class="form-text">Enter your password to confirm</small></label>

                            <div><button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure? This cannot be undone.')">Delete my account</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require __DIR__ . '/views/footer.php'; ?>
