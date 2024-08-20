<?php 
require '_functions.php';
include 'partials/top.php'; 

$db = connectToDB();

//***THEMES********************************************************************************************** */

//Setup a query to get all theme info
$query = 'SELECT * FROM themes';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $themes = $stmt->fetchAll();
}

//error popup
catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

//***BOOKINGS********************************************************************************************** */

//Setup a query to get all company info
$query = 'SELECT * FROM bookings';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $bookings = $stmt->fetchAll();
}

//error popup
catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting data from the bookings database');
}

echo '<section class="contents">'; //contents is only used for a media query

echo '<h1 class="adminHead">Admin list of Orders</h1>';

echo '<section id="adminOrderTable">';

foreach ($themes as $theme) {
    echo '<h3 class="adminTableTitle">' . $theme['theme'] . ' cakes </h3>';

    // Filter bookings for the current theme
    $themeBookings = array_filter($bookings, function($booking) use ($theme) {
        return $booking['theme'] == $theme['id'];
    });

    if (empty($themeBookings)) { //displays when there are no bookings for the specific theme
        echo '<p>No orders!</p>';
    } else { //header if there are bookings for the specific theme
        echo '<table>';
        echo    '<tr>';
        echo        '<th>Name</th>';
        echo        '<th class="adminDatetime">Date & Time</th>';
        echo        '<th>More info</th>';
        echo    '</tr>';

        foreach ($themeBookings as $booking) {
            echo '<tr>'; //table info if there are bookings for the specific theme
            echo     '<td>' . $booking['name']  . '</td>';
            echo     '<td class="adminDatetime">' . $booking['datetime']  . '</td>';
            echo     '<td><a href="order.php?id=' . $booking['id'] . '">ⓘ</a></td>';
            echo '</tr>';
        }

        echo '</table>';
    }
}
echo '</section>'; //ends table

//Buttons at bottom of page
echo '<section id="adminButtons">';
    echo '<a href="form-theme.php">Edit Themes</a>';
    echo '<a href="form-example.php">Edit Examples</a>';
echo '</section>';

echo '</section>'; #Ends the contents section

include 'partials/bottom.php'; 

?>
