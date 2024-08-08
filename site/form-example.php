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
$query = 'SELECT examples.id AS eid,
                 examples.name AS ename,
                 examples.description AS edesc,
                 themes.theme AS tname
          FROM examples
          JOIN themes ON examples.theme = themes.id';

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

<h1 class="adminHead">Add an example</h1>

<form method="post" action="add-example.php" enctype="multipart/form-data"> 

    <label>Name</label>
    <input name="name" type="text" required>

    <label>Description</label>
    <input name="description" type="text" required>

    <label>Theme</label>
    <select name="theme" required>
        <?php 
            foreach ($themes as $theme) {
                echo '<option value="'.$theme['id'].'">'.$theme['theme'].'</option>';
            }
        ?>
    </select>

    <label>Image</label>
    <label for="file-upload" class="uploadFileButton">🡢 Open folder</label>
    <input id="file-upload" type="file" name="image" accept="image/*" required/>

    <input type="submit" value="submit">

</form>

<h1 class="adminHead">Delete an example</h1>

<section class="examples">
    <?php
    foreach($examples as $example) {
        
        echo '<article>';
            echo '<h3>'.$example['ename'].'</h3>';
            echo '<p>'.$example['tname'].'</p>';
            echo '<p>'.$example['edesc'].'</p>';
            echo   '<img src="load-image.php?id=' . $example['eid'] . '">';
            echo '<br>';
            echo '<a href="delete-example.php?id='.$example['eid'].'">';
            echo '🗑';
            echo '</a>';
        echo '</article>';
    }

echo '</section>';

include 'partials/bottom.php'; ?>