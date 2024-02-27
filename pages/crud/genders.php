<?php
//
require_once "../../config.php";
if(isset($_POST["gen"]))
{
  

    $sql ="SELECT * FROM events";
         $result = mysqli_query($mysqli,$sql);
         while ($row = mysqli_fetch_array($result)) { 
 
            $date[]  = $row['date']  ;
            $vol[] = $row['num_males'];
            $fvol[] = $row['num_females'];
              $data["date"] =  $date;
               $data["vols"] =  $vol;
               $data["fvols"] =  $fvol;

        }
       
         
     

 echo json_encode($data);
}
?>