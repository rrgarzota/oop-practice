<?php
require_once 'header.php';

$person = new Person($db);
var_dump($person->getById(1));
