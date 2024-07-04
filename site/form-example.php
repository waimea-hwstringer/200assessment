<?php 
require '_functions.php';
include 'partials/topMIN.php'; 

$db = connectToDB();
consoleLog($db);

//******************************************************************************** */

//Setup a query to get all theme info
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

//********************************************************************************** */

//Setup a query to get all theme info
$query = 'SELECT * FROM examples';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $examples = $stmt->fetchAll();

}

catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

//See what we got back
consoleLog($examples);

//********************************************************************************** */
?>

<h1>Add an example</h1>

<form method="post" action="add-example.php"> 

    <label>Name</label>
    <input name="name">

    <label>Description</label>
    <input name="description">

    <label>Theme</label>
    <select name="theme" required>
        <?php 
            foreach ($themes as $theme) {
                echo '<option value="'.$theme['id'].'">'.$theme['theme'].'</option>';
            }
        ?>
    </select>

    <input type="submit" value="submit">

</form>


<h1>Delete an example</h1>
<section class="examples">
    <?php
    foreach($examples as $example) {
        
        echo '<article>';
            echo '<h3>'.$example['name'].'</h3>';
            echo   '<img src="load-image.php?id=' . $example['id'] . '">';
            echo '<br>';
            echo '<a href="delete-example.php?id='.$example['id'].'">';
            echo '🗑';
            echo '</a>';
        echo '</article>';
    }

echo '</section>';

include 'partials/bottom.php'; ?>