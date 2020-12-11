<?php
require('connect.php');
	
	$userName = filter_input(INPUT_GET, 'userName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$find = $_POST['userName'];
    $find = preg_replace("#[^0-9a-z]#i", "", $find);
           
 	//Creates a select statement to show the specific record based on the username in the db
    $userSelect = "SELECT * FROM users WHERE userName LIKE '%$find%'";
    $statement = $db->prepare($userSelect);
    $statement->bindValue(':userName', $userName, PDO::PARAM_INT);
    $statement->execute();
    $show = $statement->fetch();


	$errorMessage = false;

	if($show['userName'] == $_POST['userName'])
	{
		$errorMessage = "Username already taken.";
	}

	if(!empty($_POST['password']) != (!empty($_POST['confirmPassword'])))
	{
		$errorMessage = "Passwords don't match.";
	}



  	elseif($_POST && (!empty($_POST['userName'])) 
  			&& (!empty($_POST['fullName'])) 
  			&& (!empty($_POST['email'])) 
  			&& (!empty($_POST['address'])) 
  			&& (!empty($_POST['city'])) 
  			&& (!empty($_POST['province'])) 
  			&& (!empty($_POST['postalCode'])) 
  			&& (!empty($_POST['password'])) 
  			&& (!empty($_POST['confirmPassword'])))
	{
		//print_r($_POST);
		//print_r($_FILES);

		//Sets and sanitizes username and content
		$userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$fullName = filter_input(INPUT_POST, 'fullName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
		$address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$postalCode = filter_input(INPUT_POST, 'postalCode', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$passwordHash = password_hash($password, PASSWORD_DEFAULT);
		$confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		//if($_POST['userName'])

			if($password === $confirmPassword )
			{
				//Creates an insert statement to insert the new record into the database
				$query = "INSERT INTO users (userId, userName, fullName, email, address, city, province, postalCode, password) VALUES (:userId,  :userName, :fullName, :email, :address, :city, :province, :postalCode, :passwordHash)";
				$statement = $db->prepare($query);
				$statement->bindValue(':userId', $userName);
				$statement->bindValue(':userName', $userName);
				$statement->bindValue(':fullName', $fullName);
				$statement->bindValue(':email', $email);
				$statement->bindValue(':address', $address);
				$statement->bindValue(':city', $city);
				$statement->bindValue(':province', $province);
				$statement->bindValue(':postalCode', $postalCode);
				$statement->bindValue(':passwordHash', $passwordHash);
				
				$statement->execute();
				//print_r($statement->errorInfo());
				//print_r($_POST['userName']);
				//print_r($show['userName']);
				header("Location: login.php");
			exit;
			}
			else{
				$errorMessage = "Passwords must match.";
			}		
	}
	else(

		$errorMessage = "You must fill all of the fields to submit you profile."
	)


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
	<?php if($errorMessage > 0): ?>
		<h2>An error occured while processing your profile.</h2>
		<p>You must fill each input field to verify your account.</p>
		<?= print_r($show["userName"]); ?>
		<?php endif; ?>		
	</p>
	<h3><?= $errorMessage ?></h3>
	<a href="javascript:history.back()">Return to Sign up</a><br><br>
	<a href="index.php">Return Home</a>
	<footer>
		<div id="footerContainer">
			<div id="navBar2">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="index.html#Posts">Recent Posts</a></li>
					<li><a href="ProjectContactForm.html">Contact Us</a></li>
					<li><a href="ProjectTerms.html">Terms</a></li>
				</ul>
			</div>
			<p>A site to keep it local.</p>
			<h6>Version 1.2 UsedMB 2020 &#169; &#127464;&#127462;</h6>
		</div>
	</footer>
</body>
</html>