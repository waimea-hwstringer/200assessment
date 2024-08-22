<?php
require '_functions.php';
include 'partials/topMIN.php';

//Gets the example ID from the url
$exampleID = $_GET['id'] ?? '';

$db = connectToDB();

//Setup a query to delete required example
$query = 'DELETE FROM examples WHERE id = ?';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$exampleID]);
    $task = $stmt->fetch(); //There will only be one result
}

//db Error popup
catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('Could not delete example. Please try again later or contact site administrator.');
}

header('location: form-example.php')

?>