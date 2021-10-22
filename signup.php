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
            <h4>Sign Up</h4>
          </div>
        </div>
      </div>
    </div>


      <div class="container-fluid" style="margin-top: 80px;">
        <div class="row">     
          <div class="col mx-5" >
            <div class="bg-white shadow p-4 rounded">
              <form id="signup_form">
                <div class="mb-3">
                  <label for="name" class="form-label">Name : </label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter your Name">
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email : </label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                  <p id="email-availability"></p>
                  <p id="email-check"></p>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password : </label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="********">
                </div>
                <button type="submit" id="submit" class="btn btn-primary mb-3 submit" >Sign Up</button>

                <p id="errormsg"></p>  
              </form>
            </div>
          </div>

          <div  class="col mx-5 d-none d-lg-block">
            <h3>Note:</h3>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
          </div>
        </div>
      </div>
      
   
    <script src="js/bootstrap.bundle.min.js" ></script>
  </body>
</html>


<script type="text/javascript">
  $(document).ready(function(){


  	
  	function emailCheck()
		{
		  $('#email').on('blur',function(){

		     var email = $(this).val();
         var reg = /^[_a-zA-Z0-9]+(\.[_a-zA-Z0-9]+)*@[a-z0-9-]+(\.[a-z0-9]+)*(\.[a-z]{2,})/;
         var ok = reg.exec(email);
         if (!ok) 
          {
            $('#email-availability').html('<span class="text-danger">Invalid Email !</span>');
            $('#submit').attr("disabled", true);
          } 
          else{
            $.ajax({
            url:'php/email_check.php',
            method:"POST",
            data:{email:email},
            success:function(data)
            {
             if(data != 0)
             {
              $('#email-availability').html('<span class="text-danger">Email Already Exist ...!</span>');
              $('#submit').attr("disabled", true);
             }
             else
             {
                if (email == '') 
                {
                  $('#email-availability').html('');    
                }
                else
                {
                  $('#email-availability').html('<span class="text-success">Email Good</span>');
                  $('#submit').attr("disabled", false);    
                }

              
             }
            }
           })
          }

		     

		  });

		}
    emailCheck();


    

    $('#signup_form').on('submit', function(e){
      e.preventDefault();

      var name 		= $('#name').val();
      var email 	= $('#email').val();
      var password  = $('#password').val();

      if( name == '')  
      {  
       alert("Name is required");  
      }  
      else if( email == '')  
      {  
        alert("email is required"); 
      }  
      else if( password == '')
      {  
       alert("password is required");  
      }
      else  
      { 
        $.ajax({  
          url       : "php/signup.php",  
          method    : "POST",  
          data      : $('#signup_form').serialize(),  
          beforeSend: function(){  
           $('#submit').val("Submiting");  
          },  
          success   : function(data){
			     data= JSON.parse(data);

            if (data.ErrMsg) {
              $('#errormsg').html('<span class="text-danger">'+data.ErrMsg+'</span>');
            }
            else{
              $('#errormsg').html('<span class="text-success">'+data.successMsg+'</span>');
              $('#signup_form')[0].reset();
              setTimeout(function(){  
                $(window.location = "index.php").fadeOut("slow");  
              }, 1000);
            }

          }  
         }); 
      }

    });

    


  });
</script>


