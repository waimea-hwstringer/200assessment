<?php 
require '_functions.php';
include 'partials/top.php'; 
?>

<h1>Add a theme</h1>

<form method="post" action="add-theme.php"> 

    <label>Theme</label>
    <input name="theme">

    <label>Description</label>
    <input name="description">

    <input type="submit" value="submit">

</form>

<?php include 'partials/bottom.php'; ?>