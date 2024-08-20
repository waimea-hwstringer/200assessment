<?php
require '_functions.php';
include 'partials/topMIN.php';

//Gets current order (booking) ID 
$orderID = $_GET['id'] ?? '';

$db = connectToDB();


/********************************************************************** */

//Setup a query to get bookings info & joins theme on both bookings & themes tables
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
                 bookings.address,
                 bookings.delivery
          FROM bookings
          JOIN themes ON themes.id = bookings.theme
          WHERE bookings.id = ?';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$orderID]);
    $booking = $stmt->fetch();

}
//db error popup
catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

if ($booking == false) die("Unknown booking id :".$orderID." Please try again or contact site administrator.");

//********************************************************************************************************************************************* */

echo '<section class="contents">';
    echo '<section id="infoOrderTable">';

        echo '<h1 class="formHead" >Order Details</h1>';
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

            echo '<tr><th>Delivery</th>';
            echo '<td>'.$booking['delivery'].'</td></tr>';

        echo '</table>';

        echo '<a href="delete-order.php?id='.$booking['id'].'" class="confirmation" >';
            echo 'Delete order?';
            echo '<img src="images/delete.png" alt="⌫">';
        echo '</a>';

    echo '</section>'; #ends infoOrderTable section

echo '</section>'; #Ends contents section (for media query)
?>

<!--adds popup "are you sure?" when deleting the order -->
<script> 
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>

<?php
include 'partials/bottom.php';
?>