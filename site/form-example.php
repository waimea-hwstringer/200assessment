<?php 
require '_functions.php';
include 'partials/topMIN.php'; 

$db = connectToDB();

//******************************************************************************** */

//Setup a query to get all theme info
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

//********************************************************************************** */

//Setup a query to get all theme info
$query = 'SELECT examples.id AS eid,
                 examples.name AS ename,
                 examples.description AS edesc,
                 themes.theme AS tname
          FROM examples
          JOIN themes ON examples.theme = themes.id';

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

//********************************************************************************** */
?>

<section class="contents">
<section id="adminExampleContents">
    <h1 class="adminHead">Add an example</h1>

    <form method="post" action="add-example.php" enctype="multipart/form-data"> 

        <label>Name</label>
        <input name="name" type="text" required>

        <label>Description</label>
        <input name="description" type="text" required>

        <label>Theme</label>
        <select name="theme">
            <?php 
                foreach ($themes as $theme) {
                    echo '<option value="'.$theme['id'].'">'.$theme['theme'].'</option>';
                }
            ?>
        </select>

        <label>Image</label>
        <label for="file-upload" class="uploadFileButton">🡢 Open folder</label>
        <input id="file-upload" type="file" name="image" accept="image/*" required>

        <input type="submit" value="submit">

    </form>

    <h1 class="adminHead">Delete an example</h1>

    <section id="adminExamples">
        <?php
        foreach($examples as $example) {

            echo '<div class="adminExampleContainer">';

                echo '<img src="load-image.php?id=' . $example['eid'] . '" alt=" ' . $example['ename'].'" class="adminExampleImage">';

                echo '<div class="adminExampleOverlay"> 
                    <h3>'.$example['ename'].'</h3> 
                    <p>'.$example['tname'].'</p>
                    <a href="delete-example.php?id='.$example['eid'].'" class="confirmation" >
                        <img class="deleteIcon" src="images/delete.png" alt="⌫">
                    </a>';
                echo '</div>';
            echo '</div>';
        }
    echo '</section>';
    
echo '</section>';
echo '</section>'; ## Ends the contents section 

?>
<script>
    var elems = document.getElementsByClassName('confirmation');
    var confirmIt = function (e) {
        if (!confirm('Are you sure that you want to delete this example?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
</script>

<?php include 'partials/bottom.php'; ?>
