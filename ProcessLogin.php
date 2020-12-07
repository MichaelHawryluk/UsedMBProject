<?php

//Connects to database
require ('connect.php');

	
	$errorMessage = false;

  	if($_POST && (!empty($_POST['username'])) 
  			&& (!empty($_POST['password'])) 
  			&& (!empty($_POST['confirmPassword'])
  			&& $_POST['command'] === "Sign in")
	{
  		//Sets and sanitizes the Id
   		$username = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_NUMBER_INT);
   		$password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	 	//Creates a select statement to show the specific record based on the ID
	    $userSelect = "SELECT * from users WHERE username = :username";
	    $statement = $db->prepare($userSelect);
	    $statement->bindValue(':username', $username, PDO::PARAM_INT);
	    $statement->execute();
	    $show = $statement->fetch();

	    if($show > 0 && $password == ':password')
	    {

	    }

	}