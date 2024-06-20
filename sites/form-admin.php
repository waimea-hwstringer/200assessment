<?php
require '_functions.php';
include 'partials/top.php'; 

?>

<h1>Admin log in</h1>

<form method="post" action="login.php"> 

    <label>Username</label>
    <input name="username" type="text" required>

    <label>Password</label>
    <input name="password" type="password" required>

    <input type="submit" value="Submit">

</form>

<?php include 'partials/bottom.php';?>
>