<?php

//Connects to database
require ('connect.php');

	
  	if(!empty($_POST['username'])
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
	 	}

	} else {
		$errorMessage = "Username and password not valid!";
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
					<li><a href="newPost.php">Post an Ad</a></li>
					<li><a href="#Posts">Recent Posts</a></li>
					<li><a href="ProjectContactForm.html">Contact Us</a></li>
					<li><a href="ProjectTerms.html">Terms</a></li>
					<?php if(!isset($_SESSION['username'])): ?>
						<li><a href="login.php">Log in</a></li>
						<li><a href="signUp.php">Sign up</a></li>	</ul>					 
					<?php else: ?>
						<?= print_r($_SESSION['username'], true) ?>
						<form id="logout" method="POST" action="logout.php">
							<button id="logout" name="logout">Logout</button>
						</form>
					<?php endif; ?>

				
			</div>
		</div>
	</header>
	<section id = "headerPictures">
		 <!-- Edited picture from Wikipedia commons hhttps://www.google.com/search?q=map+of+manitoba&rlz=1C1PRFI_enCA825CA843&tbm=isch&source=lnt&tbs=sur:f&sa=X&ved=0ahUKEwiE-pbx0OXiAhUQ0awKHWLBDOgQpwUIIQ&biw=1280&bih=913&dpr=1#imgrc=NZ0-2KhJfCLeLM:-->
		<h1>
			<img src="images/UsedMbLogo.png" id="manitobaPic" alt="Key Province"/>
			Manitoba's best local buy and sell
			<img src="images/coatOfArms.png" id="coatOfArms" alt="MB Coat of Arms"/>
		</h1> 
		 <!-- Picture from wikipedia commons https://upload.wikimedia.org/wikipedia/commons/1/17/Simple_arms_of_Manitoba.svg -->
	</section>

		
	<a href="newPost.php" id="postAd">Post an Ad</a>
	<section id="content">
		<section id="searchNav">
			<form id="search" method="POST" action="search.php">
				
				<input id="search" name="search" type="text" placeholder="Search" autofocus="autofocus" />
				<input id="search" type="submit" name="command" value="Search Ads"/>
			</form>
			
			<fieldset>
				<?= print_r($errorMessage); ?>
			</fieldset>
		</section>
	</section>
</body>
</html>