<?php
// Include config file
require_once "../../config.php";

//STUDENTS
//define empty variables
 $rfid= $studno = $fname = $gender = $organization = $yrlvl = $course = $section = "";
 $rfid_err = $fname_err = $section_err = $studno_err ="";
if(isset($_POST['addstud']))
{
    // Validate  RFID
    $input_rfid = trim($_POST["id"]);
    if(empty($input_rfid)){
        $rfid_err = "Please tap ID on the scanner.";     
    } else{
        // Prepare a select statement
        $sql = "SELECT stud_id FROM students WHERE rfid_no = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_rfid);
            
            // Set parameters
            $param_rfid = $input_rfid;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $rfid_err = "RFID number already used.";
                      
                   
                } else{
                    $rfid = $input_rfid;
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
//Validate Student Number
$input_student = trim($_POST["stud"]);
 if(empty($input_student)){
        $studno_err = "Please enter student Number.";
 }
 else{
        $studno = $input_student;
    }

//Validate name
      $input_name = trim($_POST["fname"]);
    if(empty($input_name)){
        $fname_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $fname_err = "Please enter a valid name.";
    } else{
        $fname = $input_name;
    }

    $gender = $_POST['gender'];
    $organization = $_POST['organization'];
    $yrlvl =  $_POST['yrlevel'];
    $course = $_POST['course'];
       // Validate  SECTION
    $input_section = trim($_POST["section"]);
    if(empty($input_section)){
        $section_err = "Please enter your id.";     
    } else{
          $section =  $input_section ;
    }
   
    if(empty($rfid_err) && empty($fname_err) && empty($section_err)){
      $query = "INSERT INTO students (`rfid_no`,`student_no`,`name`,`gender`,`course`,`organization`,`yrLevel`,`section`) VALUES ('$rfid',' $studno','$fname','$gender','$course','$organization','$yrlvl','$section')";
    $query_run = mysqli_query($mysqli, $query);

    if($query_run)
    {
      header("Location:../Students.php");
    }
    else
    {
        echo '<script> alert("Data Not Saved ahahaha"); </script>';
    }
    }
   else{
       header('Location: ../Error.php');
   }
    
}
////////////////////////////////////////////////////////////////////////////////////
//Add Events PHP
//define empty variables
 $ename = $organizers = $date = "";
 $ename_err = $organizers_err = $date_err = "";
if(isset($_POST['addevent']))
{
   

//Validate event title
      $input_ename = trim($_POST["ename"]);
    if(empty($input_ename)){
        $ename_err = "Please enter a Event Title.";
    } else{
           // Prepare a select statement
        $sql = "SELECT event_id FROM events WHERE event_title = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_ename);
            
            // Set parameters
            $param_ename = $input_ename;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                     $ename_err = "Event Title number already used.";
                      
                   
                } else{
                    $ename = $input_ename;
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    //Validate event Organizers
      $input_organizers = trim($_POST["organizers"]);
    if(empty($input_organizers)){
        $organizers_err = "Please enter organizers.";
    } else{
        $organizers = $input_organizers;
    }

     //Validate event date
      $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "Please enter organizers.";
    } else{
        $date = $input_date;
    }
      
   
    if(empty($ename_err) && empty($organizers_err) && empty($date_err)){

         $tbname = $ename;
         $newtbname =  preg_replace("/\s+/", "_", $tbname);
         $newEvent = "CREATE TABLE ".$newtbname."
        ( `attendance_no` int(10) NOT NULL AUTO_INCREMENT,
          `rfid_no` varchar(50) NOT NULL,
          `student_no` varchar(10) NOT NULL,
          `name` varchar(100) NOT NULL,
          `organization` varchar(100) NOT NULL,
          `course` varchar(100) NOT NULL,
         `time_in` varchar(10) NOT NULL,
         `time_out` varchar(10) NOT NULL, 
          PRIMARY KEY (attendance_no))";

          $query_runs = mysqli_query($mysqli, $newEvent);
     

    if($query_runs)
    {
             
      $query = "INSERT INTO events (`event_title`, `organizers`,`date`) VALUES ('$ename','$organizers','$date')";
    $query_run = mysqli_query($mysqli, $query);

        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../Events.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }
    }
   else{
       header('Location: ../Error.php');
   }
    
}

?>