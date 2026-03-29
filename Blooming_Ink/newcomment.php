<?php

//header
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">



<?php
include('mysqli_connect.php');
if (isset($_SESSION['user_id'])) {

    // variables
    $user_id = $_SESSION['user_id'];
    $blogpost_id = isset($_GET['blogpost_id']) ? intval($_GET['blogpost_id']) : 0;
    $comment_body = isset($_POST['comment']) ? mysqli_real_escape_string($dbc, trim($_POST['comment'])) : '';

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($comment_body)) {
            
            $query = "INSERT INTO comments (user_id, blogpost_id, comment_body, comment_timestamp) 
                      VALUES ('$user_id', '$blogpost_id', '$comment_body', NOW())";
            $result = mysqli_query($dbc, $query);

            if ($result) {
                echo '<div style="width:fit-content; margin:40px auto; padding:20px 40px; background-color:lavenderblush; border-radius:7px; box-shadow:4px 4px 10px mediumorchid; text-align:center;">
                <p style="color:mediumorchid; font-size:1.5em; font-weight:bold;">Thank you! Your comment has been submitted.</p>
                </div>';
            } else {
                echo '<div style="width:fit-content; margin:40px auto; padding:20px 40px; background-color:lavenderblush; border-radius:7px; box-shadow:4px 4px 10px mediumorchid; text-align:center;">
                <p style="color:red; font-size:1.5em; font-weight:bold;">Error: ' . mysqli_error($dbc) . '</p>
                </div>';
            }
        } else {
            echo '<div style="width:fit-content; margin:40px auto; padding:20px 40px; background-color:lavenderblush; border-radius:7px; box-shadow:4px 4px 10px mediumorchid; text-align:center;">
            <p style="color:red; font-size:1.5em; font-weight:bold;">Please enter a comment.</p>
            </div>';
        }
    }
} else {
    echo '<div style="width:fit-content; margin:40px auto; padding:20px 40px; background-color:lavenderblush; border-radius:7px; box-shadow:4px 4px 10px mediumorchid; text-align:center;">
        <p style="color:red; font-size:1.5em; font-weight:bold;">You must be logged in to leave a comment.<br>Please log in, or click the register button to make a new account!</p>
    </div>';
    include('footer.php');
    exit();
}
?>

<style>
#commentcontainer{
    width: fit-content;
    margin: 40px auto;
    padding: 2% 3%;
    background-color: lavenderblush;
    border: 2px solid plum;
    border-radius: 4%;
    box-shadow: 4px 4px 10px mediumorchid;
    text-align: center;
}

#commentcontainer fieldset{
    border:none;
    margin:0;
    padding:0;
}

#commentcontainer legend h1 {
    color: mediumorchid;
}

#submitbutton input[type="submit"]{
        background-color:mediumorchid;
        color:lavenderblush;
        border:none;
        border: 2px solid mediumorchid;
        border-radius: 7px;
        box-shadow: 4px 4px 10px darkorchid;
        cursor: pointer;
    }
    
    
</style>

<div id="commentcontainer">
<form action="newcomment.php?blogpost_id=<?php echo $blogpost_id; ?>" method="POST">
    <fieldset>
        <legend><h1>Leave a comment</h1></legend>
        <p><textarea name="comment" cols="60" rows="5"><?php if (isset($comment_body)) echo $comment_body; ?></textarea></p>
        <p id="submitbutton"><input type="submit" name="submit" value="Submit Comment"></p>
    </fieldset>
</form>
</div>
	<?php include ('footer.php'); ?>
	</html>