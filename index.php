<!--------------------
    
    Final Project: UsedMB
    Name: Mike Hawryluk
    Date created: June.12.2019
	Date continued: Nov.07.2020
    Description: A website for resale of new or used items. 

    Logo credit - https://www.smartblonde.net/manitoba-novelty-background-wholesale-metal-license-plate-lp-1505/

---------------------->

<?php
//Requires a connection to the database.
require 'connect.php';


//Sets and sanitizes the Id
$postId = filter_input(INPUT_GET, 'postId', FILTER_SANITIZE_NUMBER_INT);

//Select statement to look for all recors in the blog database and deliver them in reverse order
$query = "SELECT * FROM posts";
if (isset($_GET['sort'])  && $_GET['sort']== 'Highest')
{
    $query .= " ORDER BY price DESC";
}
elseif (isset($_GET['sort']) && $_GET['sort'] == 'Lowest')
{
    $query .= " ORDER BY price ASC";
}
elseif (isset($_GET['sort']) && $_GET['sort'] == 'Category')
{
    $query .= " ORDER BY category";
}
elseif (isset($_GET['sort']) && $_GET['sort']== 'Date')
{
    $query .= " ORDER BY date";
};


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
					<li><a href="#Posts">Recent Posts</a></li>
					<li><a href="ProjectContactForm.html">Contact Us</a></li>
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
			Manitoba's best local buy and sell
			<img src="images/coatOfArms.png" id="coatOfArms" alt="MB Coat of Arms"/>
		</h1> 
		 <!-- Picture from wikipedia commons https://upload.wikimedia.org/wikipedia/commons/1/17/Simple_arms_of_Manitoba.svg -->
	</section>

		
	<a href="newPost.php" id="postAd">Post an Ad</a>
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

		<section id="news">
			<h3>News</h3>
			<p>What's new:</p> 
			<ol>
				<li>Bug fixes</li>
				<li>Search now more accurate</li>
				<li>Posting a new ad goes directly into featured list</li>
			</ol>
			<p><strong>Winter is here!</strong> Gear up with new and used items in your area! <br/><br/></p>
			<ul id="newsItems">
				<li></li>
				<li>COVID-19 INFORMATION<a href="https://www.gov.mb.ca/covid19/index.html"> HERE</a></li>
				<li><a href="https://www.travelmanitoba.com/things-to-do/spring-summer/">Travel Manitoba's Spring and Summer Destinations</a></li> 
			</ul>		
		</section>			
			<section id="posts" >
				<h3 id="Posts">Recent Posts</h3>
				<section id ="categories">
					<h4>View Ads by Category</h4><br>
					<?php foreach($categories as $category): ?>
		            	<a href="viewByCategory.php?category=<?= $category['categoryType']?>"><?= $category['categoryType']?></a>
	         		<?php endforeach; ?>
	         		<h4>Filter Ads By:</h4><br>
						<a href="index.php?sort=Lowest">Lowest Price</a>
	         			<a href="index.php?sort=Highest">Highest Price</a>	         			
	         			<a href="index.php?sort=Date">Date</a>
	         			<a href="index.php?sort=Category">Category</a>
	         			 
	         		<p>All ads
	         			<?php if(isset($_GET['sort'])): ?>
	         			 > <?= $_GET['sort']?>
	         		<?php endif; ?>
	         		</p>
				</section>

				<?php foreach ($posts as $post): ?>	
				<br><table>				
							<tbody class="adBody">			
								<tr>
									<th>
										<!-- EDIT THE POST --->
										<p class="title"><a href="show.php?postId=<?= $post['postId']?>"><?= $post['title']?></a>$<?=$post['price']?></p>
										<p class="category"><?= $post['category']?></p>
									</th>
								</tr>
								<tr>
									<td>
																			
											<?php if($post['picturePath'] != null): ?>												
													<img src="uploads/<?=$post['picturePath']?>" alt="image">												
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
										<?=date("F j, Y, h:i A",strtotime($post['date'])) ?>
									</td>
								</tr>										
							</tbody>
						</table>
						<br>				
				<?php endforeach; ?>										
			</section>	
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
	</section>
</body>
</html>
