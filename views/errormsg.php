<?php if (isset($_SESSION['errorMsg'])) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['errorMsg'];
        unset($_SESSION['errorMsg']);
        ?> </div> <?php endif; ?>
