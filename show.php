<?php
  //Requires connection to the database
   require 'connect.php';


  //Sets and sanitizes the Id
   $postId = filter_input(INPUT_GET, 'postId', FILTER_SANITIZE_NUMBER_INT);

  //Creates a select statement to show the specific record based on the ID
   $titleSelect = "SELECT * from posts WHERE postId = :postId";
   $statement = $db->prepare($titleSelect);
   $statement->bindValue(':postId', $postId, PDO::PARAM_INT);
   $statement->execute();
   $show = $statement->fetch();
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
          <li><a href="#Posts">Recent Posts</a></li>
          <li><a href="ProjectContactForm.php">Contact Us</a></li>
          <li><a href="ProjectTerms.html">Terms</a></li>
          <?php if(!isset($_SESSION['username'])): ?>
            <li><a href="login.php">Log in</a></li>
            <li><a href="signUp.php">Sign up</a></li> </ul>          
          <?php else: ?>
            <?= print_r($_SESSION['username'], true) ?>
            <form method="POST" action="logout.php">
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

  
   <form id="inventory" method="POST" action="updateDelete.php">
         <fieldset>
            <div class="title"><p><?= $show['title'] ?></p></div>

                  <?= $show['description'] ?><br>
                  <?php if($show['picturePath'] != null): ?>
                      <div class="picture">
                        <img src="uploads/<?=$show['picturePath']?>" alt="image">
                      </div>
                    <?php endif; ?>
                  <a href="edit.php?postId=<?= $postId ?>">edit</a><br>         
                  <!-- Edit link for the record -->        
                  <small>
                  <!-- Format for the date from the database timestamp-->
                  <br><?=date("F j, Y, h:i A",strtotime(($show['date']))) ?>
               </small>

            <div id="blog_content">
               
            </div>            
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