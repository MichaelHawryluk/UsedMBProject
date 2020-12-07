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

 /* if($_POST) {
  	if($_FILES["uploadPic"]["error"] != 0) {
  		$error = "File Upload Error, you must submit a picture." . $_FILES["uploadPic"]["error"];
  	} else {
  		$fileName = basename($_FILES['uploadPic']['name']);
  		$newName = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $filename;

  		if(!(move_uploaded_file($_FILES['uploadPic']['tmp_name'], $newname))) {
  			$error = "Sorry a problem occurred when saving the file.";
  		}
  	}
  }*/
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
	         		 		</select><br><br>
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
		</form>
	</section>
	<script src="ckeditor5/ckeditor.js"></script>
<script>	
	ClassicEditor.create(document.getElementById('description'));
</script>
</body>
</html>
