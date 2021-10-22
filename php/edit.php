<?php

include("db.php");

if (isset($_POST['id'])) {

	$book_id	= $_POST['id'];
	$query		= "SELECT * FROM book WHERE id = '".$book_id."'";
	$run		= mysqli_query($con,$query);
	$row		= mysqli_fetch_array($run, MYSQLI_ASSOC);

	echo json_encode($row);
}

 ?>