<?php


?>
<!DOCTYPE html>
<html lang="en">
<style>


h3 {
    text-align: center;
    color: plum;
}

/* Comment Card Styling */
.comment {
    width: 80%;
    margin: 20px auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 5px;
    overflow: hidden;
    background-color: plum;
	color:lavenderblush;
	
}

.commentbody {
	color:lavenderblush;
    padding: 15px;
    font-size: 16px;
}

.timestamp {
    background-color: plum;
    padding: 10px 15px;
    font-size: 16px;
	color: lavenderblush;
    text-align: left;
    border-top: 1px solid #ddd;
}

h3{
    text-align: center;
    color:mediumorchid;
    border: 2px solid lavenderblush;
    border-radius:20px;
    background: lavenderblush;
    margin-left:35%;
    margin-right:35%;
}

</style>

<head>

</head>


<body>

<?php

//This includes the header and mysqldatabase.
$page_title = "View Comments";
include('header.php');
include('mysqli_connect.php');

//Get whatever information you need from either GET, SESSION, or POST
$blogid = mysqli_real_escape_string($dbc, trim($_GET['blogpost_id']));

//Your SQL Query
$query = "SELECT comments.*, users.fname FROM comments JOIN users ON comments.user_id = users.user_id WHERE blogpost_id=$blogid";
$result = mysqli_query($dbc, $query);
?>
<h3>Comments for blogpost user # <?php echo $blogid; ?></h3>

        <?php
		//Your loop to display everything
        // Display comments
        $i = 1;
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		?>
		
		<div class="comment">
			<div class="commentbody">Comment <?php echo $i . "<br>"; ?> <?php echo $row['comment_body']; ?></div>
           <div class="timestamp">Posted by <?php echo htmlspecialchars($row['fname']); ?> | <?php echo date('F j, Y g:i A', strtotime($row['comment_timestamp'])) . " <em style='font-size:0.8em;'>(Times displayed in UTC)</em>"; ?></div>
            </div>
			
			<?php
            $i++;
        }
        include('footer.php');
        ?>
	
</body>