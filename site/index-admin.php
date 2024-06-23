
<?php 
require '_functions.php';
include 'partials/top.php'; 

$db = connectToDB();
consoleLog($db);

//***THEMES********************************************************************************************** */

//Setup a query to get all company info
$query = 'SELECT * FROM themes';

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

//See what we got back
consoleLog($themes);

//***BOOKINGS********************************************************************************************** */

//Setup a query to get all company info
$query = 'SELECT * FROM bookings';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $bookings = $stmt->fetchAll();
}

catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting data from the bookings database');
}

//See what we got back
consoleLog($bookings);

echo '<h1>Admin list of Orders</h1>';

echo '<section id="orderList">';

foreach ($themes as $theme) {
    echo '<table>';
    echo    '<tr>';
    echo        '<th>Name</th>';
    echo        '<th>Email</th>';
    echo    '</tr>';
    
    echo '<h3>' . $theme['theme'] . ' cakes </h3>';

    foreach($bookings as $booking) {
        
        // Check if the booking belongs to the current service
        if ($booking['theme'] == $theme['id']) {
            echo '<tr>';
            echo     '<td>' . $booking['name']  . '</td>';
            echo     '<td>' . $booking['email']  . '</td>';
            echo '</tr>';

        }

    }

    echo '</table>';
}
echo '</section>';

echo '<section id="adminButtons">';
    echo '<a href="form-theme.php">Edit Themes</a>';
    echo '<br>';
    echo '<a href="form-example.php">Edit Examples</a>';
echo '</section>';

include 'partials/bottom.php'; 

?>
