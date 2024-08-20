<?php
require '_functions.php';
include 'partials/topMIN.php';

//Gets the theme ID from the url
$themeID = $_GET['id'] ?? '';

$db = connectToDB();

//Setup a query to get all theme info
$query = 'DELETE FROM themes WHERE id = ?';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$themeID]);
    $theme = $stmt->fetch(); //There will only be one result
}

catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('Could not delete theme. This is most likely because there are examples or orders that use this theme. These must be deleted before the theme can be deleted.');
}

header('location: form-theme.php')

?>