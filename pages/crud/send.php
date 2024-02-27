<?php
//
require_once "../../config.php";
if(isset($_POST["org"]))
{
   $org = $_POST["org"];

    $sql ="SELECT * FROM events WHERE organizers ='$org'";
         $result = mysqli_query($mysqli,$sql);
         while ($row = mysqli_fetch_array($result)) { 
 
            $date[]  = $row['date']  ;
            $vol[] = $row['total_attendance'];
             $data["org"] = $row["organizers"];
              $data["date"] =  $date;
               $data["vols"] =  $vol;

        }
       
         
     

 echo json_encode($data);
}
?>