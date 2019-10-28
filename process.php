<?php
require_once 'application/common/init.php';

$person = new Person($db);

if ($_GET['action'] !== 'delete') {
    $person
        ->setFname($_POST["fname"])
        ->setLname($_POST["lname"]);
}
    
if ($_POST['action'] === 'update' && !empty($_POST["id"])) {
    $result = $person->update($_POST["id"]);
} elseif ($_GET['action'] === 'delete') {
    $result = $person->delete($_GET['id']);
} else {
    $result = $person->insert();
}

if ($result === 1) {
    header('Location: index.php?msg='.$_REQUEST['action'].'');
    exit;
} else {
    echo 'An error was encountered.';
}

