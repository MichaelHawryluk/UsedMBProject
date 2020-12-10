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
			Keepin' it rural. UsedMB.
			<img src="images/coatOfArms.png" id="coatOfArms" alt="MB Coat of Arms"/>
		</h1> 
		 <!-- Picture from wikipedia commons https://upload.wikimedia.org/wikipedia/commons/1/17/Simple_arms_of_Manitoba.svg -->
	</section>

		
	<a href="newPost.php" id="postAd">Post an Ad</a>
	<section id="content">
		<section id="searchNav">
			<form id="search" method="POST" action="search.php">
				
				<input id="search" name="search" type="text" placeholder="Search" autofocus="autofocus" />
				<input id="search" type="submit" name="command" value="Search Ads"/>
			</form>
			
		</section>
		<fieldset>
			
		</fieldset>

			<footer>
			<div id="footerContainer">
				<div id="navBar2">
					<ul>
						<li><a href="index.php?sort">Home</a></li>
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