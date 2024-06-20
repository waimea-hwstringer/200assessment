<?php
require '_functions.php';
include 'partials/top.php';
?>

<h1>Signing in</h1>

<?php

consoleLog($_POST, 'POST Data');

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

//Connect to database
$db = connectToDB();

//Setup a query to insert all company info
$query = 'SELECT * FROM `admin` ';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $admin = $stmt->fetch();
}

catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error selecting data from the database.');
}

if ($username == $admin['username'] && $password == $admin['password']) {
    header('location: index-admin.php');
}

else {
    echo 'Incorrect Username or Password. Click <a href="management-signin.php">here</a> to try again.';
}

include 'partials/bottom.php';
?>