<?php 
require '_functions.php';
include 'partials/top.php'; 

$db = connectToDB();

//This is the query for finding the options in the size enum dropdown
$query = 'SHOW COLUMNS FROM bookings LIKE "size"';
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $column = $stmt->fetch();

}

//Error popup
catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}


//This removes the apostrophe from the array items
preg_match('/enum\((.*)\)$/', $column['Type'], $matches);
$matches = str_replace('\'','',$matches[1]);
$sizes = explode(',', $matches);

//************************************************************* */

//Setup a query to get all company info
$query = 'SELECT * FROM themes';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $themes = $stmt->fetchAll();

}

//Error popup
catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

//************************************************************* */

//This is the query for finding the options in the flavour enum dropdown
$query = 'SHOW COLUMNS FROM bookings LIKE "flavour"';
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $column = $stmt->fetch();

}
catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}


//This removes the apostrophe from the array items
preg_match('/enum\((.*)\)$/', $column['Type'], $matches);
$matches = str_replace('\'','',$matches[1]);
$flavours = explode(',', $matches);

?>

<section class="contents"> <!-- Contents is only used for a media query -->
        
    <h1 class="formHead">Place an order</h1>

    <form method="post" id="orderForm" action="add-order.php"> 

        <label>Full Name</label>
        <input name="name" type="text" maxlength="25" required>

        <label>Email</label>
        <input name="email" type="email" maxlength="50" required>

        <label>Phone</label>
        <input name="phone" type="text" maxlength="50" required>

        <label>Size & Shape</label>
        <select name="size">
            <?php 
                foreach ($sizes as $size) {
                    echo '<option value="'.$size.'">'.$size.'</option>'; //gets all size options for dropdown menu
                }
            ?>
        </select>

        <label>Tiers (1-5)</label>
        <input name="tiers" type="number" min="1" max="5" required>

        <label>Flavour</label>
        <select name="flavour">
            <?php 
                foreach ($flavours as $flavour) {
                    echo '<option value="'.$flavour.'">'.$flavour.'</option>'; //gets all flavour options for dropdown menu
                }
            ?>
        </select>

        <label>Description of what you'd like</label>
        <textarea name="note" maxlength="200" required class="largeTextInput"></textarea>

        <label>Theme</label>
        <select name="theme">
            <?php 
                foreach ($themes as $theme) {
                    echo '<option value="'.$theme['id'].'">'.$theme['theme'].'</option>'; //gets all themes for theme dropdown menu
                }
            ?>
        </select>

        <label>Date & Time needed by</label>
        <input name="datetime" type="datetime-local" required>

        <label>Address</label>
        <input name="address" type="text" required>

        <label>Delivery</label>
        <p>We offer deliveries throughout Nelson for an additional $20 cost.</p>
        <input name="delivery" type="hidden" value="no">
        <span>I would like my order to be delivered: </span> <input name="delivery" type="checkbox" value="yes">
        
        <input type="submit" value="submit">

    </form>
</section> <!-- Ends the contents section used for media query -->

<?php include 'partials/bottom.php'; ?>