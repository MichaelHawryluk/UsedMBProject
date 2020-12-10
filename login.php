<?php
	//Requires the connection to the database and that the user is authenticated.
	require 'connect.php';
	require 'authenticate.php';

	//Checks if the $_GET parameter is set.
	if (isset($_GET['username']))
	{	
		//Sets and sanitizes the id parameter
		$userId = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_NUMBER_INT);

		//Creates a select statement to pull the specfic record based on the ID
		$selectQuery = "SELECT * from users WHERE userId = :userId LIMIT 1";
		$selectStatement = $db->prepare($selectQuery);
		$selectStatement->bindValue(':userid', $userId, PDO::PARAM_INT);
		$selectStatement->execute();
		$select = $selectStatement->fetch();
	}
	if(isset($_POST['command']))
	{

	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>UsedMB Login</title>
	<link rel="stylesheet" type="text/css" href="ProjectCSS.css"/>
	<link rel="stylesheet" type="text/css" href="">
</head>
<body>
	<body>
	<header>
		<div id="headerContainer">
			<div id="navBar">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="newPost.php">Post an Ad</a></li>
					<li><a href="index.php#Posts">Recent Posts</a></li>
					<li><a href="ProjectContactForm.html">Contact Us</a></li>
					<li><a href="ProjectTerms.html">Terms</a></li>
					<li><a href="login.php">Log in</a></li>
					<li><a href="signUp.php">Sign up</a></li>

				</ul>
			</div>
		</div>
	</header>
	<section id = "headerPictures">
		 <!-- Edited picture from Wikipedia commons hhttps://www.google.com/search?q=map+of+manitoba&rlz=1C1PRFI_enCA825CA843&tbm=isch&source=lnt&tbs=sur:f&sa=X&ved=0ahUKEwiE-pbx0OXiAhUQ0awKHWLBDOgQpwUIIQ&biw=1280&bih=913&dpr=1#imgrc=NZ0-2KhJfCLeLM:-->
		<h1>
			<img src="images/UsedMbLogo.png" id="manitobaPic" alt="Key Province"/>
			
			<img src="images/coatOfArms.png" id="coatOfArms" alt="MB Coat of Arms"/>
		</h1> 
		 <!-- Picture from wikipedia commons https://upload.wikimedia.org/wikipedia/commons/1/17/Simple_arms_of_Manitoba.svg -->
	</section>
	<form id="editPost" method="POST" enctype= "multipart/form-data" action="processLogin.php">
		
			<section id="content">
				<section id="searchNav">
					<button id= "searchButton">Search</button>
					<input id="search" name="search" type="text" placeholder="Search for anything...!" autofocus="autofocus" />
					
					<a href="newPost.php" id="postAd">Post an Ad</a>
				</section>
				<fieldset>
					<label>Username</label>
					<input id="username" name="username"/>
					<label>Password</label>
					<input id="password" name="password" type="password"/>
					<label>Confirm password</label>
					<input id="confirmPassword" name="confirmPassword" type="password"/>
					
					<input type="hidden" name="postId" value="<?= $select['postId'] ?>" />
					

					<input type="submit" id="Sign in" name="command" Value="Sign in" />
					
					<a href="signUp.php">Create Account</a>
				</fieldset>
				
			</section>	
	</form>

</body>
</html>