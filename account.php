<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';


?>

Name: <?php echo $_SESSION['user']['name'];  ?> <br>
Email: <?php echo $_SESSION['user']['email'];  ?> <button>Change Email</button><br>
Password: <button>Change password</button><br>
Your avatar: <img src="<?php echo $_SESSION['user']['image']; ?>"><button>Change avatar</button>
<?php
require __DIR__ . '/views/footer.php'; ?>
