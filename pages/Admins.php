<?php
// Include config file
require_once "../config.php";


 // Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || ucwords($_SESSION['role']) == "Admin" ){
    header("location: login.php");
    exit;
}
 

// Define variables and initialize with empty values
$fname = $username = $password = $org = $role = "";
$fname_err = $username_err = $password_err = $role_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

      // Validate name
    $input_name = trim($_POST["fname"]);
    if(empty($input_name)){
        $fname_err = "Please enter a name.";
         echo '<div class="alert alert-Danger">Hey! Do not Leave Blanks </div>';
  header("Refresh: 3; URL=Admins.php");
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $fname_err = "Please enter a valid name.";
         
    } else{
        $fname = $input_name;
    }
 
     // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
         
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM admins WHERE username = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "Username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    //save Organization
       $org = $_POST["org"];
    
     // Validate role
    $input_role = trim($_POST["role"]);
    if(empty($input_role)){
        $role_err = "Please choose an Role.";     
    } else{
        $role = $input_role;
    }
    
    // Check input errors before inserting in database
    if( empty($fname_err) && empty($username_err) && empty($password_err) && empty($role_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO admins (name, username, password, organization, role) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssss",$param_name, $param_username, $param_password, $param_org, $param_role);
            
            // Set parameters
            $param_name = $fname;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_org = $org;
            $param_role =$role;

             // Attempt to execute the prepared statement
            if($stmt->execute()){
            echo '<div class="alert alert-success">Successfully Added! </div>';
            header("Refresh: 3; URL=Admins.php");
            }
          
            // Close statement
            $stmt->close();
        }
    }
    
    
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/student.css"> 
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Admins</title>
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
    <!----Add user Modal Start-->
    <div class="mt-5" id="adduser">
    
        <div class="modal fade" id="addusermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php if (isset($errorMsg)) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $errorMsg; ?>
          </div>
        <?php } ?>
                           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                 
                                    <div class="form-group mx-5">
                                        <label for="floatingInput">Full name:  </label>
                                        <input type="text" name="fname" class="form-control <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>"  id="floatingInput" placeholder="Juan Dela Cruz"  required ="">                           
                                        <span class="invalid-feedback"><?php echo $fname_err; ?></span>
                                    </div> 
                                    <div class="form-group mx-5">
                                        <label for="floatingInput">Username:</label>
                                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="floatingInput" placeholder="Juan"  required =""> 
                                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                    </div>
                                  
                                    <div class="form-group mx-5">
                                        <label for="floatingPassword">Password:</label>
                                        <input type="text" name="password" minlength="6" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="floatingPassword" placeholder="Password"  required ="">
                                         <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                    </div>
                                     <div class="form-group mx-5">
                               <?php
                                $sql="SELECT DISTINCT organization FROM categories ORDER BY organization ASC";
                                if($result = $mysqli->query($sql)){
                                echo  '<label for="floatingIn">Organization:</label>';
                               echo ' <select class="custom-select " name="org" required ="">';
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
                                <label for="floatingPassword">Role</label>
                                <select class="custom-select <?php echo (!empty($role_err)) ? 'is-invalid' : ''; ?> " id="floatingPassword" name="role" id="inputGroupSelect01"  required ="">
                                    <option selected></option>
                                    <option value="Super admin">Super admin</option>
                                    <option value="Admin">Admin</option>
                                </select>
                                <span class="invalid-feedback"><?php echo $role_err; ?></span>
                            </div>
                                     <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                            
                        </form>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <!----Add user Modal Ends-->
    <!--Container Main start-->
    <div class="height-100 bg-light">

 <?php if (isset($error)) { ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php
            foreach ($error as $err)
       {
          echo '<li>'.$err.'</li>';
          }
   
             ?>
          </div>
        <?php } ?>

        <div>
            <h1 class="title ml-3 mt-4">Admins</h1>
             <p class="ml-5"><i> Logged in as <?php echo ucwords($_SESSION['username']); ?>.</i></p>
        </div>
         <div class="card card-body">
        <div class="eventwrapper">
            <button type="button" class="btn btn-primary mb-3 ml-5 px-5 add" data-toggle="modal" data-target="#addusermodal"
                data-whatever="@fat">Add Admin</button>
            <!----Events Table Start-->
            <div class="table-responsive">
                  <?php

                    // Attempt select query execution
                    $sql = "SELECT * FROM admins";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                              echo '<script ></script>';
                           echo '<table id="adminsTable" class="table table-sm table-hover">';
                              echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Full Name</th>";
                                        echo "<th>Username</th>";
                                         echo "<th>Organization</th>";
                                        echo "<th>Role</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                 echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['username'] . "</td>";
                                        echo "<td>" . $row['organization'] . "</td>";
                                        echo "<td>" . $row['role'] . "</td>";
                                        echo "<td>";
                                       if(ucwords($row['role']) =="Admin"){

                                            echo '<button type="button" class="btn btn-warning deladminbtn"><i class="far fa-trash-alt"></i></button>';
                                   }  
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

    <!---Delete admin starts-->
    <div class="mt-5" id="deladmin">
    
        <div class="modal fade" id="deladminmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <p class="modal-title " id="exampleModalLabel">Are you sure you want to delete this admin?</p>
                       <button type="button" class="close delclose" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="crud/delete.php" method="POST">

                    
                        <input type="hidden" name="delete_id" id="delete_id">

                      
                 
                    <div class="modal-footer">
                         <button type="button" class="btn btn-primary delclose" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="deleteadmin" class="btn btn-danger"> Confirm Delete </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!----Delete admin Modal Ends-->
    

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/c73fd6d7cd.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
      
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/modal.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/crud.js"> </script>


</body>
</html>