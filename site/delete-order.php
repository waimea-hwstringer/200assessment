<?php
require '_functions.php';
include 'partials/topMIN.php';

//Gets the booking ID from the url
$bookingID = $_GET['id'] ?? '';

$db = connectToDB();

//Setup a query to get all booking info
$query = 'DELETE FROM bookings WHERE id = ?';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$bookingID]);
    $booking = $stmt->fetch(); //There will only be one result
}

//Error popup if something went wrong
catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('Could not delete order. Please try again later or contact site administrator.');
}

header('location: index-admin.php')

?>