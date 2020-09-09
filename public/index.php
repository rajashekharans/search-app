<?php
require_once('../vendor/autoload.php');

$dotenv =  Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

require_once('../src/Views/header.php');
require_once('../src/Views/main.php');

if(str_contains($_SERVER['REQUEST_URI'], '/search?')) {
    require('../src/Views/search.php');
}

require_once('../src/Views/footer.php');