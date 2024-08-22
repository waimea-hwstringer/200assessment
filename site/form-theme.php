<?php 
require '_functions.php';
include 'partials/topMIN.php'; 


$db = connectToDB();

//Setup a query to get all company info
$query = 'SELECT * FROM themes';

//Attempt to run the query
try {
    $stmt = $db->prepare($query);
    $stmt->execute();
    $themes = $stmt->fetchAll();

}

//db Error popup
catch (PDOException $e) {
    consoleLog($e->getMessage(),'DB List Fetch', ERROR);
    die('There was an error getting data from the database');
}

?>

<section class="contents"> <!-- Contents is only used for a media query. whole page must be in contents section-->

    <h1 class="adminHead">Add a Theme</h1>

    <form method="post" action="add-theme.php" id="addThemeForm"> 

        <label>Name</label>
        <input name="theme" type="text" required >

        <label>Description</label>
        <textarea name="description" required ></textarea>

        <input type="submit" value="submit">

    </form>

    <div id="deleteList">
        <?php
           //List of current themes that can be deleted
        echo '<h1 class="adminHead">List of Themes</h1>';
            echo '<ul>';
            foreach($themes as $theme) {
                
                echo '<li>';

                    echo $theme['theme'];
                    echo '<a href="delete-theme.php?id='.$theme['id'].'" class="confirmation" >';
                    echo '<img class="deleteIcon" src="images/delete.png" alt="⌫">';
                    echo '</a>';

                echo '</li>';
            }
        echo '</ul>';
    echo '</div>';

echo'</section>'; //Ends the contents section
?>

<!-- Adds "are you sure?" popup when deleting a theme-->
<script>
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure that you want to delete this theme?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>

<?php include 'partials/bottom.php'; ?>
