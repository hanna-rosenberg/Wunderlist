<?php
if (isset($_SESSION['warningMsg'])) : ?>
    <div class="alert alert-warning" role="alert"><?php echo $_SESSION['warningMsg']; ?></div><?php unset($_SESSION['successMsg']);
                                                                                            endif; ?>
