<?php
  require('connect.php');
  // Query all the categories from the database.
  $query = "SELECT * FROM users";
  $statement = $db->prepare($query);
  $statement->execute();

  // Fetch the returned provinces as an array of hashes.
  $user = $statement->fetchAll();

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
		<form id="signUp" method="POST" action="processSignIn.php">
				<table id="signupTable">
					<tr>
						<td>
							<label>Full Name</label>
							<input id="fullName" type="text" name="fullName"><br>
						</td>
					</tr>
					<tr>
						<td>	
							<input type="hidden" name="userId">
							<input type="hidden" name="date">
							<label>Username</label>
							<input name="userName" id="userName" type="text"><br>
							<label>Email</label>
							<input id="email" type="email" name="email"><br>
						</td>
					</tr>
					<tr>
						<td>
							<label>Address</label>
							<input id="address" type="text" name="address"><br>

							<label>City</label>
							<input id="city" type="text" name="city"><br>
						</td>
					</tr>
					<tr>
						<td>
							<label>Province</label>
							<input id="province" type="text" name="province"><br>

							<label>Postal Code</label>
							<input id="postalCode" type="text" name="postalCode"><br>
						</td>
					</tr>
					<tr>
						<td>
							<label>Password</label>
							<input id="password" type="password" name="password"><br>

							<label>Confirm Password</label>
							<input id="confirmPassword" type="password" name="confirmPassword"><br>
						</td>
					</tr>
					<tr>
						<td>
							<input id="createBtn" type="submit" name="createBtn" value="Create Profile" />
						</td>
					</tr>
			</table>
<br>
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
	</section>
</body>
</html>
