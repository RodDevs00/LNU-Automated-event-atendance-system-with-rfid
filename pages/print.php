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
  $print_id = $_POST['id'];

  // Define variables and initialize with empty values
$eventTitle = "";
  
    if(isset($_POST['id']) && !empty(trim($_POST['id']))){
        
        $id = $print_id;
        
        // Prepare a select statement
        $sql = "SELECT * FROM events WHERE event_id = ?";
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("i", $param_id);
            $param_id = $id;
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $eventDate = $row["date"];
                    $eventTitle = $row["event_title"];
                    $organizers = $row["organizers"];
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

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1024">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet"/>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/print.css"  media="print">
    <title>Events</title>
</head>
<body id="body-pd">
  <div class="d-flex">
  <div class="mr-auto p-2">
      <button onclick="window.print();" class="btn btn-warning" id="print-btn">Print Copy</button>
  </div>
  <div class="p-2">
      <a href="Events.php" class="btn btn-primary" id="print-btn" role="button"> Back</a>
  </div>
</div>

<div class=" printcard mt-3 mx-3">
  <div class="d-flex justify-content-center mb-4 mt-5">
   <div>
      <img class="" src="../assets/img/lnulogo.png" alt="logo" style="width:100px;">
  </div>
  <div class= "mx-4 mt-3 ">
   <p style="text-align:center"> Republic of the Philippines <br>
   <b>Leyte Normal University</b>  <br>
   Tacloban City</p> 
  </div> 
      <div>
      <img class="mt-3" src="../assets/img/iso.jpg" alt="iso" style="width:220px;"> 
      </div>
     
  </div>
</div>
<div class="d-flex">
  <div class="p-2"><p> Event Title:  <?php echo $eventTitle; ?></p> 
                  <p> Organized by:   <?php echo $organizers; ?></p>  </div>
   
  <div class=" ml-auto p-2 "><p> Date:  <?php echo $eventDate; ?></p></div>
</div>


<!------------->
<div id = "hide">
    <input type="hidden" id="printevent" value="<?php echo $eventnws; ?>">
            <div class="d-flex">              
                             <div class="form-group mx-2">
                            <label for="dep" class="col-form-label">Print by Organization:</label>
                            <select class="custom-select" name="organization" id="organization" style = "width:250px;"  required="">
                                 <?php
                                $sql="SELECT DISTINCT organization FROM categories  ORDER BY organization ASC";
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
<!------------->


                           <div class="form-group mx-2">
                            <label for="dept" class="col-form-label">Print by Course:</label>
                            <select class="custom-select" name="course" id="courses" style = "width:250px;" required="">
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
                        <div>
                                 
                        </div>  
                      
                </div>
                </div>
<!------------->
                <div class ="mb-5" id="logs"></div>

                <div class="d-flex justify-content-around mt-5"> 
                  <div class="mt-5"> _________________________________</br>
                  <p style = "text-indent: 40px;">Organization President</p> 
                  </div>
                  <div class="mt-5"> _________________________________</br>
                  <p style = "text-indent: 40px;">Organization Adviser</p> 
                  </div>
                  <div class="mt-5"> _________________________________</br>
                  <p style = "text-indent: 40px;">Organization Secretary</p> 
                  </div>
                </div>
                </div>
         

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></>
<script src="https://kit.fontawesome.com/c73fd6d7cd.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"></script>
    <script src="../assets/js/components.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/crud.js"> </script>
    <script type="text/javascript">

    $(document).ready(function(){
      function showData()
      { 
        var pr = $('#printevent').val();
        var org = $('#organization').val();
        var course = $('#courses').val();
        $.ajax({

          url: 'crud/printr.php',
          type: 'POST',
          data: {org:org, course:course, pr:pr},
          dataType: 'html',
          success: function(result)
          {
            $('#logs').html(result);
          },
          error: function()
          {
            alert("Failed to fetch logs!");
          }
        })
      }

      //Fetch rfid logs in database every 2.5 seconds
      setInterval(function(){ showData(); }, 2500);
    });



  </script>

  
 
</body>

</html>