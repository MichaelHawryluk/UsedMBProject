<?php

//Connects to database
require ('connect.php');
	
	if($_POST['command'] === "Create Account")
	{
		header("Location: signUp.php");
	}

	if($_POST['password'] != $_POST['confirmPassword'])
	{
		$errorMessage = "Passwords don't match.";
	}

	$username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$find = $_POST['username'];
    $find = preg_replace("#[^0-9a-z]#i", "", $find);
           
 	//Creates a select statement to show the specific record based on the username in the db
    $userSelect = "SELECT * FROM users WHERE userName LIKE '%$find%'";
    $statement = $db->prepare($userSelect);
    $statement->bindValue(':username', $username, PDO::PARAM_INT);
    $statement->execute();
    $show = $statement->fetch();
	
  	if( $show['userName'] == $_POST['username']
  		&& password_verify($_POST['password'], $show['password'])
  		&& (!empty($_POST['username']))
  		&& (!empty($_POST['password']))
  		&& (!empty($_POST['confirmPassword']))
  		&& $_POST['command'] === "Sign in"
  		&& $_POST['password'] === $_POST['confirmPassword'])
  	{ 
  		//Sets and sanitizes the Id
   		$username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   		$password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   		$find = $_POST['username'];
        $find = preg_replace("#[^0-9a-z]#i", "", $find);
           
	 	//Creates a select statement to show the specific record based on the ID
	    $userSelect = "SELECT * FROM users WHERE userName LIKE '%$find%'";
	    $statement = $db->prepare($userSelect);
	    $statement->bindValue(':username', $username, PDO::PARAM_INT);
	    $statement->execute();
	    $show = $statement->fetch();
	    
	    if(count($show) >= 1)
	    {
	    	//print_r($show);
	    	$_SESSION["username"] = $show['userName'];
	    	header("Location: index.php");
	    	print_r($_SESSION["username"]);
	    }
	 	else
	 	{
	 		$errorMessage = "You must create a profile";
	 		session_destroy();
	 	}
	} 
	else 
	{
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		//print_r($show['password']);
		$errorMessage = "Sorry " . $username . "! There was an error with your information, click the link below to try again.";
		session_destroy();
	}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title>UsedMB - Manitoba's local buy and sell</title>
	<link rel="stylesheet" type="text/css" href="ProjectCSS.css"/>
</head>
<body>
	<header>
		<div id="headerContainer">
			<div id="navBar">
				<ul>
					<li><a href="index.php">Home</a></li>
					<?php if(!isset($_SESSION['username'])): ?>
						<li><a href="login.php">Sign in to Post!</a></li>											 
					<?php else: ?>
						<li><a href="newPost.php">Post an Ad</a></li>
					<?php endif; ?>					
					<li><a href="index.php#Posts">Recent Posts</a></li>
					<li><a href="ProjectContactForm.php">Contact Us</a></li>
					<li><a href="ProjectTerms.php">Terms</a></li>
					<?php if(!isset($_SESSION['username'])): ?>
						<li><a href="login.php">Log in</a></li>
						<li><a href="signUp.php">Sign up</a></li>				 
					<?php else: ?>
						<li><?= print_r($_SESSION['username'], true) ?></li>
						<li><form method="POST" action="logout.php">
							<button id="logout" name="logout">Logout</button>
						</form></li>
					<?php endif; ?>
				</ul>				
			</div>
		</div>
	</header>
	<section id = "headerPictures">
		 <!-- Edited picture from Wikipedia commons hhttps://www.google.com/search?q=map+of+manitoba&rlz=1C1PRFI_enCA825CA843&tbm=isch&source=lnt&tbs=sur:f&sa=X&ved=0ahUKEwiE-pbx0OXiAhUQ0awKHWLBDOgQpwUIIQ&biw=1280&bih=913&dpr=1#imgrc=NZ0-2KhJfCLeLM:-->
		<h1>
			<img src="images/UsedMbLogo.png" id="manitobaPic" alt="Key Province"/>
			Keepin' it rural. UsedMB.
			<img src="images/coatOfArms.png" id="coatOfArms" alt="MB Coat of Arms"/>
		</h1> 
		 <!-- Picture from wikipedia commons https://upload.wikimedia.org/wikipedia/commons/1/17/Simple_arms_of_Manitoba.svg -->
	</section>
	<?php if(isset($_SESSION['username'])): ?>	
		<a href="newPost.php" id="postAd">Post an Ad</a>
	<?php endif; ?>	
	<section id="content">
		<?php if(isset($_SESSION['username'])): ?>
			<p>Hi, <?= print_r($_SESSION['username'], true) ?>!</p>
		<?php endif; ?>
		<section id="searchNav">
			<form method="POST" action="search.php">				
				<input id="search" name="search" type="text" placeholder="Search" autofocus="autofocus" />
				<input id="searchButton" type="submit" name="command" value="Search Ads"/>
			</form>		
		</section>
				<h3><?= print_r($errorMessage, true); ?></h3>
				<a href="javascript:history.back()">Back to Login</a>
		<footer>
				<div id="footerContainer">
					<div id="navBar2">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php#Posts">Recent Posts</a></li>
							<li><a href="ProjectContactForm.php">Contact Us</a></li>
							<li><a href="ProjectTerms.php">Terms</a></li>
						</ul>
					</div>
					<p>A site to keep it local.</p>
					<h6>Version 1.2 UsedMB 2020 &#169; &#127464;&#127462;</h6>
				</div>
		</footer>
	</section>			
</body>
</html>