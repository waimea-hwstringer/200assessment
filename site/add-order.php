
<?php 
require '_functions.php';
?>

<h1>Add Order</h1>

<?php

consoleLog($_POST, 'POST Data');

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$size = $_POST['size'];
$flavour = $_POST['flavour'];
$note = $_POST['note'];
$theme = $_POST['theme'];
$datetime = $_POST['datetime'];
$address = $_POST['address'];

$db = connectToDB();

//Setup a query to insert all company info
$query = 'INSERT INTO bookings
           (`name`, email, phone, `size`, flavour, note, theme, `datetime`, `address`) 
           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$name, $email, $phone, $size, $flavour, $note, $theme, $datetime, $address]);
}

catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error sending data to the database');
}

header('location: index.php')
?>

