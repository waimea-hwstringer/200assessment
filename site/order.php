<?php
require '_functions.php';
include 'partials/topMIN.php';

$orderID = $_GET['id'] ?? '';
// SQL wen need to get the order info...
// SELECT * FROM boookings WHERE id = XXX


$db = connectToDB();
consoleLog($db);


/********************************************************************** */

//Setup a query to get all company info
$query = 'SELECT themes.theme AS themeNAME,
                 bookings.name,
                 bookings.id,
                 bookings.email,
                 bookings.phone,
                 bookings.size,
                 bookings.tiers,
                 bookings.flavour,
                 bookings.note,
                 bookings.datetime,
                 bookings.address
          FROM bookings
          JOIN themes ON themes.id = bookings.theme
          WHERE bookings.id = ?';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$orderID]);
    $booking = $stmt->fetch();

}

catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

if ($booking == false) die("Unknown booking id :".$orderID." Please try again or contact site administrator.");

consoleLog($booking);


//********************************************************************************************************************************************* */

echo '<table>';

echo '<tr><th>Name</th>';
echo '<td>'.$booking['name'].'</td></tr>';

echo '<tr><th>Email</th>';
echo '<td>'.$booking['email'].'</td></tr>';

echo '<tr><th>Phone</th>';
echo '<td>'.$booking['phone'].'</td></tr>';

echo '<tr><th>Size</th>';
echo '<td>'.$booking['size'].'</td></tr>';

echo '<tr><th>Tiers</th>';
echo '<td>'.$booking['tiers'].'</td></tr>';

echo '<tr><th>Flavour</th>';
echo '<td>'.$booking['flavour'].'</td></tr>';

echo '<tr><th>Description</th>';
echo '<td>'.$booking['note'].'</td></tr>';

echo '<tr><th>Theme</th>';
echo '<td>'.$booking['themeNAME'].'</td></tr>';

echo '<tr><th>Date & Time</th>';
echo '<td>'.$booking['datetime'].'</td></tr>';

echo '<tr><th>Address</th>';
echo '<td>'.$booking['address'].'</td></tr>';

echo '</table>';

echo '<a href="delete-order.php?id='.$booking['id'].'">';
echo 'Delete order';
echo '</a>';

include 'partials/bottom.php';
?>