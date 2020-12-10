<?php
require 'connect.php';

    if (isset($_POST['search']))
        {
            $find = $_POST['search'];
            $find = preg_replace("#[^0-9a-z]#i", "", $find);
            $query = "SELECT * FROM posts WHERE title LIKE '%$find%'";
            $statement = $db->prepare($query);
            $statement->execute();

            $posts = $statement->fetchAll();
        }

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
					<?php if(!isset($_SESSION['username'])): ?>
						<li><a href="signUp.php">Sign in to Post!</a></li>											 
					<?php else: ?>
						<li><a href="newPost.php">Post an Ad</a></li>
					<?php endif; ?>					
					<li><a href="#Posts">Recent Posts</a></li>
					<li><a href="ProjectContactForm.php">Contact Us</a></li>
					<li><a href="ProjectTerms.html">Terms</a></li>
					<?php if(!isset($_SESSION['username'])): ?>
						<li><a href="login.php">Log in</a></li>
						<li><a href="signUp.php">Sign up</a></li>	</ul>					 
					<?php else: ?>
						<?= print_r($_SESSION['username'], true) ?>
						<form id="logout" method="POST" action="logout.php">
							<button id="logout" name="logout">Logout</button>
						</form>
					<?php endif; ?>

				
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
			<section id="posts" >
				<h3 id="Posts">Search by Title</h3>
				<section id ="categories">
					<h4>View Ads by Category</h4><br>
					<?php foreach($categories as $category): ?>
		            	<a href="viewByCategory.php?category=<?= $category['categoryType']?>"><?= $category['categoryType']?></a>
	         		<?php endforeach; ?>        	
				</section>

				<?php if(!isset($posts) || $statement->rowCount() <= 0): ?>
            	<p>Sorry, no ads found with this keyword(s).</p>
        		<?php else: ?>

        		<?php foreach($posts as $post): ?>
        			<br><table>				
							<tbody class="adBody">			
								<tr>
									<th>
										<!-- EDIT THE POST --->
										<p class="title"><a href="show.php?postId=<?= $post['postId']?>"><?= $post['title'] ?></a></p>
										<p class="category"><?= $post['category']?></p>
									</th>
								</tr>
								<tr>
									<td>										
										<?php if($post['picturePath'] != null): ?>
											<div class="picture">
												<img src="uploads/<?=$post['picturePath']?>" alt="image">
											</div>
										<?php endif; ?>
									
										<!-- if checks the length of the content--> 
										<?php if(strlen($post['description'])<200): ?>
										<div class="postDescription">
											<?= $post['description'] ?>
										</div>
										<?php endif; ?>
										
										
										<!-- checks the length of the content and truncates with a read more link-->
										<?php if(strlen($post['description'])>200): ?>
											<div class="postContent">
												<?= substr($post['description'], 0, 200) ?> <a href="show.php?postId=<?= $post['postId']?>">Read more...</a>
											</div>
										<?php endif; ?>
										
										<!-- date format from the database timestamp-->
										<p><?=date("F j, Y, h:i A",strtotime($post['date'])) ?></p>
									</td>
								</tr>										
							</tbody>
						</table>
					<?php endforeach; ?>
				<?php endif; ?>
			</section>
	</section>
</body>
</html>