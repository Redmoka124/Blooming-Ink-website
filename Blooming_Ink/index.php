<?php

$page_title='Blooming Ink';
//header
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">

<style>

	.card {
    width: 80%;
    margin: 20px auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 20px;
    overflow: hidden;
    background-color: #f9f9f9;
}

.card-header, .card-footer {
    background-color: plum;
    color: lavenderblush;
	font-family: 'Amaranth';
    padding: 15px;
    text-align: center;
}

.card-content {
	font-family: 'Trebuchet MS', sans-serif;
    padding: 15px;
    background-color: lavenderblush;
    color: #333;
}

.card-footer a {
    color: lavenderblush;
    text-decoration: none;
    background-color:mediumorchid;
    border: 2px solid mediumorchid;
    border-radius: 7px;
    box-shadow: 4px 4px 7px darkorchid;
    cursor: pointer;
    padding: 4px 8px;
    margin-right: 15px;
    display:inline-block;
}

.card-footer a:hover {
    background-color: darkorchid;
    border:2px solid darkorchid;
    text-decoration: none;
}
#welcome-message{
    text-align: center;
    border: 2px solid lavenderblush;
    border-radius:20px;
    background: lavenderblush;
    margin-left:35%;
    margin-right:35%;
}

#paginationbuttons a {
    color: mediumorchid;
    text-decoration: none;
    background-color: transparent;
    border: none;
    border-radius: 0;
    box-shadow: none;
    padding: 0 5px;
    font-weight: bold;
}

#paginationbuttons a:hover {
    text-decoration: underline;
    background-color: transparent;
    border: none;
}






@media screen and (max-width: 390px){
    .card{
        width:90%;
    }
    
}

	
</style>

<div class="main-content">

<?php

//If a user name is entered display login mesage
if (isset($_SESSION['fname'])) {
		echo "<p id='welcome-message'>You are currently logged in as {$_SESSION['fname']}.</p>";
}

///////////Connects to database and runs query for blogposts THAT SHOWS BLOGPOSTS////////////////
include('mysqli_connect.php');
$query = "SELECT * FROM blogposts";
$results = mysqli_query($dbc, $query);	

///////////////Same page DELETE codes//////////////////////
if (isset($_GET['delete_id'])) {
	//If there is a delete_id in url
	$delete_id = mysqli_real_escape_string($dbc, trim($_GET['delete_id']));
	
	$delete_query = "DELETE FROM blogposts WHERE blogpost_id = " . $delete_id;
	$delete_results = mysqli_query($dbc, $delete_query);
	//display delete message
	if ($delete_results) {
		echo "<h3 style=\"background-color:red;\">YOUR COMMENT HAS BEEN DELETED!</h3><br>";
	} 
} else {
$delete_id = "";	
}
///////////////PAGNATION AND SORTING///////////////////////////////////////////////


//***********************************************
//PAGINATION SETUP START
//From Textbook Script 10.5 - #5
//***********************************************

// Number of records to show per page:
$display = 5;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
$pages = $_GET['p'];
} else { // Need to determine.
// Count the number of records:
$q = "SELECT COUNT(blogpost_id) FROM blogposts";
$r = mysqli_query ($dbc, $q);
$rowp = mysqli_fetch_array ($r, MYSQLI_NUM);
$records = $rowp[0];
// Calculate the number of pages...
if ($records > $display) { // More than 1 page.
$pages = ceil ($records/$display);
} else {
$pages = 1;
}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
$start = $_GET['s'];
} else {
$start = 0;
}

//***********************************************
//PAGINATION SETUP END
//***********************************************


//***********************************************
//SORTING SETUP START
//From Textbook Script 10.5 - #5
//***********************************************

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'date';

// Determine the sorting order:
switch ($sort) {
case 'recent':
$order_by = 'blogpost_timestamp DESC';
break;

case 'oldest':
$order_by = 'blogpost_timestamp ASC';
break;

/*case 'lname':
$order_by = 'lname ASC';
break;*/

default:
$order_by = 'blogpost_timestamp DESC';
$sort = 'recent';
break;
}

//Sort buttons
echo '<br>';
echo '<div style="background-color:lavenderblush; border-radius:7px; width:fit-content; margin:0 auto; padding:8px 20px; text-align:center;">';
echo '<strong> Sort By: </strong>';
echo '<a href="?sort=recent">Most Recent</a> |';
echo '<a href="?sort=oldest">Oldest</a>';
echo '</div>';

//***********************************************
//SORTING SETUP END
//***********************************************


$query = "SELECT * FROM blogposts ORDER BY $order_by LIMIT $start, $display ";
$results = mysqli_query($dbc, $query);


$query = "SELECT blogposts.*, users.fname FROM blogposts JOIN users ON blogposts.user_id = users.user_id ORDER BY $order_by LIMIT $start, $display";
$results = mysqli_query($dbc, $query);

/////////THIS IS CORRECT ONE!!!//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){

	echo "<div class='card'>";
    echo "<div class='card-header'>";
        echo "<h2>" . htmlspecialchars($row['blogpost_title']) . "</h2>";
        echo "<p>Posted by " . htmlspecialchars($row['fname']) . "</p>";
    echo "</div>";
    echo "<div class='card-content'>";
        echo "<p>" . htmlspecialchars($row['blogpost_body']) . "</p>";
    echo "</div>";
    echo "<div class='card-footer'>";
        echo "<p>" . date('F j, Y g:i A', strtotime($row['blogpost_timestamp'])) . " <em style='font-size:0.8em;'>(Times displayed in UTC)</em></p>";
        echo "<a href='viewcomments.php?blogpost_id=" . $row['blogpost_id'] . "'>View Comments</a>";
        echo "<a href='newcomment.php?blogpost_id=" . $row['blogpost_id'] . "'>Leave a Comment</a>";
    echo "</div>";
echo "</div>";
	

	echo "</div><br><br>";
	
}


//***********************************************
//PAGINATION PREVIOUS AND NEXT PAGE BUTTONS/LINKS START
//***********************************************

// Make the links to other pages, if necessary.
if ($pages > 1) {

echo '<div id="paginationbuttons" style="text-align:center; margin: 20px auto; width:fit-content; background-color:lavenderblush; border-radius:7px; padding:8px 20px;">';
$current_page = ($start/$display) + 1;

// If it's not the first page, make a Previous button:
if ($current_page != 1) {
echo '<a href="?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
}

// Make all the numbered pages:
for ($i = 1; $i <= $pages; $i++) {
if ($i != $current_page) {
echo '<a href="?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
} else {
echo $i . ' ';
}
} // End of FOR loop.

// If it's not the last page, make a Next button:
if ($current_page != $pages) {
echo '<a href="?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
}

echo '</p>'; // Close the paragraph.

} // End of links section.

//***********************************************
//PAGINATION PREVIOUS AND NEXT PAGE BUTTONS/LINKS END
//***********************************************



////////////////////////////////////////////
	
///////////Displays results in an orderly fashion//////////////////////////////ONLY FOR SORTING, NOT FOR QUERY ITSELF!!!!!!!!!!!!!//////////////////////////////////////////

while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
	echo "Blogpost title: " . $row['blogpost_title'] . "<br>";
	echo "Blogpost Content: " . $row['blogpost_body'] . "<br>";
	echo "Posted: " . $row['blogpost_timestamp'] . "<br><br>";
	echo '<a href="viewcomments.php?blogpost_id=' . $row['blogpost_id'] . '">View Comments</a>';
	
	
	///////////Adds STYLE to blogposts/////////////////////
	echo "<div class=\"card\" style=\"width:75%;\">";//Outer class named "card"
	echo "<div class=\"w3-card-4\" style=\"width:50%;\">";//inner class named "w3-card-4" with width set tp 50%
	echo "<header class=\"w3-container w3-blue\">";//most inner class named "w3-container w3-blue" thats used to frame everything I think
	echo "<h1>" . $row['fname'] . " " . $row['lname'] . "</h1>";
	echo "</header>";
	echo "<div class=\"w3-container\">";
	echo "<p>" . $row['comments'] . "</p>";
	echo "</div>";
	echo "<footer class=\"w3-container w3-blue\">";
	echo "<h5>" . "User ID: " . $row['user_id'] . "</h5>";
	echo "</footer>";
	echo "</div>";
	echo "</div><br><br>";
}
	
///////////////////////////////////////////////////////////////////////////

//////////////ADD COMMENTS AND DELETE BUTTON BELOW HERE///////////////////////////////


//COMING SOON


//////////////////////////////////////////////////////////////////////////////
echo '</div>';

//header
?>


<?php
include('footer.php');
?>


<?php


?>


</html>