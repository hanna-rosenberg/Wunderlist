<?php
if (isset($_SESSION['successMsg'])) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['successMsg'];
        unset($_SESSION['successMsg']);
        //this page causes lint errors. It is asking me to correct line indentation, but when I correct it,
        //it moves back automatically when I save. I have tried to fix this multiple times now, but not matter
        //what I do, it does not stop the lint errors. The autocorrection is stopping me from doing what lint wants me to do.
        // # yamllint disable
        ?> </div>
<?php endif;
// # yamllint enable
?>
