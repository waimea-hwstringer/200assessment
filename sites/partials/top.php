<?php require_once '_config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= SITE_NAME ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.cyan.min.css"
    />
</head>
<body>
<header>
    <h1><?= SITE_NAME ?></h1>
    <nav>
        <a href='index.php'>Order</a>
        <a href='game.php'>Admin</a>
    </nav>
</header>
<main>