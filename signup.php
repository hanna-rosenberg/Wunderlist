<?php

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';


?>
<div class="row">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4">
            <div class="card-body">
                <div class="container">
                    <!--login form-->

                    <h1>Create an account</h1>

                    <form action="/app/users/register.php" method="POST">

                        <label for="name">Name</label>
                        <input class="form-control" type="text" id="name" name="name" required>

                        <label for="email">Email</label>
                        <input class="form-control" type="email" id="email" name="email" required>

                        <label for="password">Password</label>
                        <input class="form-control" type="password" id="password" name="password" minlength="8" required><br>

                        <button type="submit" class="btn btn-primary">Create Account</button>
                    </form>
                    <!-- do not create any spaces in the below alert divs. js is looking for content to display. -->
                    <div class="alert hidden alert-success" role="alert"><?php success($successMsg); ?></div>
                    <div class="alert hidden alert-danger" role="alert"><?php errors($errorMsg); ?></div>
                    <div class="alert hidden alert-warning" role="alert"><?php warnings($warningMsg); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require __DIR__ . '/views/footer.php'; ?>
