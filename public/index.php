<?php
    require_once "../vendor/autoload.php";

    $dotenv =  Dotenv\Dotenv::createImmutable('../');
    $dotenv->load();

    $request  = str_replace("http://localhost:7080/", "", $_SERVER['REQUEST_URI']);

    if(str_contains($request, '/search?')) {
        require('../src/Views/header.php');
        require('../src/Views/main.php');
        require('../src/Views/search.php');
        require('../src/Views/footer.php');
    } else {
        require('../src/Views/header.php');
        require('../src/Views/main.php');
        require('../src/Views/footer.php');
    }
