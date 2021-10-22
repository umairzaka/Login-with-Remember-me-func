<?php 

session_start();

	if (!isset($_SESSION["u_id"]))
	{
		header("location:login.php");
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
          	<a href="php/logout.php" class="btn btn-danger rounded-pill">logout</a>
        
          </div>
        </div>
      </div>
    </div>

    <div class="container" style="margin-top: 70px;">
      
      
      <div class="d-flex justify-content-around my-4">
        <h4>Task => Crud Operation</h4>
        <div >
          <button type="button" name="add" id="add" class="btn btn-success">Add</button>
        </div>
      </div>

      <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add book</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="insert_form">
                <div class="mb-3">
                  <label for="book_name" class="form-label">Book Name</label>
                  <input type="text" class="form-control" id="book_name" name="book_name">
                </div>
                <div class="mb-3">
                  <label for="auth_name" class="form-label">Author Name</label>
                  <input type="text" class="form-control auth_name" id="auth_name" name="auth_name">
                </div>
                <div class="mb-3">
                  <label class="mb-3">Book Type</label>
                  <select class="form-select" id="book_type" name="book_type">
                    <option value="IT">IT</option>
                    <option value="Science">Science</option>
                    <option value="Biology">Biology</option>
                    <option value="Math">Math</option>
                  </select>
                </div>
                <input type="hidden" name="add_u_id" id="add_u_id" value="<?php echo $_SESSION['u_id']; ?>">
                <p class="errMsg"></p>
                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
           
          </div>
        </div>
      </div>

      <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Book Data</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="insert_edit_form">
                <div class="mb-3">
                  <label for="book_name" class="form-label">Book Name</label>
                  <input type="text" class="form-control" id="edit_book_name" name="edit_book_name">
                </div>
                <div class="mb-3">
                  <label for="auth_name" class="form-label">Author Name</label>
                  <input type="text" class="form-control edit_auth_name" id="edit_auth_name" name="edit_auth_name">
                </div>
                <div class="mb-3">
                  <label class="mb-3">Book Type</label>
                  <select class="form-select" id="edit_book_type" name="edit_book_type">
                    <option value="IT">IT</option>
                    <option value="Science">Science</option>
                    <option value="Biology">Biology</option>
                    <option value="Math">Math</option>
                  </select>
                </div>
                <p class="errMsg_edit"></p>
                <input type="hidden" name="hiddenId" id="hiddenId">
                <button type="submit" id="editsubmit" class="btn btn-primary">Submit</button>
              </form>
            </div>
           
          </div>
        </div>
      </div>


      <div class="table-responsive">
      	<input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['u_id']; ?>">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th>Sr. #</th>
              <th>Book Name</th>
              <th>Auth Name</th>
              <th>Type</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tbody class="book_data" id="book_data">
            
          </tbody>
          
            
          

        </table>
      </div>
      <br />
    </div>
    
  

   
    <script src="js/bootstrap.bundle.min.js" ></script>
  </body>
</html>


<script type="text/javascript">
 
 $(document).ready(function(){





  get_data();
    
  function get_data()
  {

  	var user_id = $('#user_id').val();

    $.ajax({
      url:"php/get.php",
      method:"POST",
      data: {user_id:user_id},
      dataType : 'JSON',
      success:function(data)
      {


        var html = '';
        var count ='';

        data.forEach(function(o){
          count++;
          html += `<tr>
                  <td>${count}</td>
                  <td>${o.b_name}</td>
                  <td>${o.b_auth_name}</td>
                  <td>${o.b_type}</td>
                  <td><button class="btn btn-primary btn-sm btnEdit" data-id="${o.b_id}" >Edit</button></td>
                  <td><button class="btn btn-danger btn-sm btnDel" id="${o.b_id}" >Del</button>
                  
                  </td>

                </tr>`

        });

  
        $(".book_data").html(html);


      }
    });
  }


  $('#add').click(function(){
    $('#addModal').modal('show');
  });

 $('#insert_form').on("submit", function(event){  
  event.preventDefault(); 

  var book_name = $('#book_name').val();
  var auth_name = $('#auth_name').val();
  var book_type = $('#book_type').val();
  var length = $('.book_data').children().length;
  

  if(book_name == '')  
  {  
   alert("Book Name is required");  
  }  
  else if(auth_name == '')  
  {  
   alert("Author is required");  
  }  
  else if(book_type == '')
  {  
   alert("Book type is not define");  
  } 
  else  
  {  
   $.ajax({  
    url:"php/insertion.php",  
    method:"POST",  
    data:$('#insert_form').serialize(),  
    beforeSend:function(){  
     $('#submit').val("Submiting");  
    },  
    success:function(data){

     data= JSON.parse(data);

      if (data.ErrMsg){
        $('.errMsg').html('<label class="text-danger">'+data.ErrMsg+'</label>');
      }
      else{
        // console.log(data.b_id);
        var html = '';
        var count = length;
        
          count ++;
          html += `<tr>
                    <td>`+count+`</td>
                    <td>`+book_name+`</td>
                    <td>`+auth_name+`</td>
                    <td>`+book_type+`</td>
                    <td><button class="btn btn-primary btn-sm btnEdit" data-id=`+data.b_id+`>Edit</button></td>
                    <td><button class="btn btn-danger btn-sm btnDel" id = `+data.b_id+`>Del</button></td>
                  </tr>`;

        $('#book_data').append(html);

        $('#insert_form')[0].reset();  
        $('#addModal').modal('hide');  
        
      }  
    }  
   });  
  }  
 });


 $(document).on('click', '.btnEdit', function(){
   var id = $(this).data('id');

   if (id != '') {
       $.ajax({ 
          url:"php/edit.php",
          method:"POST",
          data:{id:id},
          success : function(data){
            // console.log(data);
            data= JSON.parse(data);
            $('#edit_book_name').val(data.b_name);
            $('#edit_auth_name').val(data.b_auth_name);
            $('#edit_book_type').val(data.type);
            $('#hiddenId').val(data.id);
            $('#EditModal').modal('show');
          }
      });
   }
   else{
     console.log('system Error');
   }


   
 });


  $('#insert_edit_form').on("submit", function(event){  
  event.preventDefault();  

  var edit_book_name = $('#edit_book_name').val();
  var edit_auth_name = $('#edit_auth_name').val();
  var edit_book_type = $('#edit_book_type').val();

  if( edit_book_name == '')  
  {  
   alert("Book Name is required");  
  }  
  else if( edit_auth_name == '')  
  {  
   alert("Author is required");  
  }  
  else if( edit_book_type == '')
  {  
   alert("Book type is not define");  
  }
   
  else  
  {  
   $.ajax({  
    url:"php/edit_insert.php",  
    method:"POST",  
    data:$('#insert_edit_form').serialize(),  
    success:function(data){  
     data= JSON.parse(data);

      if (data.ErrMsg){
        $('.errMsg_edit').html('<label class="text-danger">'+data.ErrMsg+'</label>');
      }
      else{
        $('#insert_edit_form')[0].reset();  
        $('#EditModal').modal('hide');  
        get_data(); 
      }
    }  
   });  
  }  
 });


  $(document).on('click', '.btnDel', function(){
   
    var d_id = $(this).attr("id");
    var element = $(this);

    if (d_id != '') {
      $.ajax({ 
          url:"php/delete.php",
          method:"POST",
          data:{d_id:d_id},
          success : function(data){
            alert(data);
            element.parents("tr").remove();
                        // element.parent().remove();

          }
      });
    }
    else{
      console.log('Error');
    }
    
  });





 });


</script>


