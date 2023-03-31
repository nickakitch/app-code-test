<?php

use Models\Call;
use Models\CallDetails;

require_once './vendor/autoload.php';

if (isset($_POST['create_call_details_submit'])) {
    try {
        (new \Controllers\StoreCallDetails())([
            'call_id' => $_POST['call_id'],
            'date' => $_POST['date'],
            'details' => $_POST['details'],
            'hours' => $_POST['hours'],
            'minutes' => $_POST['minutes']
        ]);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

if (isset($_GET['id'])) {
    $call = Call::find($_GET['id'])->toArray();
    $details = CallDetails::forCall($call['id']);
}

if (empty($call)) {
    header('Location: /');
    exit;
}

require_once './Views/structure/header.php';
require_once './Views/calls/show.php';
?><hr class="my-4"><?php
require_once './Views/call_details/create.php';
?><hr class="my-4"><?php
require_once './Views/call_details/list.php';
require_once './Views/structure/footer.php';