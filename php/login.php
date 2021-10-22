<?php

session_start();

include('db.php');

$ErrMsg = '';
$successMsg ='';


if (isset($_POST['email']) && isset($_POST['password'])  && isset($_POST['remember_me'])) {

  $email       =  mysqli_real_escape_string($con,$_POST['email']);
  $password    =  mysqli_real_escape_string($con,$_POST['password']);
  $remember_me =  $_POST['remember_me'];


  $check_email_query  = "SELECT u_id, u_pass FROM login WHERE u_email = '$email'";
  $check_email_run    = mysqli_query($con,$check_email_query);

    if (mysqli_num_rows($check_email_run) > 0)
       {
          while ($row = mysqli_fetch_array($check_email_run))
           {
             
              if (password_verify($password , $row['u_pass']))
              {        

                  if ($remember_me == 'true') 
                  {
                   
                      setcookie ("user_email",$_POST["email"], time() + (86400 * 30), "/");
                      setcookie ("user_password",$_POST["password"], time() + (86400 * 30), "/");
                      
                   
                  }
                  
                  if ($remember_me == 'false') {
        
                      if(isset($_COOKIE["user_email"])) {
                        setcookie ("user_email","", time() - (86400), "/");
                      }
                      if(isset($_COOKIE["user_password"])) {
                         setcookie ("user_password","", time() - (86400), "/");
                      }
                      
                  }
                  $_SESSION["u_id"] = $row['u_id'];
                      $successMsg      .= 1; 
                  
                 
              }

              else
              {
               $ErrMsg .= 'Some of your Info is not corrent ! Please try again';
              }
          }
      }
      else{
        $ErrMsg .= 'Email unvalid';
      }



    }


$output = array(  
  'ErrMsg'     =>  $ErrMsg,  
  'successMsg' => $successMsg
);  

echo json_encode($output);


 ?>