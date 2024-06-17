<?php 
require '_functions.php';
include 'partials/top.php'; 
?>

<h1>Place an order</h1>

<form method="post" action="add-order.php"> 

    <label>Full Name</label>
    <input name="name">

    <label>Email</label>
    <input name="email" type="text">

    <label>Phone</label>
    <input name="phone">

    <input type="submit" value="Add">

</form>

<?php include 'partials/bottom.php'; ?>