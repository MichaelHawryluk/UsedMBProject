<?php

require 'connect.php';


	if($_POST['command'] === "Add Category")
	{
		$category = filter_input(INPUT_POST, 'newCategory', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$updateQuery = "INSERT INTO categories (categoryType) VALUES (:category)";
		$updateStatement = $db->prepare($updateQuery);
		$updateStatement->bindValue(':category', $category);
		$updateStatement->execute();
		$updateStatement->fetch();

		print_r($updateStatement);
		print_r($category);
		print_r($_POST);
		//print_r($updateStatement->error_info());
		header("Location: newCategory.php");
		exit;
	}

?>
