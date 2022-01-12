<?php require __DIR__ . '/app/autoload.php'; ?>

<?php require __DIR__ . '/views/header.php'; ?>

<div class="row">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4">
            <div class="card-body">
                <div class="container">

                    <?php require __DIR__ . '/views/successmsg.php'; ?>

                    <h1>Log in</h1>

                    <form action="/app/users/login.php" method="post">
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="email@example.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input class="form-control" type="password" name="password" id="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Log in</button>

                        <?php
                        require __DIR__ . '/views/errormsg.php';
                        require __DIR__ . '/views/warningmsg.php';
                        ?>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php require __DIR__ . '/views/footer.php'; ?>
