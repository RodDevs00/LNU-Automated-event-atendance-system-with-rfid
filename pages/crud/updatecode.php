<?php
// Include config file
require_once "../../config.php";

//Update Category
    if(isset($_POST['updatecat']))
    {   
        $id = $_POST['edit_id'];
        
        $course = $_POST['course'];
         $organization = $_POST['organization'];
        $college = $_POST['college'];
       
        $query = "UPDATE categories SET course='$course', organization='$organization', College='$college' WHERE category_Id='$id'";
        $query_run = mysqli_query($mysqli, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:../Categories.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }

    //define empty variables
 $rfid = $fname = $gender = $organization = $yrlvl = $course = $section = "";
 $rfid_err = $fname_err = $section_err = "";

   //////////Update Student
    if(isset($_POST['updatestud']))
    {   
       
         $id = $_POST['update_id'];
          $sid = $_POST['upstud'];
         $gender = $_POST['gender'];
         $organization = $_POST['organization'];
         $yrlvl =  $_POST['yrlevel'];
         $course = $_POST['course'];

     
               

        //Validate name
      $input_name = trim($_POST["studname"]);
    if(empty($input_name)){
        $fname_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $fname_err = "Please enter a valid name.";
    } else{
        $fname = $input_name;
    }
         
         
         // Validate  SECTION
    $input_section = trim($_POST["section"]);
    if(empty($input_section)){
        $section_err = "Please enter your id.";     
    } else{
          $section =  $input_section ;
    }
        
       if(empty($fname_err) && empty($section_err)){
        $query = "UPDATE students SET student_no='$sid',name='$fname',gender='$gender', section='$section', organization='$organization', yrLevel='$yrlvl', course='$course' WHERE stud_id='$id'";
        $query_run = mysqli_query($mysqli, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:../Students.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
           }
   else{
       header('Location: ../Admins.php');
   }
    }
//////////////////////////////////////////////////////////////////////////////////////////////
    //Update EVENTS
    if(isset($_POST['editevent']))
    {   

        //define empty variables
 $ename = $organizers = $date = "";
 $ename_err = $organizers_err = $date_err = "";

        $id = $_POST['edit_id'];

          // Validate  Event Title
    $input_ename = trim($_POST["ename"]);
    if(empty($input_ename)){
        $ename_err = "Please enter event name.";     
    } else{
          $ename =  $input_ename ;
    }
     // Validate  Organizers
    $input_org = trim($_POST["organizers"]);
    if(empty($input_org)){
        $organizers_err = "Please choose organizers.";     
    } else{
          $organizers =  $input_org ;
    }
     
         // Validate  Date
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "Please select date.";     
    } else{
          $date =  $input_date ;
    }

        if(empty($ename_err) && empty($organizers_err) && empty($date_err)){
        //get Event Title
            $selectname = "SELECT event_title FROM events WHERE event_id='$id' ";
         $altertable = mysqli_query($mysqli, $selectname);
         
        $result = mysqli_fetch_assoc($altertable);
        $alter = $result['event_title'];
        $alternws = preg_replace("/\s+/", "_", $alter); 
          
          //Variables for alter table
        $newtitle = $ename;
        $newtitlenws = preg_replace("/\s+/", "_", $newtitle);

        //Alter Table
         $altertablename = "ALTER TABLE $alternws RENAME TO $newtitlenws";
         $alter_runs = mysqli_query($mysqli, $altertablename);
     

         
        if($alter_runs)
        {
        $query = "UPDATE events SET event_title='$ename', organizers='$organizers', date='$date' WHERE event_id='$id'";
        $query_run = mysqli_query($mysqli, $query);

            echo '<script> alert("Data Updated"); </script>';
            header("Location:../Events.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
       
     } else{
       header('Location: ../Error.php');
   }
    
}
?>