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
$statement = $database->prepare('SELECT * FROM lists WHERE user_id = :user_id');
$statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_STR);
$statement->execute();

$lists = $statement->fetchAll(PDO::FETCH_DEFAULT);

?> <ul><?php
        for ($i = 0; $i < count($lists); $i++) : ?>
        <li class="list-names"> <a href="/tasks.php?tasks=<?php echo $lists[$i]['id'] ?>" id="<?php echo $lists[$i]['id'] ?>"><?php echo $lists[$i]['title']; ?> </a> </li>
    <?php endfor; ?>
</ul>






<?php
require __DIR__ . '/views/footer.php';
