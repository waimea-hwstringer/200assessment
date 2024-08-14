<?php require_once '_config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header>
    <div class="logoContainer">
        <a href='index.php'><img id="logo" src="images/logo.png"></a>
        <a href='index.php'><img id="logoMIN" src="images/logoMIN.png"></a>
    </div>
    <nav>
        <a href='index.php' class="navbarHome">Home</a>
        <a href='form-order.php'>Order</a>
        <a href='form-admin.php'>Admin</a>
    </nav>
</header>
<main>