<?php 

include("db.php");


$ErrMsg = '';
$successMsg ='';


if (isset($_POST["hiddenId"]) && isset($_POST["edit_book_name"]) 
    && isset($_POST["edit_auth_name"]) && $_POST["edit_book_type"]) 
{
   
    $b_id       = mysqli_real_escape_string($con, $_POST["hiddenId"]);
    $b_name     = mysqli_real_escape_string($con, $_POST["edit_book_name"]);  

    if (!$b_name) 
    {
        $ErrMsg  .= "Book name is required !";
    }
    else {
        $b_name   = trim($b_name);
    }


    $auth_name   = mysqli_real_escape_string($con, $_POST["edit_auth_name"]);

    if (!preg_match ("/^[a-zA-Z\s]+$/", $auth_name) ) 
    {  
        $ErrMsg   .= "Only Alphabets are allowed author name.";  
    } 
    else{  
        $auth_name = trim($auth_name); 
    }


    $b_type       = mysqli_real_escape_string($con, $_POST["edit_book_type"]);
    

    if (!$ErrMsg) {
   
        $query="UPDATE book SET 
                b_name      = '$b_name',
                b_auth_name = '$auth_name',
                type        = '$b_type' 
                WHERE id    = '$b_id'" ;

        if (mysqli_query($con, $query)) 
        {
            $successMsg .= 'Data Inserted';
        }

    }
    else{
        $ErrMsg;
    } 

}



$output = array(  
	'ErrMsg'   	=>  $ErrMsg,  
	'successMsg'	=>  $successMsg
);  

echo json_encode($output);


 ?>