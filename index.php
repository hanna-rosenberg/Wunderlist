<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <div class="alert hidden alert-success" role="alert">
        <?php
        if (isset($_SESSION['successMsg'])) {
            success($successMsg);
        }
        ?>
    </div>
    <div class="alert hidden alert-danger" role="alert">
        <?php
        if (isset($_SESSION['errorMsg'])) {
            success($errorMsg);
        }
        ?>
    </div>
    <div class="alert hidden alert-warning" role="alert">
        <?php
        if (isset($_SESSION['warningMsg'])) {
            success($warningMsg);
        }
        ?>
    </div>
    <h1><?php echo $config['title']; ?></h1>
    <?php
    if (isset($_SESSION['user'])) : ?>
        <p>Welcome, <?php echo $_SESSION['user']['name']; ?>.</p>
    <?php endif; ?>
    <p>Wunderful things happens here.</p>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
