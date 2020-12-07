<?php
	//Requires the connection to the database and that the user is authenticated.
	require 'connect.php';
	require 'authenticate.php';

	//Checks if the $_GET parameter is set.
	if (isset($_GET['postId']))
	{	
		//Sets and sanitizes the id parameter
		$postId = filter_input(INPUT_GET, 'postId', FILTER_SANITIZE_NUMBER_INT);

		//Creates a select statement to pull the specfic record based on the ID
		$selectQuery = "SELECT * from posts WHERE postId = :postId LIMIT 1";
		$selectStatement = $db->prepare($selectQuery);
		$selectStatement->bindValue(':postId', $postId, PDO::PARAM_INT);
		$selectStatement->execute();
		$select = $selectStatement->fetch();
	}
	if(isset($_POST['command']))
	{
		$text=$_POST['description'];
		echo $text;
	}



	//$description = htmlspecialchars_decode($select['description']);

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

		
	<form id="editPost" method="POST" enctype= "multipart/form-data" action="updateDelete.php">
		
			<section id="content">
				<section id="searchNav">
					<button id= "searchButton">Search</button>
					<input id="search" name="search" type="text" placeholder="Search for anything...!" autofocus="autofocus" />
					
					<a href="newPost.php" id="postAd">Post an Ad</a>
				</section>
				<fieldset>
					<label>Title</label>
					<input id="title" name="title" value="<?=$select['title'] ?>" />
					<label>Description</label>
					<textarea id="description" name="description" rows="15" cols="30"><?= $select['description']?></textarea>
					<?php if($select['picturePath'] != null): ?>
											<div class="picture">
												<img src="uploads/<?=$select['picturePath']?>" alt="image">
												<input type="submit" id="DeletePic" name="command" value="Delete Picture"onclick="return confirm('Are you sure you want to delete this picture?')"/>
											</div>
					<?php endif; ?>
					<input type="hidden" name="postId" value="<?= $select['postId'] ?>" />
					<input type="hidden" name="picturePath" value="<?= $select['picturePath'] ?>" />

					<input type="submit" id="Update" name="command" Value="Update" />
					<input type="submit" id="Delete" name="command" value="Delete" onclick="return confirm('Are you sure you want to delete this post?')"/>
					
				</fieldset>
			</section>	
	</form>
	<script src="ckeditor5/ckeditor.js"></script>
	<script>	
		ClassicEditor.create(document.getElementById('description'));
	</script>
	<!--<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  	<script>tinymce.init({forced_root_block: false, selector:'textarea'});</script>

</body>
</html>