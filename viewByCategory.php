<?php
//Requires a connection to the database.
require 'connect.php';

$category = $_GET['category'];

//Select statement to look for all recors in the blog database and deliver them in reverse order
$query = "SELECT * FROM posts WHERE category = '$category'";
$statement = $db->prepare($query);
$statement->execute();
$posts = $statement->fetchAll();


$query = "SELECT * FROM categories ORDER BY categoryType ASC ";
$statement = $db->prepare($query);
$statement->execute();

// Fetch the returned provinces as an array of hashes.
$categories = $statement->fetchAll();

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
			<input id="search" name="search" type="text" placeholder="Search" autofocus="autofocus" />
			
			<a href="newPost.php" id="postAd">Post an Ad</a>
		</section>

   <form id="inventory" method="POST" action="updateDelete.php">
         <fieldset>
  			<table><tr>
  				<?php foreach($categories as $category): ?>
					<td><p><a href="viewByCategory.php?category=<?= $category['categoryType']?>"><?= $category['categoryType']?></a></p></td>
         		<?php endforeach ?>
         	</tr>
         </table><table>
					<?php foreach ($posts as $post): ?>					
							<tbody id="adBody">
									<tr>
										<th>
											<!-- EDIT THE POST --->
											<p class="title"><a href="show.php?postId=<?= $post['postId']?>"><?= $post['title'] ?></a></h4>
											<p class="category">in <?= $post['category']?></h5>
										</th>
									</tr></fieldset>	
									<tr>
										<td>
											<!-- if checks the length of the content--> 
											<?php if(strlen($post['description'])<200): ?>
											<div id ="postDescription">
												<?= $post['description'] ?>
											</div>
											<?php endif; ?>

											<!-- checks the length of the content and truncates with a read more link-->
											<?php if(strlen($post['description'])>200): ?>
												<div id="postContent">
													<?= substr($post['description'], 0, 200) ?> <a href="show.php?postId=<?= $post['postId']?>">Read more...</a>
												</div>
											<?php endif; ?>
											
											<?php if($post['picturePath'] != null): ?>
												<div id="picture">
													<img src="uploads/<?=$post['picturePath']?>">
											<?php endif; ?>
											<!-- date format from the database timestamp-->
											<p><?=date("F j, Y, h:i A",strtotime($post['date'])) ?></p>
										</td>
									</tr>
									<tr>									
									</tr>						
						</tbody>		
					<?php endforeach; ?>							
			</table>	           
      </fieldset>
  </form>
  <footer>
      <div id="footerContainer">
        <div id="navBar2">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php#Posts">Recent Posts</a></li>
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