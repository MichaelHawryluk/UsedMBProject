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
						<li><a href="signUp.php">Sign in to Post!</a></li>											 
					<?php else: ?>
						<li><a href="newPost.php">Post an Ad</a></li>
					<?php endif; ?>					
					<li><a href="#Posts">Recent Posts</a></li>
					<li><a href="ProjectContactForm.php">Contact Us</a></li>
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
	<form id="editPost" method="POST" enctype= "multipart/form-data" action="processLogin.php">
		
				<fieldset>
					<label>Username</label>
					<input id="username" name="username"/>
					<label>Password</label>
					<input id="password" name="password" type="password"/>
					<label>Confirm password</label>
					<input id="confirmPassword" name="confirmPassword" type="password"/>
					
					<input type="hidden" name="postId" value="<?= $select['postId'] ?>" />
					

					<input type="submit" id="Sign in" name="command" Value="Sign in" />
					
					<input type="submit" id="createAccount" name="command" Value="Create Account" />
				</fieldset>
				
			</section>	
	</form>

</body>
</html>