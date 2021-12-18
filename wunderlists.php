<?php

declare(strict_types=1);
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';


?>

Create a list<br>

<form action="/app/users/createlist.php" method="POST">

    <label for="listName">List Name</label>
    <input type="text" id="listName" name="listName" required>

    <button type="submit">Create List</button>
</form>
<br>
Your lists:

<?php
require __DIR__ . '/views/footer.php'; ?>
