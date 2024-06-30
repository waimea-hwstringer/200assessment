<?php
require '_functions.php';

$bookingID = $_GET['id'] ?? '';
// SQL wen need to get the booking info...
// SELECT * FROM bookings WHERE id = XXX


$db = connectToDB();
consoleLog($db);

//Setup a query to get all booking info
$query = 'DELETE FROM bookings WHERE id = ?';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$bookingID]);
    $booking = $stmt->fetch(); //There will only be one result
}

catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('Could not delete theme. This is most likely because there are examples and/or orders that use this theme. These must be deleted before the theme can be deleted.');
}

header('location: index-admin.php')

?>