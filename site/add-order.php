
<?php 
require '_functions.php';
include 'partials/top.php';

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$size = $_POST['size'];
$tiers = $_POST['tiers'];
$flavour = $_POST['flavour'];
$note = $_POST['note'];
$theme = $_POST['theme'];
$datetime = $_POST['datetime'];
$address = $_POST['address'];
$delivery = $_POST['delivery'];

$db = connectToDB();

//Setup a query to insert all order details
$query = 'INSERT INTO bookings
           (`name`, email, phone, `size`, tiers, flavour, note, theme, `datetime`, `address`, delivery) 
           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$name, $email, $phone, $size, $tiers, $flavour, $note, $theme, $datetime, $address, $delivery]);
}
//Error message popup
catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('<h2>There was an error sending data to the database. Please check that all of your selections were valid.<h2>');
}
?>

<!--Display to the user that their order went through-->
<section class="contents">
    <div id="orderPlaced">
        <h1>Success!</h1>
        <p>Thank you for placing your order with <?= SITE_NAME ?>. We will contact you about the status of your order shortly.</p>
        <a href="index.php">Return to home page</a>
    </div>
</section>

<?php include 'partials/bottom.php';?>