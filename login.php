<?php require __DIR__ . '/app/autoload.php'; ?>

<?php require __DIR__ . '/views/header.php'; ?>

<div class="row">
    <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4">
            <div class="card-body">
                <div class="container">

                    <?php
                    if (isset($_SESSION['successMsg'])) : ?>
                        <div class="alert hidden alert-success" role="alert"><?php success($successMsg); ?></div>
                    <?php endif; ?>

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

                        <?php if (isset($_SESSION['errorMsg'])) : ?>
                            <div class="alert hidden alert-danger" role="alert"><?php success($errorMsg); ?></div>
                        <?php endif;
                        if (isset($_SESSION['warningMsg'])) : ?>
                            <div class="alert hidden alert-warning" role="alert"><?php success($warningMsg); ?>
                            </div>
                        <?php endif; ?>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php require __DIR__ . '/views/footer.php'; ?>
