<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

/////////////////D I S P L A Y  E V E N T  T I T L E//////////////////////////////////////////////////////
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$eventTitle = "";
  
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM events WHERE event_id = ?";
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("i", $param_id);
            $param_id = $id;
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    $row = $result->fetch_array(MYSQLI_ASSOC);
    
                    $eventTitle = $row["event_title"];
                     $eventnws = preg_replace("/\s+/", "_", $eventTitle); 
                   
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        $stmt->close();

    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }

    //Get number of attendance 
     $esql = "SELECT * FROM $eventnws ";
     $eresults = mysqli_query($mysqli,$esql);
     $rowcount1 = mysqli_num_rows($eresults);
////////////////////////////////////////////////////////////////////////////////////////////
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
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css">
    <link rel="stylesheet" href="../assets/css/events.css">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <title>Events</title>
</head>

<body id="body-pd">

    <!----NAV STARTS-->
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="">
            <div class="dropdown pmd-dropdown pmd-user-info mr-auto">
                <a href="Events.php"> <i class="fa fa-sign-out" style="font-size:30px"></i></a>
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

    <div class="height-100 bg-light" id="refreshdiv">

        <div class="row">
            <div class="col-sm-4">
                <div>
                    <h3 class="font-weight-bold ml-5 mt-2">Record Attendance</h3>
                    </h3>
                    <!-----attendance card ------>

                    <div>
                        <div class="card record ml-5">
                            <div class="card-header bg-primary text-white font-weight-bold"> Recording... </div>
                            <div class="card-body">


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="hidden" class="form-control font-italic" id="event" name="event"
                                            value="<?php echo $eventnws; ?>">
                                        <input type="hidden" class="form-control font-italic" id="eid" name="eid"
                                            value="<?php echo $id; ?>">

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group  col-md-6">
                                        <label>RFID Serial No. :</label>
                                    </div>
                                    <div class="form-group col-md-6">

                                        <textarea class="form-control" name="id" id="getUID" rows="1" cols="1"
                                            required="" readonly></textarea>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                </div>
                <!-----attendance card ------>
            </div>

            <div class="col-sm-8">

                <div>
                    <h3 class=" font-weight-normal ml-5 mt-2">
                        <?php echo $eventTitle; ?>
                    </h3>

                    <div>
                        <!----PASS ID TO PRINT---->
                        <form action="print.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" class="btn btn-warning  ml-5 mb-3" name="submit" value="Print Copy" />
                            <!----switch for time out---->
                            <label class="ml-3 mr-2">TIME-OUT</label>
                            <label class="switch mb-3 ">
                                <input type="checkbox" id="timeout">
                                <span class="slider round"></span>
                            </label>
                        </form>

                    </div>
                </div>
                <!-----Table Start-->
                <div class="d-flex justify-content-start">

                    <div class="card card-body mx-3" style="height:500px;">
                        <h3 class="mx-auto">Attendance Logs (<?php echo $rowcount1 ?>)
                        </h3>
                        <div class="table-responsive" id="logs">

                        </div>
                    </div>
                </div>
                <!-----Table Ends-->
            </div>


        </div>






        <script type="text/javascript" src=" https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/c73fd6d7cd.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
        <script src="../assets/js/sidebar.js"></script>
        <script src="../assets/js/main.js"></script>
        <script src="../assets/js/crud.js"> </script>

        <script type="text/javascript">

            $(document).ready(function () {
                function attendance() {
                    if ($('#timeout').is(':checked')) {
                        var status = "timeout";
                    } else {
                        var status = "";
                    }
                    var event = $('#event').val();
                    var eid = $('#eid').val();
                    var rfid = $('#getUID').val();
                    $.ajax({

                        url: 'crud/records.php',
                        type: 'POST',
                        data: {eid: eid, event: event, rfid: rfid, status: status },
                       
                        success: function (result) {
                           
                      

                        },
                        error: function () {
                            alert("Failed to fetch logs!");
                        }
                        

                    });
                }

                //Fetch rfid logs in database every 2.5 seconds
                setInterval(function () { attendance(); }, 500);
            });



        </script>

        <script type="text/javascript">

            $(document).ready(function () {
                function showData() {
                    var event = $('#event').val();
                    $.ajax({

                        url: 'crud/showlog.php',
                        type: 'POST',
                        data: { action: 'showLogs', event: event },
                        dataType: 'html',
                        success: function (result) {
                            $('#logs').html(result);
                         
                         
                            //$('#attendanceTable').DataTable();
                        },
                        error: function () {
                            alert("Failed to fetch logs!");
                        }
                    })
                }

                //Fetch rfid logs in database every 2.5 seconds
                setInterval(function () { showData(); }, 1000);
            });



        </script>

        <script>
            $(document).ready(function () {
                $("#getUID").load("UIDContainer.php");
                setInterval(function () {
                    $("#getUID").load("UIDContainer.php");
                }, 500);
            });


        </script>



</body>

</html>