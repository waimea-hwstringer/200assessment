<?php
require '_functions.php';
include 'partials/topMIN.php';

$exampleID = $_GET['id'] ?? '';
// SQL wen need to get the task info...
// SELECT * FROM tasks WHERE id = XXX


$db = connectToDB();

//Setup a query to get all task info
$query = 'DELETE FROM examples WHERE id = ?';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$exampleID]);
    $task = $stmt->fetch(); //There will only be one result
}

catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('Could not delete example.');
}

header('location: form-example.php')

?>