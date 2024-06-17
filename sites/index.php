
<?php 
require '_functions.php';
include 'partials/top.php'; 

$db = connectToDB();
consoleLog($db);

//Setup a query to get all company info
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

?>

<div id="heroImage">
    <h1><?= SITE_NAME ?></h1>
</div>

<section id="info">
    <div class="paragraph">
        <h3>About</h3>
        <p>asdfsl</p>
    </div>
    <div class="paragraph">
        <h3>Pricing</h3>
        <p>asdfsl</p>
    </div>
</section>

<div id="orderNow">
    <h2>Order now!</h2>
</div>

<section id="examples">
    <p>Here are some examples of my previous cakes...</p>
    <div id="line">
        <h3>Wedding cakes</h3>
        <p>IMAGE</p>
    </div>
    <div id="line">
        <h3>BDay cakes</h3>
        <p>IMAGE</p>
    </div>
</section>



<?php include 'partials/bottom.php'; ?>