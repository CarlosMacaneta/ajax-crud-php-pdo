<?php require_once __DIR__.'../../../../bootstrap/app.php'; ?>
<!DOCTYPE html>
<html lang="pt_PT">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS files -->
    <link rel="stylesheet" href="<?= getenv('APP_ASSETS_URL') . '/css/jquery-ui/jquery-ui.min.css' ?>">
    <link rel="stylesheet" href="<?= getenv('APP_ASSETS_URL') . '/css/jquery-ui/jquery-ui.theme.min.css' ?>">
    <link rel="stylesheet" href="<?= getenv('APP_ASSETS_URL') . '/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= getenv('APP_ASSETS_URL') . '/css/style.css' ?>">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-primary bg-gradient shadow-sm">
        <div class="container">
            <a class="navbar-brand text-white italic" href="<?= getenv('APP_URL').'/'; ?>">
                Digital Vehicle Seller
            </a>
        </div>
    </nav>
    <div class="container">
    