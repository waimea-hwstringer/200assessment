<?php 
require '_functions.php';
include 'partials/top.php'; 

$db = connectToDB();

//************************************************************************************** */

//Setup a query to get all examples
$query = 'SELECT * FROM examples';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $examples = $stmt->fetchAll();
}
//db error popup
catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

//************************************************************************************** */

//Setup a query to get all themes
$query = 'SELECT * FROM themes';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $themes = $stmt->fetchAll();
}
//error popup
catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

//************************************************************************************** */

?>

<section class="contents"> <!-- only used for media query. Whole page must be in contents section-->
    
    <div id="heroImage">
        <h1><?= SITE_NAME ?></h1>
    </div>

    <section id="info">
        <div class="paragraph">
            <h3>About</h3>
            <p>Welcome to <?=SITE_NAME?>, a premier destination for exquisite, handcrafted cakes in Nelson, New Zealand. We specialize in creating custom cakes for all occasions, from birthdays and weddings to corporate events. Our commitment to using high-quality ingredients and attention to detail ensures that each cake is not only visually stunning but also delicious. With a variety of flavors and designs to choose from, we work closely with our clients to bring their vision to life. Contact us today to discuss your requirements and let us help make your event truly special with a cake from <?=SITE_NAME?>.</p>
        </div>
        <div class="paragraph">
            <h3>Pricing</h3>
            <p>Our custom cakes are crafted with care and creativity, perfect for any occasion. Prices start from $80, ensuring you get a delicious and beautifully designed cake that suits your budget.</p>
        </div>
        <div class="paragraph">
            <h3>Contact us</h3>
            <p>Have further questions that aren't answered here? Having problems with an order? Please contact us at mpstringer@madascakes.nz for any issues or queries that you may have.</p>
        </div>
    </section>

    <div id="orderNow">
        <a href="form-order.php"><h2>Order now!</h2></a>
    </div>

    <section id="indexExamples">
        <?php     

            //Displays the examples (images) under each theme. if there are no examples the header for the theme is not displayed
            foreach ($themes as $theme) { 

                $hasExamples = false; //assumes there is nothing to display by default so ' ' is displayed
                $themeContent = '';

                foreach($examples as $example) {
                    
                    if ($example['theme'] == $theme['id']) {
                        $hasExamples = true; //in this case, there is something to display so info is shown
                        
                        $themeContent .= '<article>';
                        $themeContent .=   '<img src="load-image.php?id=' . $example['id'] . '" alt="cakeImage">';
                        $themeContent .= '</article>';
                    }
                }

                if ($hasExamples) { //Displays the info that we found above
                    
                    echo '<h3>' . $theme['theme'] . ' cakes </h3>';
                    echo '<section class="indexExampleImages">';
                    echo $themeContent;
                    echo '</section>';
                    
                }
            }

        ?>
    </section>
</section> <!-- Ends the contents section used for media query -->
<?php 
include 'partials/bottom.php'; 
?>
