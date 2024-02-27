<?php
// Include config file
require_once "../../config.php";

//DELETE ADMIN

if(isset($_POST['deleteadmin']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM admins WHERE id='$id'";
    $query_run = mysqli_query($mysqli, $query);

    if($query_run)
    {
                 
        echo '<script> alert("Data Deleted"); </script>';
        header("Location:../Admins.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}

//DELETE ADMIN END 
// DELETE CATEGORIES 
if(isset($_POST['deletecat']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM categories WHERE category_id='$id'";
    $query_run = mysqli_query($mysqli, $query);

    if($query_run)
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("Location:../Categories.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}
//DELET CATEGPRIES END

//DELETE Student

if(isset($_POST['deletestud']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM students WHERE stud_id='$id'";
    $query_run = mysqli_query($mysqli, $query);

    if($query_run)
    {
      header("Location:../Students.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}

//DELETE Student END 

//DELETE Event

if(isset($_POST['delEvent']))
{
    $id = $_POST['delete_id'];

      $deleventname = "SELECT event_title FROM events WHERE event_id='$id' ";
         $query_run1 = mysqli_query($mysqli, $deleventname);

        if (mysqli_num_rows($query_run1) > 0) { 
	while($rowData = mysqli_fetch_array($query_run1)){
  	    $delete = $rowData["event_title"];
          $newdelete = preg_replace("/\s+/", "_", $delete);

          $deleteEvent = "DROP TABLE ".$newdelete."";
          $query_run = mysqli_query($mysqli, $deleteEvent);
      
	}
        }

    if($query_run)
    {   
  
       $query = "DELETE FROM events WHERE event_id='$id'";
    $query_run = mysqli_query($mysqli, $query);  
      echo '<script> alert("Data Deleted"); </script>';
        header("Location:../Events.php");
        
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
        header("Location:../error.php");
    }
}

//DELETE Student END 

// DELETE Profile
if(isset($_POST['deleteme']))
{
    $id = $_POST['delme'];

    $query = "DELETE FROM admins WHERE id='$id'";
    $query_run = mysqli_query($mysqli, $query);

    if($query_run)
    {
        echo '<script> alert("Data Deleted"); </script>';
          // Initialize the session
            session_start();
 
            // Unset all of the session variables
            $_SESSION = array();
 
            // Destroy the session.
           session_destroy();
 
           // Redirect to login page
           header("location: ../login.php");
            exit;
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
        header("Location:../error.php");
    }
}
//DELET Profile END
?>