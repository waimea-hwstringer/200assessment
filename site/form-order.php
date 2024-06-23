<?php 
require '_functions.php';
include 'partials/top.php'; 
?>

<h1>Place an order</h1>

<form method="post" action="add-order.php"> 

    <label>Full Name</label>
    <input name="name" type="text" required>

    <label>Email</label>
    <input name="email" type="email" required>

    <label>Phone</label>
    <input name="phone" type="number" required>

    <label>Size</label>
    <input name="size" required>

    <label>Flavour</label>
    <input name="flavour" required>

    <label>Description of what you'd like</label>
    <input name="note" type="text" required>

    <label>Theme</label>
    <input name="theme" required>

    <label>Date & Time</label>
    <input name="datetime" type="datetime-local" required>

    <label>Address</label>
    <input name="address" type="text" required>

    <input type="submit" value="submit" required>

</form>

<?php include 'partials/bottom.php'; ?>