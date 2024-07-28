<?php 
require '_functions.php';
include 'partials/top.php'; 

$db = connectToDB();
consoleLog($db);

//************************************************************************************** */

//Setup a query to get all examples
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

//************************************************************************************** */

//Setup a query to get all themes
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

//************************************************************************************** */

?>

<div id="heroImage">
    <h1><?= SITE_NAME ?></h1>
</div>

<section id="info">
    <div class="paragraph">
        <h3>About</h3>
        <p>lorem ipsum</p>
    </div>
    <div class="paragraph">
        <h3>Pricing</h3>
        <p>$$$$$$$$$</p>
    </div>
</section>

<div id="orderNow">
    <a href="form-order.php"><h2>Order now!</h2></a>
</div>

<section id="examples">
    <?php     

        foreach ($themes as $theme) {
            $hasExamples = false;
            $themeContent = '';

            foreach($examples as $example) {
                if ($example['theme'] == $theme['id']) {
                    $hasExamples = true;
                    $themeContent .= '<article>';
                    $themeContent .=   '<img src="load-image.php?id=' . $example['id'] . '">';
                    $themeContent .= '</article>';
                }
            }

            if ($hasExamples) {
                echo '<h3>' . $theme['theme'] . ' cakes </h3>';
                echo $themeContent;
            }
        }
    ?>
</section>

<?php 
include 'partials/bottom.php'; 
?>
