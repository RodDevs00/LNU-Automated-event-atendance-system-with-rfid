<?php
// Include config file
require_once "../config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
$Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php',$Write);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css">
    <link rel="stylesheet" href="../assets/css/student.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <style></style>
    <title>Students</title>
</head>

<body id="body-pd">

   <!----NAV STARTS-->    
 <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class=""><div class="dropdown pmd-dropdown pmd-user-info mr-auto">
            <a href="javascript:void(0);" class="btn-user dropdown-toggle media align-items-center" data-toggle="dropdown"
                data-sidebar="true" aria-expanded="false">
                <i class="far fa-user-circle"></i>
                <i class="material-icons ">Profile</i>
            </a>
            <ul class="dropdown-menu dropdown-menu-left" role="menu">
                <a class="dropdown-item" href="Profile.php">Edit Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </ul>
        </div>
    </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div><img class="ml-4 " src="../assets/img/lnulogo.png" alt="Dashboard" style="width:25px;"> <span
                        class="nav_logo-name">LNU AEAS</span> </a>
      
                <div class="nav_list mt-5">
                     <a href="Dashboard.php" class="nav_link active" data-toggle="tooltip" data-placement="right" title="Dashboard"> <i><img class="" src="../assets/img/Dash.png" alt="Dashboard" style="width:20px;"></i><span class="nav_name">Dashboard</span> </a>
                    <a href="Events.php" class="nav_link active" data-toggle="tooltip" data-placement="right" title="Events"> <i><img class="" src="../assets/img/Events.png" alt="Events" style="width:20px;"></i><span class="nav_name">Events</span> </a>
                 <a href="Students.php" class="nav_link active" data-toggle="tooltip" data-placement="right" title="Students"> <i><img class="" src="../assets/img/Attendance.png" alt="Students" style="width:20px;"></i><span class="nav_name">Students</span> </a>
                
                 <?php if(ucwords($_SESSION['role']) =="Super Admin"){ ?>
                     <a href="Categories.php" class="nav_link active cathide" data-toggle="tooltip" data-placement="right" title="Categories"> <i><img class="" src="../assets/img/Department.png" alt="Categories" style="width:20px;"></i><span class="nav_name">Categories</span> </a>
                <a href="Admins.php" class="nav_link active adminhide" data-toggle="tooltip" data-placement="right" title="Admins"> <i><img class="" src="../assets/img/Profile.png" alt="Profile" style="width:20px;"></i><span class="nav_name">Profile</span> </a>              
                 <?php } ?>  
                 
                </div>
                </div>
                 <a href="logout.php" class="nav_link" data-toggle="tooltip" data-placement="right" title="Logout"> <i class='bx bx-log-out nav_icon'></i> <span
                    class="nav_name">SignOut</span> </a>
        </nav>
    </div>
  <!----NAV ENDS-->   
  

     <!---M O D A L S-->
    <!----Add student Modal Start-->
    <div class="modal fade" id="addstudentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                    <button type="button" class="close studclose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                       <form action="crud/create.php" method="POST">
                         <div class="form-group mx-5 mb-2">
                           <label for="fname" class="col-form-label ">  RFID NO::</label>
							<textarea  class="form-control" name="id" id="getUID" placeholder="Please Tag your Card / Key Chain to display ID" rows="1" cols="1"  required=""  readonly></textarea>					                      
                            
                        </div>
                         <div class="form-group mx-5">
                            <label for="studno" class="col-form-label ">Student Number:</label>
                            <input type="text" class="form-control" name="stud" id="stud" required="">
                        </div>
                        <div class="form-group mx-5">
                            <label for="fname" class="col-form-label ">Full Name:</label>
                            <input type="text" class="form-control" name="fname" id="fname" required="">
                        </div>
                        <div class="form-group mx-5">
                             <label for="gender" class="col-form-label mr-3">Gender:</label>
                           <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="gender" value="Male" required=""/>
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                          </div>

                          <div class="form-check form-check-inline">
                               <input class="form-check-input" type="radio" name="gender" id="gender" value="Female" required=""/>
                               <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                        </div>
                        <div class="form-group mx-5">
                            <?php
                                $sql="SELECT DISTINCT organization FROM categories ORDER BY organization ASC";
                                if($result = $mysqli->query($sql)){
                                echo  '<label for="floatingIn">Organization:</label>';
                               echo ' <select class="custom-select " name="organization" required ="">';
                               echo"<option selected></option>";
                               while ($row = $result->fetch_assoc()) {                                 
                               echo "<option value='$row[organization]'>$row[organization]</option>" ;
                                }
                               echo "</select>";
                                }
                                else{
                                    echo $mysqli -> error;
                                }
                                ?>
                        </div>
                             
                        <div class="form-group mx-5">
                                <label for="floatingPassword">Year Level</label>
                                <select class="custom-select" name="yrlevel" id="yrlevel"  required ="">
                                    <option selected></option>
                                    <option value="1st year">1st year</option>
                                    <option value="2nd year">2nd year</option>
                                    <option value="3rd year">3rd year</option>
                                    <option value="4th year">4th year</option>
                                </select>
                            </div>

                        <div class="form-group mx-5">
                             <?php
                                $sql="SELECT DISTINCT course FROM categories ORDER BY course ASC";
                                if($result = $mysqli->query($sql)){
                                echo  '<label for="floatingIn">Course:</label>';
                               echo ' <select class="custom-select " name="course" required ="">';
                               echo"<option selected></option>";
                               while ($row = $result->fetch_assoc()) {                                 
                               echo "<option value='$row[course]'>$row[course]</option>" ;
                                }
                               echo "</select>";
                                }
                                else{
                                    echo $mysqli -> error;
                                }
                                ?>
                        </div>
                        <div class="form-group mx-5">
                            <label for="sect" class="col-form-label">Section:</label>
                            <input type="text" class="form-control" name="section" id="sect" required="">
                        </div>
                         <div class="modal-footer">
                    <button type="button" class="btn btn-warning studclose" data-dismiss="modal">Close</button>
                    <button type="submit" name="addstud" class="btn btn-primary">Save</button>
                </div>

                    </form>
                </div>
               
            </div>
        </div>
    </div>

    <!----Add student Modal Ends-->
     <!----Edit student Modal Start-->
    <div class="modal fade" id="editstudentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Student</h5>
                    <button type="button" class="close studclose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                       <form action="crud/updatecode.php" method="POST">
                           <input type="hidden" name="update_id" id="update_id"> 
                         <div class="form-group mx-5">
                            <label for="upstud" class="col-form-label ">Student Number:</label>
                            <input type="text" class="form-control" name="upstud" id="upstud" required="">
                        </div>
                        <div class="form-group mx-5">
                            <label for="fname" class="col-form-label ">Full Name:</label>
                            <input type="text" class="form-control" name="studname" id="studname" required="">
                        </div>
                         <div class="form-group mx-5">
                             <label for="gender" class="col-form-label mr-3">Gender:</label>
                           <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" required=""/>
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                          </div>

                          <div class="form-check form-check-inline">
                               <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required=""/>
                               <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                        </div>
                        <div class="form-group mx-5">
                            <label for="dep" class="col-form-label">Organization:</label>
                            <select class="custom-select" name="organization" id="organization" required="">
                                 <?php
                                $sql="SELECT DISTINCT organization FROM categories ORDER BY organization ASC";
                                if($result = $mysqli->query($sql)){
                               echo"<option selected></option>";
                               while ($row = $result->fetch_assoc()) {                                 
                               echo "<option value='$row[organization]'>$row[organization]</option>" ;
                                }
                               echo "</select>";
                                }
                                else{
                                    echo $mysqli -> error;
                                }
                                ?>
                        </div>

                        <div class="form-group mx-5">
                                <label for="floatingPassword">Year Level</label>
                                <select class="custom-select"  name="yrlevel" id="yrlevel"  required ="">
                                    <option selected></option>
                                    <option value="1st year">1st year</option>
                                    <option value="2nd year">2nd year</option>
                                    <option value="3rd year">3rd year</option>
                                    <option value="4th year">4th year</option>
                                </select>
                            </div>

                        <div class="form-group mx-5">
                            <label for="dept" class="col-form-label">Course:</label>
                            <select class="custom-select" name="course" id="courses" required="">
                                <?php
                                $sql="SELECT DISTINCT course FROM categories ORDER BY course ASC";
                                if($result = $mysqli->query($sql)){
                               echo"<option selected></option>";
                               while ($row = $result->fetch_assoc()) {                                 
                               echo "<option value='$row[course]'>$row[course]</option>" ;
                                }
                               echo "</select>";
                                }
                                else{
                                    echo $mysqli -> error;
                                }
                                ?>
                        </div>
                        <div class="form-group mx-5">
                            <label for="sect" class="col-form-label">Section:</label>
                            <input type="text" class="form-control" name="section" id="section" required="">
                        </div>
                         <div class="modal-footer">
                    <button type="button" class="btn btn-warning studclose" >Close</button>
                    <button type="submit" name="updatestud" class="btn btn-primary">Save</button>
                </div>

                    </form>
                </div>
               
            </div>
        </div>
    </div>

    <!----Edit student Modal Ends-->

      <!---Delete student starts-->
    <div class="mt-5" id="delstud">
    
        <div class="modal fade" id="delstudmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <p class="modal-title " id="exampleModalLabel">Are you sure you want to delete this student?</p>
                       <button type="button" class="close delclose" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="crud/delete.php" method="POST">                   
                        <input type="hidden" name="delete_id" id="delete_id">
              
                    <div class="modal-footer">
                         <button type="button" class="btn btn-primary delclose" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="deletestud" class="btn btn-danger"> Confirm Delete </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!----Delete student Modal Ends-->
    <!---M O D A L S ENDS-->
    <!--Container Main start-->
    <div class="height-100 bg-light">
            <div>
                <h1 class="title ml-3 mt-5 mb-3">Students </h1>
            </div>
    <div class="card card-body">
         <div class="studentwrapper">
           <?php  if(ucwords($_SESSION['role']) =="Super Admin"){ ?>
            <button type="button" id="addbtn" class="btn btn-primary  mb-3 ml-5 px-5 addstudbtn">Add Student</button>
        <?php } ?>
              <!----user Table Start-->
            <div class="table-responsive">
                 <?php

                    // Attempt select query execution
                    $sql = "SELECT * FROM students";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                              echo '<script ></script>';
                           echo '<table id="studentTable" class="table table-sm table-hover">';
                              echo "<thead>";
                                    echo "<tr>";
                                         echo "<th>No.</th>";
                                         echo "<th>Student No</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Gender</th>";                                        
                                        echo "<th>Section</th>";
                                        echo "<th>Course</th>";
                                         echo "<th>Organization</th>";
                                         echo "<th>Year Level</th>";
                                         if(ucwords($_SESSION['role']) =="Super Admin"){ 
                                        echo "<th>Action</th>";
                                         }
                                    echo "</tr>";
                                echo "</thead>";
                                 echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                          echo "<td>" . $row['stud_id'] . "</td>";
                                        echo "<td>" . $row['student_no'] . "</td>"; 
                                        echo "<td>" . $row['name'] . "</td>";
                                         echo "<td>" . $row['gender'] . "</td>";
                                         echo "<td>" . $row['section'] . "</td>";
                                          echo "<td>" . $row['course'] . "</td>";
                                          echo "<td>" . $row['organization'] . "</td>";
                                          echo "<td>" . $row['yrLevel'] . "</td>";
                                           if(ucwords($_SESSION['role']) =="Super Admin"){ 
                                        echo "<td>";
                                             echo '<button type="button" class="btn btn-primary editstudbtn" ><i class="fas fa-edit "></i></button>' ;                               
                                            echo '  <button type="button" class="btn btn-warning delstudbtn"><i class="far fa-trash-alt"></i></button>';
                                        echo "</td>";
                                           }
                                    echo "</tr>";
                        }
                         echo "</tbody>";                            
                            echo "</table>";
                     // Free result set
                            $result->free();
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                                    
                    // Close connection
                    $mysqli->close();

                    ?>
                                      
            </div>
            <!----User Table Ends-->
         
            </div>
            </div>

          
    </div>
                </div>
                </div>

    <!--Container Main end-->

    


    <script type="text/javascript" src=" https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/c73fd6d7cd.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>

		<script>
			$(document).ready(function(){
				 $("#getUID").load("UIDContainer.php");
				setInterval(function() {
					$("#getUID").load("UIDContainer.php");
				}, 500);
			});
		</script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/modal.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/crud.js"> </script>
</body>

</html>