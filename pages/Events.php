<?php
// Include config file
require_once "../config.php";
// Initialize the session
session_start();

//Define Variables
$orgAuth = ucwords($_SESSION['organization']);

 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet"/>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../assets/css/events.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Events</title>
</head>
<body id="body-pd">
 <!----Add events Modal Start-->
<div class="mt-5" id="addevent">

    <div class="modal fade" id="addeventmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <form action="crud/create.php" method="POST">
                        <div class="form-group mx-5">
                            <label for="ename" class="col-form-label ">Event title:</label>
                            <input type="text" class="form-control" name="ename" id="ename" required="">
                        </div>
                        <div class="form-group mx-5">
                           <?php
                                $sql="SELECT DISTINCT organization FROM categories ORDER BY organization ASC";
                                if($result = $mysqli->query($sql)){
                                echo  '<label for="floatingIn">Organizers:</label>';
                               echo ' <select class="custom-select " name="organizers" required ="">';
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
                            <label for="date" class="col-form-label">Date:</label>
                            <input class="form-control" type="date" name="date" required="" />
                        </div>
                         <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" name="addevent" class="btn btn-primary ">Save</button>
                </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>
<!----Add events Modal Ends-->

<!----Edit events Modal Start-->
<div class="mt-5" id="Editevent">

    <div class="modal fade" id="editeventmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Event</h5>
                    <button type="button" class="close edclose" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <form action="crud/updatecode.php" method="POST">

                   <input type="hidden" name="edit_id" id="edit_id">
                        <div class="form-group mx-5">
                            <label for="ename" class="col-form-label ">Event title:</label>
                            <input type="text" class="form-control" name="ename" id="editname" required="">
                        </div>
                        <div class="form-group mx-5">
                           <?php
                                $sql="SELECT DISTINCT organization FROM categories ORDER BY organization ASC";
                                if($result = $mysqli->query($sql)){
                                echo  '<label for="floatingIn">Organizers:</label>';
                               echo ' <select class="custom-select " name="organizers" id="organizer" required ="">';
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
                            <label for="date" class="col-form-label">Date:</label>
                            <input class="form-control" type="date" name="date"  id="date" required=""/>
                        </div>
                         <div class="modal-footer">
                    <button type="button" class="btn btn-warning edclose" >Close</button>
                    <button type="submit" name="editevent" class="btn btn-primary ">Save</button>
                </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>
<!----Edit events Modal Ends-->

    <!---Delete Event starts-->
    <div class="mt-5" id="delevent">
    
        <div class="modal fade" id="deleventmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <p class="modal-title " id="exampleModalLabel">Are you sure you want to delete this Event?</p>
                       <button type="button" class="close delclose" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="crud/delete.php" method="POST">

                    
                        <input type="hidden" name="delete_id" id="delete_id">

                      
                 
                    <div class="modal-footer">
                         <button type="button" class="btn btn-primary delclose" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="delEvent" class="btn btn-danger"> Confirm Delete </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!----Delete Event Modal Ends-->

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
<!--Container Main start-->
<div class="height-100 bg-light">

    <div>
        <h1 class="title ml-3 mt-4">Events</h1>
    </div>
       <div class="card card-body">
    <div class="eventwrapper">
        <button type="button" class="btn btn-primary mb-3 ml-3 px-5" data-toggle="modal" data-target="#addeventmodal"
            data-whatever="@fat">Add event</button>
        <!----Events Table Start-->
        <div class="table-responsive">
                     <?php
                 $role = "Super Admin";
                //User Auth
                if(ucwords($_SESSION['role']) == ($role) ){
                    $sql = "SELECT * FROM events";
                }else{
                       $sql = "SELECT * FROM events WHERE organizers = '$orgAuth'";
                }
                    // Attempt select query execution
                  
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                              echo '<script ></script>';
                           echo ' <table id="eventsTable" class="table table-sm table-hover">';
                              echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Event Title</th>";
                                        echo "<th>Organizers</th>";
                                         echo "<th>Date</th>";
                                         echo "<th>Total Attendance</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                 echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['event_id'] . "</td>";
                                        echo "<td>" . $row['event_title'] . "</td>";
                                        echo "<td>" . $row['organizers'] . "</td>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['total_attendance'] . "</td>";
                                        echo "<td>";
                                            echo ' <a href="startEvent.php?id='. $row['event_id'] .'" class="btn btn-primary" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                                            echo ' <button type="button" class="btn btn-info editevent mr-1" ><i class="fas fa-edit "></i></button>';
                                            echo '<button type="button" class="btn btn-warning delevent"><i class="far fa-trash-alt"></i></button>';
                                        echo "</td>";
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
        <!----Events Table Ends-->
        
    </div> 
</div> 
</div>
<!--Container Main end-->


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/c73fd6d7cd.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/modal.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/crud.js"> </script>
</body>
</html>