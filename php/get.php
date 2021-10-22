<?php

    include("db.php");

    session_start();
    if(!$_SESSION['u_id'])
    {
        return false;
    }

	$output    = array();

    if (isset($_POST['user_id'])) {

        $user_id = $_POST['user_id'];

        $query     = "SELECT * FROM book WHERE u_id = '$user_id'";

        $run       = mysqli_query($con,$query);

        if (mysqli_num_rows($run) > 0) {
            while ($row = mysqli_fetch_array($run)) {
                $b_id        = $row['id'];
                $b_name      = $row['b_name'];
                $b_auth_name = $row['b_auth_name'];
                $b_type      = $row['type'];

                $output[]    = array(
                    'b_id'          =>  $b_id,
                    'b_name'        =>  $b_name,
                    'b_auth_name'   =>  $b_auth_name,
                    'b_type'        =>  $b_type
                );
            }
        }
    }


	

    echo json_encode($output);


?>