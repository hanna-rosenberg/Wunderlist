<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>Welcome!</p>
    <!-- do not create any spaces in the below alert divs. js is looking for content to display. -->
    <div class="alert hidden alert-success" role="alert"><?php success($successMsg); ?></div>
    <div class="alert hidden alert-danger" role="alert"><?php errors($errorMsg); ?></div>
    <div class="alert hidden alert-warning" role="alert"><?php warnings($warningMsg); ?></div>
    <?php
    if (isset($_SESSION['user'])) : ?>
        <p>Welcome, <?php echo $_SESSION['user']['name']; ?>!</p>
    <?php endif; ?>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
