<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $page_title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://fonts.googleapis.com/css?family=Amaranth' rel='stylesheet'> <!-- connects a google font to the index page, do NOT remove! -->
	<link rel="icon" type="image/x-icon" href="/images/feather-favicon.png">
	<style>
	
	body{
	    margin:0;
	    padding:0;
	    background-color:#668cff;
	    font-family: 'Trebuchet MS', sans-serif;
	    display:flex;
	    flex-direction: column;
	    min-height: 100vh;
	}
	
	#header{
	    display: flex;
	    align-items: center;
	    justify-content: space-between;
	    background-color:plum;
	    padding: 1% 1%;
	    box-shadow: 4px 4px 10px mediumorchid;
	}
	
	#logoandname{
	    display: flex;
	    margin-left:1.5%;
	    align-items: center;
	    gap: 25px;
	    
	}
	
	#logoandname img{
	    width:64px;
	    height:64px;
	}
	
	#logoandname h2{
	    margin:0;
	    color:lavenderblush;
	    text-align:center;
	    text-decoration: none;
	     text-shadow:
                0 0 5px #0040ff,
                0 0 10px #0040ff,
                0 0 20px #0040ff,
                0 0 40px #0040ff;
                font-family:'Amaranth', sans-serif;
                font-size:1.8em;
                
	}
	#logoandname a{
	    text-decoration: none;
	}
	

	ul{
	    display:flex;
	    justify-content:center;
	    list-style-type: none;
	    margin:0;
	    padding:1%;
	    overflow: hidden;
	    background-color: transparent;
	    /*box-shadow: 4px 4px 10px mediumorchid;*/
	    
	}
	
	ul li{
	    float: left;
	}
	ul li a{
	    display: block;
	    color:lavenderblush;
	    text-align: center;
	    margin-right:30px;
	    padding: 14px 16px;
	    text-decoration: none;
	    border-radius:15px;
	    box-shadow: 2px 2px darkmagenta;
	    background:mediumorchid;
	    
	    
	}
	ul li a:hover{
	    background-color:darkorchid;
	}
	
	
	
	/*MEDIA QUERIES BELOW FOR PHONE*/
	@media screen and (max-width: 390px){

        #header{
            flex-direction: column;
            align-items: center;
        }
	    
	    #logoandname{
	        flex-direction:column;
	        text-align:center;
	        margin-bottom: 10px;
	    }
	    
	    nav{
	        width:100%;
	    }
	    
	    ul{
	        flex-direction:column;
	        /*width:100%;*/
	        align-items: center;
    	}
	

    	ul li{
	    width:100%;
	    text-align: center;
	    margin-top:2%;
	    margin-bottom:2%;
    	}
	
    	ul li a{
    	
	    margin-right:4%;
	    margin-left: 4%;
    	}
	}/*END OF MEDIA QUERY!*/
	
	</style>
</head>
<body>
	<div id="header">
	    <div id="logoandname">
	        <a href="index.php"><img src="images/feather-logo.png" alt="website Logo"></a>
	        <a href="index.php"><h2>Blooming Ink</h2></a>
	        </div>
	        <nav>
		<ul>
			<li><a href="index.php">Home Page</a></li>
			<li><a href="register.php">Register</a></li>
			<li><a href="view_users.php">View Users</a></li>
			<li><a href="password.php">Change Password</a></li>
			<li><?php // Create a login/logout link:
if ( (isset($_SESSION['user_id'])) && (basename($_SERVER['PHP_SELF']) != 'logout.php') ) {
	echo '<a href="logout.php">Logout</a>';
} else {
	echo '<a href="login.php">Login</a>';
}
?></li>
		</ul>
	</nav>
	</div>
	<div id="main-content"><!-- Start of the page-specific content. -->
<!-- Script 12.7 - header.html -->