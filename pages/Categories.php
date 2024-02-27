<?php

// Include config file
require_once "../config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || ucwords($_SESSION['role']) == "Admin"){
    header("location: login.php");
    exit;
}

//ADD COURSES
// Define variables and initialize with empty values
$course = $college = $organization ="";
$course_err = $college_err =  $organization_err="";
 

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate course
    $input_course = trim($_POST["course"]);
    if(empty($input_course)){
        $course_err = "Please enter a course.";
    } else{
        $course = $input_course;
    }

    // Validate college
    $input_org = trim($_POST["organization"]);
    if(empty($input_org)){
        $organization_err = "Please enter a organization name.";     
    } else{
        $organization = $input_org;
    }
    
    
    // Validate college
    $input_college = trim($_POST["college"]);
    if(empty($input_college)){
        $college_err = "Please enter a college name.";     
    } else{
        $college = $input_college;
    }
    
   
    
    // Check input errors before inserting in database
    if(empty($college_err) && empty($course_err) && empty($organization_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO categories (course, organization, college) VALUES (?, ?, ?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_course, $param_organization, $param_college);
            
            // Set parameters
            $param_course = $course;
            $param_college = $college;
            $param_organization =$organization;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: Categories.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
}
//ADD COURSES ENDS

//EDIT COURSES STARTS

 
//EDIT COURSES ENDS

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
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css">
    <link rel="stylesheet" href="../assets/css/categories.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Categories</title>
</head>

<body id="body-pd">
    <main-categories></main-categories>
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
            <h1 class="title ml-3 mt-4">Categories</h1>
        </div>


        <!---COURSES-->
        
            <div class="card card-body">
            <div class="eventwrapper">
                <button type="button" class="btn btn-primary mb-3 ml-5 mt-2 px-5" data-toggle="modal" data-target="#addcoursemodal"
                    data-whatever="@fat">Add Category</button>
                <!----COURSE Table Start-->
                <div class="table-responsive">
                     <?php

                    // Attempt select query execution
                    $sql = "SELECT * FROM categories";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                              echo '<script ></script>';
                           echo ' <table id="courseTable" class="table table-sm table-hover ">';
                              echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Course Title</th>";
                                         echo "<th>Organization</th>";
                                        echo "<th>College</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                 echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['category_Id'] . "</td>";
                                        echo "<td>" . $row['course'] . "</td>";
                                        echo "<td>" . $row['organization'] . "</td>";
                                        echo "<td>" . $row['College'] . "</td>";
                                        echo "<td>";
                                            echo ' <button type="button" class="btn btn-primary editcat"><i class="fas fa-edit"></i></button>';
                                             echo ' <button type="button" class="btn btn-warning deletecat"><i class="far fa-trash-alt"></i></button>';
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
                <!----COURSE Table Ends-->
            
            </div>
            </div>
       
<!---COURSES ENDS-->

      
    </div>
    <!--Container Main end-->

    <!--M O D A L S-->
       <!----Add CATEGORY Modal Start-->
    <div class="mt-5" id="addcategory">
    
        <div class="modal fade" id="addcoursemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group mx-5">
                                <label for="ename" class="col-form-label ">Course title:</label>
                                <input type="text" class="form-control <?php echo (!empty($course_err)) ? 'is-invalid' : ''; ?>" name="course" id="ename" required="" placeholder="Course Name">
                                <span class="invalid-feedback"><?php echo $course_err;?></span>
                            </div>
                             <div class="form-group mx-5">
                                <label for="org" class="col-form-label ">Organization name:</label>
                                <input type="text" class="form-control <?php echo (!empty($organization_err)) ? 'is-invalid' : ''; ?>" name="organization" id="org" required=""  placeholder="Organization Name">
                                <span class="invalid-feedback"><?php echo $organization_err;?></span>
                            </div>
                            <div class="form-group mx-5">
                                <label for="college" class="col-form-label ">College name:</label>
                                <input type="text" class="form-control <?php echo (!empty($college_err)) ? 'is-invalid' : ''; ?>" name="college"  required="" placeholder="College Name">
                                <span class="invalid-feedback"><?php echo $college_err;?></span>
                            </div>
                            
                            <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!----Add course Modal Ends--> 
     <!----Edit Category Modal Start-->
    <div class="mt-5" id="editCategory">
    
        <div class="modal fade" id="editcatmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                        <button type="button" class="close edclose" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="crud/updatecode.php" method="POST">  

                          <input type="hidden" name="edit_id" id="edit_id">

                              <div class="form-group mx-5">
                                <label for="ename" class="col-form-label ">Course title:</label>
                                <input type="text" class="form-control" name="course" id="course" placeholder="Course Name" required="">
                             
                            </div>
                             <div class="form-group mx-5">
                                <label for="org" class="col-form-label ">Organization name:</label>
                                <input type="text" class="form-control" name="organization" placeholder="Organization Name" id="organization" required="">
                                
                            </div>
                            <div class="form-group mx-5">
                                <label for="college" class="col-form-label ">College name:</label>
                                <input type="text" class="form-control" name="college" placeholder="College Name" id="college"  required="">
                               
                            </div>
                            
                            <div class="modal-footer">
                        <button type="button" class="btn btn-danger edclose" >Close</button>
                        <button type="submit" name="updatecat" class="btn btn-primary">Save</button>
                    </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <!----Edit Category Modal Ends-->

    <!---Delete Category starts-->
    <div class="mt-5" id="delcat">
    
        <div class="modal fade" id="delcatmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <p class="modal-title " id="exampleModalLabel">Are you sure you want to delete this Category?</p>
                       <button type="button" class="close delclose" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="crud/delete.php" method="POST">

                    
                        <input type="hidden" name="delete_id" id="delete_id">

                      
                 
                    <div class="modal-footer">
                         <button type="button" class="btn btn-primary delclose" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="deletecat" class="btn btn-danger"> Confirm Delete </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!----Delete Category Modal Ends-->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/c73fd6d7cd.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/modal.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/crud.js"> </script>
</body>

</html>