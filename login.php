
<?php 

session_start();
if (isset($_SESSION["u_id"]))
	{
		header("location:index.php");
	}

 ?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <link rel="stylesheet" href="index.css" />
    <title>Crud operations</title>
  </head>
  <body>


    <div class="bg-white d-flex align-items-center fixed-top shadow" style="min-height: 56px; z-index: 5">
      <div class="container-fluid">
        <div class="row align-items-center">
         
          <div class="col">
            <h3><strong class="text-danger">TASK</strong> Project</h3> 
          </div>

          <div  class="col d-flex justify-content-end ">
            <h4>Login</h4>
          </div>
        </div>
      </div>
    </div>


      <div class="container-fluid" style="margin-top: 80px;">
        <div class="row">     
          <div class="col mx-5" >
            <div class="bg-white shadow p-4 rounded">
              <form id="login_form">
                <div class="mb-3">
                  <label for="email" class="form-label">Email : </label>
                  <input type="email" class="form-control" value="<?php if(isset($_COOKIE["user_email"])) { echo $_COOKIE["user_email"]; } ?>" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password : </label>
                  <input type="password" class="form-control"  value="<?php if(isset($_COOKIE["user_password"])) { echo $_COOKIE["user_password"]; } ?>" id="password" name="password" placeholder="********" required>
                </div>
                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" <?php if(isset($_COOKIE["user_email"])) { ?> checked <?php } ?>    value="" id="remember_me" >
                  <label class="form-check-label" for="remember_me">Remember me ! </label>
                </div>
               	<input type="submit" value="Sign In" name="login" id="login" class="btn btn-primary rounded"> 
                <div class="mb-3">
                  Have no account ? <a href="signup.php" class="btn btn-light">Sign Up</a>
                </div>

       

                
              </form>
            </div>
          </div>

          <div  class="col mx-5 d-none d-lg-block">
            <h3>Note:</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
          </div>
        </div>
      </div
    
  

   
    <script src="js/bootstrap.bundle.min.js" ></script>
  </body>
</html>


<script type="text/javascript">

    $(document).ready(function(){

      $('#login').click(function(e){
      	e.preventDefault();

        var email 		= $('#email').val();
        var password 	= $('#password').val();
        var remember_me = $("#remember_me").is(':checked');


        if (email != '' && password != '') {

          $.ajax({
            url     : "php/login.php",
            method  : "POST",
            data    : {email:email , password:password, remember_me:remember_me},
            cache   : false,
            success : function(data)
            {                  
              data = JSON.parse(data);
              if (data.successMsg == 1) 
              {
                $('#login_form')[0].reset();
                $(window.location = "index.php").fadeOut("slow");               
              }
              else{
              	alert(data.ErrMsg);
              } 
            }
          });
        }else{
          alert('Both fields are required');
        }

      });



      

      

    });

  </script>



