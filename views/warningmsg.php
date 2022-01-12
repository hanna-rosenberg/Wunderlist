<?php
if (isset($_SESSION['warningMsg'])) : ?>
    <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['warningMsg'];
        unset($_SESSION['warningMsg']);
        //this page causes lint errors. It is asking me to correct line indentation, but when I correct it,
        //it moves back automatically when I save. I have tried to fix this multiple times now, but not matter
        //what I do, it does not stop the lint errors. The autocorrection is stopping me from doing what lint wants me to do.
        // # yamllint disable
        ?> </div>
<?php endif;
// # yamllint enable
?>
