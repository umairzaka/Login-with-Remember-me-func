 
<?php


include("db.php");


$ErrMsg = '';
$b_id = '';

if (isset($_POST["book_name"]) && isset($_POST["auth_name"]) 
    && isset($_POST['book_type']) && isset($_POST['add_u_id'])) {

    $user_id    = mysqli_real_escape_string($con, $_POST["add_u_id"]);
    $b_name     = mysqli_real_escape_string($con, $_POST["book_name"]);

    if (!$b_name) 
    {
        $ErrMsg  .= "Book name is required !";
    }
    else {
        $b_name   = trim($b_name);
    }



    $auth_name  = mysqli_real_escape_string($con, $_POST["auth_name"]); 

    if (!preg_match ("/^[a-zA-Z\s]+$/", $auth_name)) 
    {  
        $ErrMsg     .= "Only Alphabets are allowed author name.";  
    } 
    else {  
        $auth_name   = trim($auth_name); 
    }


    $b_type = mysqli_real_escape_string($con, $_POST["book_type"]);  
   

    if (!$ErrMsg) 
    {
        $query = "INSERT INTO book(u_id,b_name, b_auth_name, type)  
        VALUES('$user_id','$b_name', '$auth_name', '$b_type')";

        if (mysqli_query($con, $query)) 
        {
            
            $b_id   .=  mysqli_insert_id($con);
        }

    }
    else{
        $ErrMsg;
    }
        

}

   
 	

$output = array(  
	'ErrMsg'   	=>  $ErrMsg,  
    'b_id'          => $b_id
);  

echo json_encode($output);



?>
