<?php
	
	$errorMessage = false;

  	if($_POST && (!empty($_POST['userName'])) 
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
		//exit;

		//Connects to database
		require ('connect.php');

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
		$confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		//if($_POST['userName'])

			if($password === $confirmPassword )
			{
				//Creates an insert statement to insert the new record into the database
				$query = "INSERT INTO users (userId, userName, fullName, email, address, city, province, postalCode, password) VALUES (:userId,  :userName, :fullName, :email, :address, :city, :province, :postalCode, :password)";
				$statement = $db->prepare($query);
				$statement->bindValue(':userId', $userName);
				$statement->bindValue(':userName', $userName);
				$statement->bindValue(':fullName', $fullName);
				$statement->bindValue(':email', $email);
				$statement->bindValue(':address', $address);
				$statement->bindValue(':city', $city);
				$statement->bindValue(':province', $province);
				$statement->bindValue(':postalCode', $postalCode);
				$statement->bindValue(':password', $password);
				
				$statement->execute();
				//print_r($statement->errorInfo());
				header("Location: index.php");
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
					<li><a href="newPost.php">Post an Ad</a></li>
					<li><a href="#Posts">Recent Posts</a></li>
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
			Manitoba's best local buy and sell
			<img src="images/coatOfArms.png" id="coatOfArms" alt="MB Coat of Arms"/>
		</h1> 
		 <!-- Picture from wikipedia commons https://upload.wikimedia.org/wikipedia/commons/1/17/Simple_arms_of_Manitoba.svg -->
	</section>

		
	
	<section id="content">
		<section id="searchNav">
			<button id= "searchButton">Search</button>
			<input id="search" name="search" type="text" placeholder="Search for anything...!" autofocus="autofocus" />
			
			<a href="newPost.php" id="postAd">Post New Ad</a>
			<a href="javascript:history.back()" id="postAd">Back to Sign Up</a>
		</section>

	<?php if($errorMessage > 0): ?>
		<h2>An error occured while processing your profile.</h2>
		<p>You must fill each input field to verify your account.</p>
		<?php endif; ?>		
	</p>
	<h3><?= $errorMessage ?></h3>
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