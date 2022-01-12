<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>

    <?php
    if (isset($_SESSION['successMsg'])) : ?>
        <div class="alert alert-success" role="alert"><?php success($successMsg); ?></div>
    <?php endif;
    if (isset($_SESSION['errorMsg'])) : ?>
        <div class="alert alert-danger" role="alert"><?php errors($errorMsg); ?></div>
    <?php endif;
    if (isset($_SESSION['warningMsg'])) : ?>
        <div class="alert alert-warning" role="alert"><?php warnings($warningMsg); ?>
        </div>
    <?php endif; ?>

    <h1><?php echo $config['title']; ?></h1>
    <?php
    if (isset($_SESSION['user'])) : ?>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>.</p>
    <?php endif; ?>
    <p>Wunderful things happens here.</p>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
