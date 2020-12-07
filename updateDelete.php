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

			//Creates a Update statement, to update the record with that id in the database
			$updateQuery = "UPDATE posts SET title = :title, description = :description WHERE postId = :postId";
			$updateStatement = $db->prepare($updateQuery);
			$updateStatement->bindValue(':title', $title);
			$updateStatement->bindValue(':description', $description);
			$updateStatement->bindValue(':postId', $postId, PDO::PARAM_INT);

			$updateStatement->execute();



			header("Location: index.php");
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
					<li><a href="newPost.php">Post an Ad</a></li>
					<li><a href="#Posts">Recent Posts</a></li>
					<li><a href="ProjectContactForm.html">Contact Us</a></li>
					<li><a href="ProjectTerms.html">Terms</a></li>
					<li><a href="#">Log in</a></li>
					<li><a href="signUp.php">Sign up</a></li>

				</ul>
			</div>
		</div>
	</header>
	<section id="headerPictures">
		 <!-- Edited picture from Wikipedia commons hhttps://www.google.com/search?q=map+of+manitoba&rlz=1C1PRFI_enCA825CA843&tbm=isch&source=lnt&tbs=sur:f&sa=X&ved=0ahUKEwiE-pbx0OXiAhUQ0awKHWLBDOgQpwUIIQ&biw=1280&bih=913&dpr=1#imgrc=NZ0-2KhJfCLeLM:-->
		<h1>
			<img src="images/UsedMbLogo.png" id="manitobaPic" alt="Key Province"/>
			Manitoba's best local buy and sell
			<img src="images/coatOfArms.png" id="coatOfArms" alt="MB Coat of Arms"/>
		</h1> 
		 <!-- Picture from wikipedia commons https://upload.wikimedia.org/wikipedia/commons/1/17/Simple_arms_of_Manitoba.svg -->
	</section>
	
<section id="content">

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