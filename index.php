<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <!-- do not create any spaces in the below alert divs. js is looking for content to display. -->
    <div class="alert hidden alert-success" role="alert"><?php success($successMsg); ?></div>
    <div class="alert hidden alert-danger" role="alert"><?php errors($errorMsg); ?></div>
    <div class="alert hidden alert-warning" role="alert"><?php warnings($warningMsg); ?></div>
    <h1><?php echo $config['title']; ?></h1>
    <?php
    if (isset($_SESSION['user'])) : ?>
        <p>Welcome, <?php echo $_SESSION['user']['name']; ?>.</p>
    <?php endif; ?>
    <p>Wunderful things happens here.</p>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
