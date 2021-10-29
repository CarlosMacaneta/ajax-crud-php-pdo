<?php

require_once __DIR__.'/bootstrap/app.php';

if ($_SERVER['REQUEST_URI'] == '/') {
    header('Location: '.getenv('APP_URL').'/resources/view/');
    exit;
}
