<?php 
require '_functions.php';
include 'partials/topMIN.php'; 

$db = connectToDB();
consoleLog($db);

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
?>

<h1>Add an example</h1>

<form method="post" action="add-theme.php"> 

    <label>Theme</label>
    <input name="theme">

    <label>Description</label>
    <input name="description">

    <input type="submit" value="submit">

</form>

<?php

echo '<h1>Delete a theme</h1>';

foreach($themes as $theme) {
    
    echo '<li>';

        echo $theme['theme'];
        echo '<a href="delete-theme.php?id='.$theme['id'].'">';
        echo '🗑';
        echo '</a>';

    echo '</li>';
}

include 'partials/bottom.php'; ?>