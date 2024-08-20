<?php
require '_functions.php';
include 'partials/top.php'; 

?>

<section class="contents">
    <div id="adminLogin">
        
        <h1 class="formHead">Admin log in</h1>

        <form method="post" action="login.php"> 

            <label>Username</label>
            <input name="username" type="text" required>

            <label>Password</label>
            <input name="password" type="password" required>

            <input type="submit" value="Submit">

        </form>
    </div>
</section> <!-- Ends the contents section (only purpose is for the media query)-->

<?php include 'partials/bottom.php';?>
