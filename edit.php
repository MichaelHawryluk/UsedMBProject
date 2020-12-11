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

  // Query all the categories from the database.
  $query = "SELECT * FROM categories ORDER BY categoryType";
  $statement = $db->prepare($query);
  $statement->execute();

  // Fetch the returned provinces as an array of hashes.
  $categories = $statement->fetchAll();

  $error = false;

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
					<?php if(!isset($_SESSION['username'])): ?>
						<li><a href="login.php">Sign in to Post!</a></li>											 
					<?php else: ?>
						<li><a href="newPost.php">Post an Ad</a></li>
					<?php endif; ?>					
					<li><a href="index.php#Posts">Recent Posts</a></li>
					<li><a href="ProjectContactForm.php">Contact Us</a></li>
					<li><a href="ProjectTerms.html">Terms</a></li>
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
		<form id="editPost" method="POST" enctype= "multipart/form-data" action="processPost.php">
					<fieldset>
						<label>Title</label>
						<input id="title" name="title" value="<?=$select['title'] ?>" />
						<label for="price">Price in $(CAD)</label>
						<input name="price" id="price" type="number" value="<?=$select['price'] ?>"/><br><br>
						<select class="form-control" name="category" id="categoryDropDown">
							<?php foreach($categories as $category): ?>
		            			<option>
		              					<?= $category['categoryType'] ?>
		            			</option>
		         		 		<?php endforeach; ?>
		         		 </select><br><br>
						<label>Description</label>
						<textarea id="description" name="description" rows="15" cols="30"><?= $select['description']?></textarea><br>
						<?php if($select['picturePath'] != null): ?>
												<div class="picture">
													<img src="uploads/<?=$select['picturePath']?>" alt="image">
													<br><input type="submit" id="DeletePic" name="command" value="Delete Picture" onclick="return confirm('Are you sure you want to delete this picture?')"/>
												</div>
						<?php else: ?>
							<label  id="upload">Upload Pictures</label><br>
								<input id="picturePath" type="file" name="picturePath">
						<?php endif; ?>
						<input type="hidden" name="postId" value="<?= $select['postId'] ?>" />
						<input type="hidden" name="picturePath" value="<?= $select['picturePath'] ?>" />

						<input type="submit" id="Update" name="command" value="Update" />
					
						<input type="submit" id="Delete" name="command" value="Delete" onclick="return confirm('Are you sure you want to delete this post?')"/>
						
					</fieldset>	
		</form>
	</section>
	<script src="ckeditor5/ckeditor.js"></script>
	<script>	
		ClassicEditor.create(document.getElementById('description'));
	</script>
	<!--<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  	<script>tinymce.init({forced_root_block: false, selector:'textarea'});</script>-->
</body>
</html>