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

    <label>Size</label>
    <input name="size">

    <label>Flavour</label>
    <input name="flavour">

    <label>Description of what you'd like</label>
    <input name="note">

    <label>Theme</label>
    <input name="theme">

    <label>Date & Time</label>
    <input name="datetime">

    <label>Address</label>
    <input name="address">

    <input type="submit" value="submit">

</form>

<?php include 'partials/bottom.php'; ?>