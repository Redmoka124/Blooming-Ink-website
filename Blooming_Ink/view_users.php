<?php # Script 9.6 - view_users.php #2
// This script retrieves all the records from the users table.

$page_title = 'View the Current Users';
include ('header.php');

// Page header:
echo '<div style="text-align: center; color: lavenderblush;"><h1>Registered Users</h1></div>';

require ('mysqli_connect.php'); // Connect to the db.
		
// Make the query:
$q = "SELECT CONCAT(lname, ', ', fname) AS name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr FROM users ORDER BY registration_date ASC";		
$r = @mysqli_query ($dbc, $q); // Run the query.

// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.

	echo '<div style="width:fit-content; margin:40px auto; padding:20px 40px; background-color:lavenderblush; border:2px solid plum; border-radius:10px; box-shadow:4px 4px 10px mediumorchid; text-align:center; color:mediumorchid;">';// start of div wrapper

	// Print how many users there are:
	echo '<div style="text-align: center; color: mediumorchid;"> <p>There are currently ' . "$num" . ' registered users.</p> </div>';

	// Table header.
	echo '<table style="margin: 10px auto; padding-left:5%" cellspacing="3" cellpadding="3" width="100%">
	<tr><td align="left" width="220px"><b>Name</b></td><td align="left" width="200px"><b>Date Registered</b></td></tr>';
	
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr><td align="left">' . $row['name'] . '</td><td align="left">' . $row['dr'] . '</td></tr>';
	} 

	echo '</table>'; // Close the table.
	echo '</div>'; //closes the div wrapper container
	
	mysqli_free_result ($r); // Free up the resources.	

} else { // If no records were returned.

	echo '<p class="error">There are currently no registered users.</p>';

}

mysqli_close($dbc); // Close the database connection.

include ('footer.php');
?>