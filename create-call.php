<?php

require_once './vendor/autoload.php';

if (isset($_POST['create_call_submit'])) {
    try {
        $call = (new \Controllers\StoreCall())([
            'call_date' => $_POST['call_date'],
            'call_it_person' => $_POST['call_it_person'],
            'call_username' => $_POST['call_username'],
            'call_subject' => $_POST['call_subject'],
            'call_details' => $_POST['call_details'],
            'call_status' => $_POST['call_status']
        ]);

        $call = $call->toArray();

        header('Location: ./call.php?id=' . $call['id']);

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

require_once './Views/structure/header.php';
require_once './Views/calls/create.php';
require_once './Views/structure/footer.php';