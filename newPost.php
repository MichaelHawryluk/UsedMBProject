<?php
  require('connect.php');
   require('authenticate.php');
  // Query all the categories from the database.
  $query = "SELECT * FROM categories ORDER BY categoryType";
  $statement = $db->prepare($query);
  $statement->execute();

  // Fetch the returned provinces as an array of hashes.
  $categories = $statement->fetchAll();

  $error = false;


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
					<li><a href="index.php#Posts">Recent Posts</a></li>
					<li><a href="ProjectContactForm.html">Contact Us</a></li>
					<li><a href="ProjectTerms.html">Terms</a></li>
					<?php if(isset($_SESSION['username'])): ?>
						<li><a href="#">Log in</a></li>
						<li><a href="signUp.php">Sign up</a></li>
					<?php else ?>
						<p><?= $_SESSION['username'] ?></p>
					<?php endif; ?>	
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
		<form id="inventory" method="POST" enctype= "multipart/form-data" action="processPost.php">
				<fieldset>
					<?php if ($error): ?>
						<p><?= $error ?></p>
					<?php endif ?>
							<label for="title">Title</label>
							<input name="title" id="title" type="text"><br><br>
							<label for="price">Price in $(CAD)</label>
							<input name="price" id="price" type="number"><br><br>
							<label id="category">Category</label>
							<select class="form-control" name="category" id="categoryDropDown">
							<?php foreach($categories as $category): ?>
	            				<option>
	              						<?= $category['categoryType'] ?>
	            				</option>
	         		 			<?php endforeach; ?>
	         		 		</select>
	         		 		<p>No valid category? <a href="newCategory.php">Click here to create new category</a></p><br>

							<label  id="upload">Upload Pictures</label><br>
							<input id="picturePath" type="file" name="picturePath">
							<label>Description</label>
							<textarea id="description" name="description" rows="10" placeholder="Write a detialed description about what you're selling here..."></textarea><br>
						
							<input id="postAd" type="submit" name="command" value="Post Ad"/>
				</fieldset>	<br><br>
			<footer>
				<div id="footerContainer">
					<div id="navBar2">
						<ul>
							<li><a href="index.php?sort">Home</a></li>
							<li><a href="index.php?sort#Posts">Recent Posts</a></li>
							<li><a href="ProjectContactForm.html">Contact Us</a></li>
							<li><a href="ProjectTerms.html">Terms</a></li>
						</ul>
					</div>
					<p>A site to keep it local.</p>
					<h6>Version 1.2 UsedMB 2020 &#169; &#127464;&#127462;</h6>
				</div>
			</footer>
		</form>
	</section>
	<script src="ckeditor5/ckeditor.js"></script>
<script>	
	ClassicEditor.create(document.getElementById('description'));
</script>
</body>
</html>
