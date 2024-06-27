<?php
require '_functions.php';
include 'partials/topMIN.php';
?>

<body>
<header>
    <h1 id="image"><?= SITE_LOGO ?></h1>
    <nav>
        <a href='index-admin.php'>Back</a>
    </nav>
</header>
<main>

<?php
$orderID = $_GET['id'] ?? '';
// SQL wen need to get the order info...
// SELECT * FROM boookings WHERE id = XXX


$db = connectToDB();
consoleLog($db);


/********************************************************************** */

//Setup a query to get all company info
$query = 'SELECT themes.theme AS themeNAME,
                 bookings.name,
                 bookings.email,
                 bookings.phone,
                 bookings.size,
                 bookings.flavour,
                 bookings.note,
                 bookings.theme,
                 bookings.datetime,
                 bookings.address
          FROM bookings
          JOIN themes ON themes.id = bookings.theme';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $themes = $stmt->fetchAll();

}

catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

if ($themes == false) die("There was an error");

consoleLog($themes);

foreach($bookings as $booking) {
echo $booking["themeNAME"];
}
//********************************************************************************************************************************************* */

//Setup a query to get all company info
$query = 'SELECT * FROM bookings WHERE id = ?';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$orderID]);
    $booking = $stmt->fetch(); //There will only be one result

}

catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting the booking from the database');
}

if ($booking == false) die("Unknown booking id :".$orderID." Please try again or contact site administrator.");

//********************************************************************************************************************************************* */

echo '<div><h3>Name</h3>';
echo '<p>'.$booking['name'].'<p></div>';

echo '<div><h3>Email</h3>';
echo '<p>'.$booking['email'].'<p></div>';

echo '<div><h3>Phone</h3>';
echo '<p>'.$booking['phone'].'<p></div>';

echo '<div><h3>Size</h3>';
echo '<p>'.$booking['size'].'<p></div>';

echo '<div><h3>Flavour</h3>';
echo '<p>'.$booking['flavour'].'<p></div>';

echo '<div><h3>Description</h3>';
echo '<p>'.$booking['note'].'<p></div>';

echo '<div><h3>Theme</h3>';
echo '<p>'.$booking['themeNAME'].'<p></div>';

echo '<div><h3>Date & Time</h3>';
echo '<p>'.$booking['datetime'].'<p></div>';

echo '<div><h3>Address</h3>';
echo '<p>'.$booking['address'].'<p></div>';

include 'partials/bottom.php';
?>