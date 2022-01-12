<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>

    <?php
    require __DIR__ . '/views/successmsg.php';
    require __DIR__ . '/views/errormsg.php';
    require __DIR__ . '/views/warningmsg.php';
    ?>

    <h1><?php echo $config['title']; ?></h1>
    <?php
    if (isset($_SESSION['user'])) : ?>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['user']['name']); ?>.</p>
    <?php endif; ?>
    <p>Wunderful things happens here.</p>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
