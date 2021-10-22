 
<?php

session_start();
include('db.php'); 

$ErrMsg = '';
$successMsg ='';

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']))
{


 	$name = mysqli_real_escape_string($con, $_POST["name"]); 

 	if (!$name) 
    {
        $ErrMsg  .= "name is required !";
    }
    else {
        $name   = trim($name);
    }


    $email = mysqli_real_escape_string($con, $_POST["email"]);  

    if (!preg_match ("/^[_a-zA-Z0-9]+(\.[_a-zA-Z0-9]+)*@[a-z0-9-]+(\.[a-z0-9]+)*(\.[a-z]{2,})/", $email)) 
    {  
        $ErrMsg     .= "Email is invalid";  
    } 
    else {  
        $email   = trim($email); 
    }


    $user_password = mysqli_real_escape_string($con, $_POST["password"]);  

     if(!empty($user_password))
		 {

		 	 $user_password = trim($user_password);
			
			
			$hash_password = password_hash($user_password,PASSWORD_DEFAULT);
		 }
   
    

	if (!$ErrMsg) 
    {

    $query = "INSERT INTO login(u_name, u_email, u_pass)  
     VALUES('$name', '$email', '$hash_password')";


    if(mysqli_query($con, $query))
     {
        $successMsg       = 'Data inserted';
        $b_id             =  mysqli_insert_id($con);
        $_SESSION["u_id"] = $b_id;
     }
 	}
 	else{
        $ErrMsg;
    }
        
     
}


$output = array(  
	'ErrMsg'   	 =>  $ErrMsg,  
    'successMsg' => $successMsg
);  

echo json_encode($output);

   
?>
