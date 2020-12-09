<?php

//Connects to database
require ('connect.php');

	
  	if(!empty($_POST['username'])
  		&& (!empty($_POST['password']))
  		&& (!empty($_POST['confirmPassword']))
  		&& $_POST['command'] === "Sign in"
  		&& $_POST['password'] === $_POST['confirmPassword'])
	{

		 
  		//Sets and sanitizes the Id
   		$username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   		$password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
   		$find = $_POST['username'];
        $find = preg_replace("#[^0-9a-z]#i", "", $find);
           

	 	//Creates a select statement to show the specific record based on the ID
	    $userSelect = "SELECT * FROM users WHERE userName LIKE '%$find%'";
	    $statement = $db->prepare($userSelect);
	    $statement->bindValue(':username', $username, PDO::PARAM_INT);
	    $statement->execute();
	    $show = $statement->fetch();
	    

	    if(count($show) >= 1)
	    {
	    	//print_r($show);
	    	$_SESSION["username"] = $show['userName'];
	    	header("Location: index.php");
	    	print_r($_SESSION["username"]);
	    }
	 	
	 	else
	 	{
	 		$errorMessage = "You must create a profile";
	 	}

	} else {
		$errorMessage = "Username and password not valid!";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<?= print_r($errorMessage); ?>
</body>
</html>