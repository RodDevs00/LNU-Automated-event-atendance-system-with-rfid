<?php
//
require_once "../../config.php";
if(isset($_POST["yr"]))
{
   $yr = $_POST["yr"];

    $sql ="SELECT * FROM events";
         $result = mysqli_query($mysqli,$sql);
         while ($row = mysqli_fetch_array($result)) { 
 
            $date[]  = $row['date']  ;
            $vol[] = $row[$yr];
              $data["date"] =  $date;
               $data["vols"] =  $vol;

        }
       
         
     

 echo json_encode($data);
}
?>