<?php

use Controllers\Database;

require_once './vendor/autoload.php';

$database = Database::getInstance();
$statement = $database->prepare('SELECT * FROM `calls` WHERE `deleted_at` IS NULL');
$statement->execute();

$calls = $statement->fetchAll();
?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Call ID</th>
        <th scope="col">Username</th>
        <th scope="col">Date</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($calls as $call) { ?>
        <tr>
            <th scope="row">
                <a href="./call.php?id=<?=htmlentities($call['id'])?>"><?=htmlentities($call['id'])?></a>
            </th>
            <td><?=htmlentities($call['username'])?></td>
            <td><?=htmlentities((new DateTime($call['date']))->format('Y-m-d'))?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>