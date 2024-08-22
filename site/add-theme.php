
<?php 
require '_functions.php';
include 'partials/top.php';

// Get form data
$theme = $_POST['theme'];
$description = $_POST['description'];


$db = connectToDB();

//Setup a query to insert all theme info
$query = 'INSERT INTO themes
           (theme, `description`) 
           VALUES (?, ?)';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute([$theme, $description]);
}

//db Error popup if something went wrong
catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error inserting this theme to the database. Please try again later or contact site administrator.');
}

header('location: form-theme.php')
?>

