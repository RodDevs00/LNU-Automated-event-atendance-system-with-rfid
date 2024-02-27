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
//GET DATA FOR LINEAR REGRESSION
 $sql ="SELECT * FROM events";
         $result = mysqli_query($mysqli,$sql);
    
         while ($row = mysqli_fetch_array($result)) { 
 
            $date[]  = $row['date']  ;
            $num_males[]  = $row['num_males']  ;
        }
         $rowcount = mysqli_num_rows($result);
//Get number of students
         $studsql = "SELECT * FROM students";
         $studresults = mysqli_query($mysqli,$studsql);
          $rowcount1 = mysqli_num_rows($studresults);

//Get number of Admins
          $adsql = "SELECT * FROM admins";
          $adresults = mysqli_query($mysqli,$adsql);
          $rowcount2 = mysqli_num_rows($adresults);

//Get number of Categories
          $adsql = "SELECT * FROM categories";
          $adresults = mysqli_query($mysqli,$adsql);
          $rowcount3 = mysqli_num_rows($adresults);

          /////////////////////////////////////
    $esql = "SELECT event_title,total_attendance,num_males,num_females FROM events WHERE event_title = 'Bday Party'";
    $pieresult = mysqli_query($mysqli, $esql);
    


         
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css">
<link rel="stylesheet" href="../assets/css/dashboard.css">
<link rel="stylesheet" href="../assets/css/sidebar.css">
<link rel="stylesheet" href="../assets/css/main.css">
    <title>Dashboard</title>
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
<!--Details-->
<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Dates to Forecast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class = "btn btn-primary" name="button" onclick="Geeks()">
		Forecast Now
		</button>
      </div>
    </div>
  </div>
</div>
<!--End-->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Dates to Forecast</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
                <div class=""> 
                <form class="" action="#" method="">
                    <label for="date" class="col-form-label">Note: Forecast dates must be future dates</label>
                <input class="form-control fdate" type="date"   value=""/><br>
                <input class="form-control fdate" type="date"   value=""/><br>
                <input class="form-control fdate" type="date"   value=""/><br>
                <input class="form-control fdate" type="date"  value=""/><br>
                <input class="form-control fdate" type="date" value=""/><br>

                    
                </form>
            </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class = "btn btn-primary" name="button" data-dismiss="modal">
                    Submit
                    </button>
                </div>
                </div>
            </div>
            </div>
<!--End-->
    <!--Container Main start-->
    <div class="height-100 bg-light">

        <div>
            <h1 class="title ml-3 mt-4">Dashboard</h1>
        </div>





<!-- End of Card---->

<div class="">

<div class="row">

        <div class="card card-body  col-sm-8"><h5>Attendance Forecast Using Linear Regression</h5>
        <div class="d-flex flex-row">
  <div class="p-2">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" id="forcecast" data-toggle="modal" data-target="#exampleModal" style="width:100px;">
            Forecast
            </button>
  </div>
  <div class="p-2">
     <div class="form-group mx-2">
                            <select class="custom-select" name="organization" id="organization" style = "width:250px;"  required="">
                                 <?php
                                $sql="SELECT DISTINCT organization FROM categories  ORDER BY organization ASC";
                                if($result = $mysqli->query($sql)){
                               echo"<option selected> select Organization</option>";
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
  </div>
 
                <div class="p-2">
                        <button class="btn  btn-warning" onClick="window.location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                </div>
            </div>
           <p> <b>Forecast for: <span id="gg"></b></p>
         <svg id="chart" viewBox="0 0 1000 500" ></svg>
     
                    <button class="btn info" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapse">
                        Details
                    </button>
                    </p>
                    <div class="collapse" id="collapse">
                    <div class="card card-body">
                        <p> <b>Forecast details:</b> <span id="fdg"> </p>
                        <p> <b>Forecast: </b> </p>
                        
      
        <div class="table table-sm table-bordered " id="table"></div>
  
       

                         </div>
                    </div>

            
  </div>
        
 <div class="card card-body col-sm-4 ">
<div class="d-flex flex-row">
    <div class="form-group mt-1 p-2">
                            <label for="dep" class="col-form-label">Select Event:</label>
                            <select class="custom-select" name="event" id="event" style = "width:250px;"  >
                                 <?php
                                $sql="SELECT event_title FROM events  ORDER BY event_title ASC";
                                if($result = $mysqli->query($sql)){
                               echo"<option selected></option>";
                               while ($row = $result->fetch_assoc()) {                                 
                               echo "<option value='$row[event_title]'>$row[event_title]</option>" ;
                                }
                               echo "</select>";
                                }
                                else{
                                    echo $mysqli -> error;
                                }
                                ?>
                        </div>
                        <div class="p-2"><button type="button" class="btn btn-info mt-5" id="submit">Show</button></div>
                            </div>
 <div  id="piechart"></div>  
  <p> <b>Event: <span id="ev"></b> </p>

    <p> Number of Males: <b><span id="lm"></span></b></p>
      <p> Number of Females: <b><span id="lf"></span></b></p>
       <p> <b>Forecast based on past events: </b> </p>
<form class="" action="#" method="">
                    <label for="date" class="col-form-label">Note: Forecast date must be future dates</label>
                <input class="form-control genders" id="genders" type="date"   value=""/><br>               
                </form>
      <p> <b>Forecast Males:</b> </p>
       <div class="table table-sm table-bordered " id="mtable"></div>
        <p> <b>Forecast Females:</b> </p>
       <div class="table table-sm table-bordered " id="ftable"></div>

     
                        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#yr">
  Year Level
</button>

<!-- Modal -->
<div class="modal fade" id="yr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Forecast by Year Level:</h5>
        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                        <div class="form-group mt-1 mb-2 p-2">
                            <label for="dep" class="col-form-label">Year Level:</label>
                            <select class="custom-select" name="yrlvl" id="yrlvl" style = "width:250px;"  >
                              
                               
                               <option selected></option>
                                                          
                               <option value='yrlvl1'>1st Year</option>
                               <option value='yrlvl2'>2nd Year</option>
                               <option value='yrlvl3'>3rd Year</option>
                               <option value='yrlvl4'>4th Year</option>
                             </select>
        <div class="table table-sm table-bordered " id="yrtable"></div>
  <svg id="yrchart" viewBox="0 0 1000 500" ></svg>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
      
      
                 
                         </div>
                    </div>
 </div>
   
 
  </div>  
  </div>
  
  <!--end Card-->  
  <input type="hidden" id="females">
  <input type="hidden" id="males">

  <input type="hidden" id="dd">
</div>

 
    <!--Container Main end-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/c73fd6d7cd.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
 <script src="https://d3js.org/d3.v7.min.js"></script>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script src="../assets/js/pie.js"> </script>
 <script src="../assets/js/send.js"> </script>
  <script src="../assets/js/linear.js"> </script>
  <script src="../assets/js/mlinear.js"> </script>
  <script src="../assets/js/yrlvl.js"> </script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/crud.js"> </script>
<script src="../assets/js/charts.js"></script>


</body>
</html>