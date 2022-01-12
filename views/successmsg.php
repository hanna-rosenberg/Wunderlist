<?php
if (isset($_SESSION['successMsg'])) : ?>
    <div class="alert alert-success" role="alert">
    <?php echo $_SESSION['successMsg'];
    unset($_SESSION['successMsg']);
endif; ?>
    </div>
