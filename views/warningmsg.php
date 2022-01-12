<?php
if (isset($_SESSION['warningMsg'])) : ?>
    <div class="alert alert-warning" role="alert">
    <?php echo $_SESSION['warningMsg'];
    unset($_SESSION['successMsg']);
endif; ?>
    </div>
