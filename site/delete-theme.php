<?php
require '_functions.php';
include 'partials/topMIN.php';

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
    die('Could not delete theme. This is most likely because there are examples and/or orders that use this theme. These must be deleted before the theme can be deleted.');
}

header('location: form-theme.php')

?>