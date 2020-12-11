<!--------s------------
    
    Final Project: UsedMB
    Name: Mike Hawryluk
    Date: June.12.2019
    Description: A website idea for resale of new or used items..... Kinda like Kijiji(but someday better)

---------------------->

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
		<form method="post">
			<fieldset>
				<legend>Your Information</legend>
				<div id="contact">
				<ul>
					
					<li>
						<label for="email">Email</label>
						<input id="email" type="email" name="email" placeholder="someone@example.com"/>
						<div class="error" id="email_error">* Please enter a valid email address</div>
					</li>
					<li>
						<label for="phone">Phone Number</label>
						<input id="phone" name="phone" type="tel" />
						<div class="error" id="phone_error">* Please enter a valid phone number</div>
					</li>
					<li>
						<label for="name">Your Name</label>
						<input id="name" type="text" name="name" />
						<div class="error" id="name_error">*Please enter your name</div>
					</li>
					<li>
						<label for="comments">Comments or Suggestions</label>
						<textarea id="comments" name="comments" placeholder="Item not posting to page after submitting... help!" rows="6"></textarea>
						<div class="error" id="comments_error">* Give a brief description of why you're contacting us</div>
					</li>
					<li>
						<button type="submit" value="Submit Form">Submit</button>
						<button type="reset" id="clearButton">Reset Form</button>
					</li>
				</ul>
				</div>
			</fieldset>
		</form>
			<footer>
				<div id="footerContainer">
					<div id="navBar2">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="index.php#Posts">Recent Posts</a></li>
							<li><a href="ProjectContactForm.php">Contact Us</a></li>
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