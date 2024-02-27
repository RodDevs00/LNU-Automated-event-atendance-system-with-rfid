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

// Define variables and initialize with empty values
$name = $username = $password = $organization = $role = "";
$fname_err = $username_err = $password_err = $org_err = $role_err = "";
 
// Processing form data when form is submitted
if(($_SERVER["REQUEST_METHOD"] == "POST") && !empty($_POST["fname"])){

      // Validate name
    $input_name = trim($_POST["fname"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
 
     // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } 
      elseif($_SESSION["username"] == trim($_POST["username"])){        
                    $username = trim($_POST["username"]);
      }
    else{
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
    
     // Validate Org
    $input_org = trim($_POST["org"]);
    if(empty($input_org)){
        $org_err = "Please choose an Organization.";     
    } else{
        $organization = $input_org;
    }
    
     // Validate Role
    $input_role = trim($_POST["role"]);
    if(empty($input_role)){
        $role_err = "Please choose an Role.";     
    } else{
        $role = $input_role;
    }
    
   // Check input errors before inserting in database
    if( empty($fname_err) && empty($username_err) && empty($password_err) &&  empty($org_err) && empty($role_err)){
      
        // Prepare an update statement
        $sql = "UPDATE admins SET name=?, username=?, password=?, organization=?, role=? WHERE id=?";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssssi",$param_name, $param_username, $param_password, $param_org, $param_role, $param_id);
           
            
            // Set parameters
            $param_name = $name;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_org = $organization;
            $param_role = $role;
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){

          
                // Records updated successfully. Redirect to landing page
                header("location:Profile.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
} 

//READ

else{
    // Check existence of id parameter before processing further
    $id = trim($_SESSION['id']);
    
    if(!empty($id)){

        // Prepare a select statement
        $sql = "SELECT * FROM admins WHERE id = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["name"];
                     $username = $row["username"];
                     $organization = $row["organization"];
                     $role = $row["role"];
                   
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: Error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        $stmt->close();
        
      
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/student.css"> 
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Profile</title>
</head> 
<body id="body-pd">
<!---Delete modal-->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete your account?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No!</button>
        <form action="crud/delete.php" method = "POST">
            <input type="hidden" name= "delme" value = "<?php echo trim($_SESSION['id'])?>">
        <button type="submit" name= "deleteme" class="btn btn-danger">Yes, Delete it!</button>
        </form>
      </div>
    </div>
  </div>
</div>
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
         <div class="card card-body mx-5 my-5">
        <div>
            <h1 class="title ml-3 mt-4">Profile</h1>
        </div>
        <div class="container-fluid"> 
            <p><i>Please edit the input values and submit to update the admin record.</i></p>
            <h2>Hello, <?php echo ucwords($_SESSION['username']); ?></h2>  
            
             <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="row mx-5">
                                <div class="col-md-6 mb-4">
                                    <label for="floatingInput">Full name: </label>
                                    <input type="text" name="fname" class="form-control  <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>" id="floatingInput" value="<?php echo $name; ?>" required="">
                                     <span class="invalid-feedback"><?php echo $fname_err; ?></span>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="floatingInput">Username:</label>
                                    <input type="text" name="username" class="form-control  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="floatingInput" value="<?php echo $username; ?>" required="">
                                     <span class="invalid-feedback"><?php echo $username_err; ?></span>
                                </div>
                        </div>
                                <div class="row mx-5">                              
                                <div class="col-md-6 ">
                                    <label for="floatingPassword">Organization</label>
                                    <select class="custom-select <?php echo (!empty($org_err)) ? 'is-invalid' : ''; ?> " name="org" id="inputGroupSelect01" required="">
                                    <?php
                                $sql="SELECT DISTINCT organization FROM categories ORDER BY organization ASC";
                                if($result = $mysqli->query($sql)){
                               echo"<option selected>$organization</option>";
                               while ($row = $result->fetch_assoc()) {                                 
                               echo "<option value='$row[organization]'>$row[organization]</option>" ;
                                }
                               echo "</select>";
                                }
                                else{
                                    echo $mysqli -> error;
                                }
                                ?>
                                        
                        
                                     <span class="invalid-feedback"><?php echo $org_err; ?></span>
                                </div>
                                <div class="col-md-6 ">
                                    <label for="floatingPassword">Password:</label>
                                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="floatingPassword" required="" >       
                                    <span class="invalid-feedback"><?php echo $password_err; ?></span>
                                    <div class="form-check">
                            <input class="form-check-input" type="checkbox"  onclick="myFunction()">
                            <label class="form-check-label" for="rememberPasswordCheck">
                                Show password
                            </label>
                                </div>
                                </div>
                                
                            </div>
                              <button type="submit" class="btn btn-primary mt-3 ml-5 px-5">Submit changes</button>
                            </form>
                           
                                <button type="submit"  class="btn btn-warning mt-3 ml-5 px-5" data-toggle="modal" data-target="#exampleModal">Delete account</button>
                           
                        
                            
                        </div>     
            </div>
        </div>
    <!--Container Main end-->
    
  
    

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/c73fd6d7cd.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/crud.js"> </script>
</body>
</html>