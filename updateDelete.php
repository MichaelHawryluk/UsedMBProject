<?php
	//Requires a connection to the database
	require "connect.php";
	
	//Checks to see if the Delete button was clicked
	if($_POST['command'] === "Delete")
	{
		//Sets and sanitizes the id
		$postId = filter_input(INPUT_POST, 'postId', FILTER_SANITIZE_NUMBER_INT);


		//Creates a Delete statement, to remove the record with that id from the database
		$deleteQuery = "DELETE FROM posts WHERE postId = :postId LIMIT 1";
		$deleteStatement = $db->prepare($deleteQuery);
		$deleteStatement->bindValue(':postId', $postId, PDO::PARAM_INT);
		$deleteStatement->execute();
		header("Location: index.php");

		print_r($deleteStatement->errorInfo());

		exit;
	}

	elseif($_POST['command'] === "Delete Picture")
	{
		$postId = filter_input(INPUT_POST, 'postId', FILTER_SANITIZE_NUMBER_INT);
		$picturePath = filter_input(INPUT_POST, 'picturePath', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$deleteQuery = "UPDATE posts SET picturePath = :picturePath=NULL WHERE postId = :postId";
		$deleteStatement = $db->prepare($deleteQuery);
		$deleteStatement->bindValue(':picturePath', $picturePath);
		$deleteStatement->bindValue(':postId', $postId);
		$deleteStatement->execute();

		$path = "uploads/".$picturePath;
		if(!unlink($path)) {
			echo"you have an error";
		} else {
			header("Location: index.php");
		}

		//print_r($deleteStatement->errorInfo());
		

		exit;
	}


	//Checks to see if the Update button was clicked
	elseif($_POST['command'] === "Update")
	{
		print_r('command');
		if(!empty($_POST['title']) && (!empty($_POST['description'])))
		{

			//Filters the title, description and the id to store in the database
			$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$description = $_POST['description'];
			$postId = filter_input(INPUT_POST, 'postId', FILTER_SANITIZE_NUMBER_INT);
			$category = filter_input(INPUT_POST, 'categoryType', FILTER_SANITIZE_FULL_SPECIAL_CHARS)

			//Creates a Update statement, to update the record with that id in the database
			$updateQuery = "UPDATE posts SET title = :title, description = :description, category = :categoryType WHERE postId = :postId";
			$updateStatement = $db->prepare($updateQuery);
			$updateStatement->bindValue(':title', $title);
			$updateStatement->bindValue(':description', $description);
			$updateStatement->binvalue(':categoryType', $category);
			$updateStatement->bindValue(':postId', $postId, PDO::PARAM_INT);

			$updateStatement->execute();


			print_r($updateStatement);
			//header("Location: index.php");
			exit;
		}
		else
		{
			$message = "Both the title and description must be at least one character.";
		}
		//print_r($updateStatement->errorInfo());
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
					<li><a href="#Posts">Recent Posts</a></li>
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
	<h1>An error occurred while processing your post.</h1>
	<?php print_r($deleteStatement->errorInfo()); ?>
	<?php if(isset($message)): ?>
  		<p><?= $message ?></p>
	<?php endif; ?>
	<a href="index.php">Return Home</a>

	<footer>
	<div id="footerContainer">
		<div id="navBar2">
			<ul>
				<li><a href="index.html">Home</a></li>
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