<?php
//Include Composer autoload
require 'vendor/autoload.php';

//Connects to database
require ('connect.php');

//import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;


//builds a path string that uses slashes for the appropriate OS
//default path is 'uploads' subfolder in the current folder.
function fileUploadPath($ogFileName, $uploadSubfolder = 'uploads'){
	$currentFolder = dirname(__FILE__);

	//array of path segments to be joined
	$pathSegments = [$currentFolder, $uploadSubfolder, basename($ogFileName)];

	//joins each path segment with the dedicated OS Directory Separator
	return join(DIRECTORY_SEPARATOR, $pathSegments);
}	

function fileIsAnImage($tempPath, $newPath) {
	$allowedMimeTypes = ['image/gif', 'image/jpeg', 'iamge/png'];
	$allowedFileExtensions = ['gif', 'jpg', 'jpeg', 'png'];

	$actualFileExtention = pathinfo($newPath, PATHINFO_EXTENSION);
	$actualMimeType = getimagesize($tempPath)['mime'];

	$fileExtenstionIsValid = in_array($actualFileExtention, $allowedFileExtensions);
	$mimeTypeIsValid = in_array($actualMimeType, $allowedMimeTypes);

	return $fileExtenstionIsValid && $mimeTypeIsValid;
}

function orientation($exifData){
	foreach ($exifData as $key => $val) {
		if (strtolower($key) == "orientation") {
			return $val;
		}
	}
}

function orientationFlag($orientation) {
	switch ($orientation):
		case 1:
			return 0;	
		case 8:
			return 90;
		case 3:
			return 180;
		case 6:
			return 270;
		endswitch;
	
}

  $imageUploaded= isset($_FILES['picturePath']) && ($_FILES['picturePath']['error'] === 0);
  $imageUploadError = isset($_FILES['picturePath']) && ($_FILES['picturePath']['error'] > 0);

	if($imageUploaded){
	  	$imageFileName = $_FILES['picturePath']['name'];
	  	$tempImagePath = $_FILES['picturePath']['tmp_name'];
	  	$newImagePath = fileUploadPath($imageFileName);
	  	if(fileIsAnImage($tempImagePath, $newImagePath)) {
	  		
			move_uploaded_file($tempImagePath, $newImagePath);
			
			$exifData = exif_read_data($newImagePath);

			$orientation = orientation($exifData);
			$degrees = orientationFlag($orientation);

			$imageData = imagecreatefromjpeg($newImagePath);
			$imageRotate = imagerotate($imageData, $degrees, 0);

			$image = Image::make(file_get_contents($newImagePath))
						->resize(300, null, function ($constraint) {
									$constraint->aspectRatio();
								})
						->save($newImagePath,100);
	  	}
	}

  if($_POST['command'] === "Post Ad")
  	{
		//Checks to see if the form was post and if the fields were not empty
		if($_POST && (!empty($_POST['title']) && (!empty($_POST['description']) )))
		{
			//print_r($_POST);
			//print_r($_FILES);
			//exit;

			//Sets and sanitizes title and content
			$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$description = $_POST['description'];
			$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$picture = $_FILES['picturePath']['name'];

			//Creates an insert statement to insert the new record into the database
			$query = "INSERT INTO posts (title, price, description, category, picturePath) VALUES (:title, :price, :description, :category, :picturePath)";
			$statement = $db->prepare($query);
			$statement->bindValue(':title', $title);
			$statement->bindValue(':price', $price);
			$statement->bindValue(':category', $category);
			$statement->bindValue(':description', $description);
			$statement->bindValue(':picturePath', $picture);

			$statement->execute();

			header("Location: index.php");
			exit;
		}
	}

	//Checks to see if the Update button was clicked
	if($_POST['command'] === "Update")
	{
		//Filters the title, description and the id to store in the database
		$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
		if(isset($_FILES['picturePath']))
		{
			$picturePath = $_FILES['picturePath']['name'];
		}
		else
		{
			$picturePath = filter_input(INPUT_POST, 'picturePath', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		}
		$description = $_POST['description'];
		$postId = filter_input(INPUT_POST, 'postId', FILTER_SANITIZE_NUMBER_INT);

		//Creates a Update statement, to update the record with that id in the database
		$updateQuery = "UPDATE posts SET title = :title, price = :price, description = :description, picturePath = :picturePath  WHERE postId = :postId";
		$updateStatement = $db->prepare($updateQuery);
		$updateStatement->bindValue(':title', $title);
		$updateStatement->bindValue(':price', $price);
		$updateStatement->bindValue(':description', $description);
		$updateStatement->bindValue(':picturePath', $picturePath);
		$updateStatement->bindValue(':postId', $postId, PDO::PARAM_INT);

		$updateStatement->execute();



		header("Location: index.php");
		exit;
	
	//print_r($updateStatement->errorInfo());
	}


	//If content or title was not filled out, outputs this error.
	else
	{
		$message = "Title and description cannot be blank.";
	}

		//Checks to see if the Delete button was clicked
	if($_POST['command'] === "Delete")
	{
		//Sets and sanitizes the id
		$postId = filter_input(INPUT_POST, 'postId', FILTER_SANITIZE_NUMBER_INT);
		$picturePath = filter_input(INPUT_POST, 'picturePath', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


		//Creates a Delete statement, to remove the record with that id from the database
		$deleteQuery = "DELETE FROM posts WHERE postId = :postId LIMIT 1";
		$deleteStatement = $db->prepare($deleteQuery);
		$deleteStatement->bindValue(':postId', $postId, PDO::PARAM_INT);
		$deleteStatement->execute();
		header("Location: index.php");

		$path = "uploads/".$picturePath;
		if(!unlink($path)) {
			echo"you have an error";
		} else {
			header("Location: index.php");
		}

		//print_r($deleteStatement->errorInfo());

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
			<a href="javascript:history.back()" id="postAd">Back to Ad</a>
		</section>

	<h2>An error occured while processing your post.</h2>
	<?php if($imageUploadError): ?>

		<?php endif; ?>		
	</p>
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