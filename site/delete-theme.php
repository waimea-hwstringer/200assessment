<?php
require '_functions.php';

$taskID = $_GET['id'] ?? '';
// SQL wen need to get the task info...
// SELECT * FROM tasks WHERE id = XXX


$db = connectToDB();
consoleLog($db);

//Setup a query to get all task info
$query = 'DELETE FROM themes WHERE id = ?';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$taskID]);
    $task = $stmt->fetch(); //There will only be one result
}

catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting task from the database');
}

header('location: form-theme.php')

?>