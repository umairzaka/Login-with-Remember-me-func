<?php 

include("db.php");

if (isset($_POST['d_id'])) 
{

	$book_id	=  mysqli_real_escape_string($con, $_POST['d_id']);
	$query 	 	=  "DELETE FROM book WHERE id = '".$book_id."'";

	if (mysqli_query($con, $query)) 
	{
	 	echo $msg = 'deleted';
	}
}



 ?>