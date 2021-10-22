<?php  

include('db.php');  

if(isset($_POST["email"]))
{
 $email 	= mysqli_real_escape_string($con, $_POST["email"]);
 $query 	= "SELECT * FROM login WHERE u_email = '".$email."'";
 $run 	= mysqli_query($con, $query);
 echo mysqli_num_rows($run);
}
?>