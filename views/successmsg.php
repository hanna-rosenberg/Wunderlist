<?php
if (isset($_SESSION['successMsg'])) : ?>
    <div class="alert alert-success" role="alert"><?php echo $_SESSION['successMsg']; ?></div><?php unset($_SESSION['successMsg']);
                                                                                            endif; ?>
