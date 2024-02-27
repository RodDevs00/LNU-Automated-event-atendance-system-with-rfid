<?php
//
require_once "../../config.php";
if(isset($_POST["event"]))
{
   $newEvent = $_POST["event"];
 
 $query = "SELECT * FROM events WHERE event_title ='$newEvent' ";
 $result = mysqli_query($mysqli, $query);
 while($row = mysqli_fetch_array($result))
 {
  $data["event"] = $row["event_title"];
  $data["no_females"] = $row["num_females"];
  $data["no_males"] = $row["num_males"];
 
 }

 echo json_encode($data);
}
?>