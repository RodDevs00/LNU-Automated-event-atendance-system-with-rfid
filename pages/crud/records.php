<?php 
attend();

function attend(){

  // Include config file
require_once "../../config.php";
//define empty variables
 $rfid = $eventnew = $eid = "";
 $rfid_err = $fname_err = $section_err = "";

  
$eid = $_POST['eid']; 
$eventnew =  $_POST['event'];
$status = $_POST['status'];
///Set Time_Zone 
date_default_timezone_set('Asia/Manila');
$timein =  date("g:i:s:A Y-m-d ");
                              // Validate  RFID
                       $input_rfid = trim($_POST["rfid"]);
                      if(empty($input_rfid)){
                            $rfid_err = "Please tap ID on the scanner.";     
                        } else{  
                        // Prepare a select statement                      
                        $sql = "SELECT attendance_no FROM $eventnew WHERE rfid_no = '$input_rfid'";
                        $query_run = mysqli_query($mysqli, $sql);                   
                    if($query_run)
                        {
                                 $rowcount = mysqli_num_rows($query_run);                         
                                if($rowcount == 0 && empty($status)){                                  
                                           $rfid = $input_rfid;

                                          //Get Student Details
                                           $sql = "SELECT * FROM students WHERE rfid_no = '$rfid'";
                                           $result = mysqli_query($mysqli,$sql);
                                           $rowcount = mysqli_num_rows($result);

                                           if($rowcount == 1){
                                                     // Associative array
                                           $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                           $studno =  $row["student_no"];
                                           $fname =  $row["name"];
                                           $gender =  $row["gender"];
                                           $yrlvl =  $row["yrLevel"];
                                           $course =  $row["course"];
                                           $organization =  $row["organization"];
                                       
                                       
                                           
                                            }
                                            else{
                                              $err = "Student not registered";
                                         }
                                         
                                        if(empty($err)){
                                           //Insert attendee details
                                           $query = "INSERT INTO $eventnew (`rfid_no`,`student_no`, `name`,`course`,`organization`,`time_in`) VALUES ('$rfid', '$studno','$fname','$course','$organization','$timein')";
                                           $query_run = mysqli_query($mysqli, $query);
                                           
                
                                         if($query_run)
                                       {
                                         $sql = "UPDATE events SET total_attendance = total_attendance + 1 WHERE event_id = '$eid'";
                                         $query_run2 = mysqli_query($mysqli, $sql);
                                      echo '<script> alert("Data Saved"); </script>';
                                      
                                      if($gender == "Male"){
                                        $sqlg = "UPDATE events SET num_males = num_males + 1 WHERE event_id = '$eid'";
                                        $query_rung = mysqli_query($mysqli, $sqlg);
                                     echo '<script> alert("Data Saved"); </script>';
                                      }
                                      else{
                                        $sqlgf = "UPDATE events SET num_females = num_females + 1 WHERE event_id = '$eid'";
                                        $query_rungf = mysqli_query($mysqli, $sqlgf);
                                     echo '<script> alert("Data Saved"); </script>';
                                      }
                                       // Yr Lvl Add
                                       if($yrlvl == "1st year"){
                                        $sql01 = "UPDATE events SET yrlvl1 = yrlvl1 + 1 WHERE event_id = '$eid'";
                                        $query_run01 = mysqli_query($mysqli, $sql01);
                                       }
                                       elseif($yrlvl == "2nd year"){
                                        $sql02 = "UPDATE events SET yrlvl2 = yrlvl2 + 1 WHERE event_id = '$eid'";
                                        $query_run02 = mysqli_query($mysqli, $sql02);

                                      }
                                      elseif($yrlvl == "3rd year"){
                                        $sql03 = "UPDATE events SET yrlvl3 = yrlvl3 + 1 WHERE event_id = '$eid'";
                                        $query_run03 = mysqli_query($mysqli, $sql03);

                                      }
                                      elseif($yrlvl == "4th year"){
                                        $sql04 = "UPDATE events SET yrlvl4 = yrlvl4 + 1 WHERE event_id = '$eid'";
                                        $query_run04 = mysqli_query($mysqli, $sql04);

                                      }
                                      else{
                                        //Error in yrlvl
                                        echo '<script> alert("Data Saved"); </script>';
                                      }
                                       //End yR LVL
                                        }
                                       else
                                       {
                                          echo '<script> alert("Data Not Saved"); </script>';
                                       }
                                        }
                                        else{
                                          echo '<script> alert("Data Not Saved"); </script>';
                                        }
                                           
                
                                 
                                } 
                                ///////////////////TIMEOUT
                                elseif($rowcount == 1 && !empty($status)){

                                  $sql = "SELECT time_out FROM $eventnew WHERE rfid_no = '$input_rfid'";
                                  $result = mysqli_query($mysqli,$sql);
                                  $rowcount = mysqli_num_rows($result);

                                  //check if time out already recorded
                                  if($rowcount == 1){
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                                           $checktimeout =  $row["time_out"];

                                           if(empty($checktimeout)){
                                            $timeout =  date("g:i:s:A Y-m-d ");
                                            $query = "UPDATE $eventnew SET time_out ='$timeout' WHERE rfid_no = '$input_rfid' ";
                                                $query_run = mysqli_query($mysqli, $query);
                       
                                                if($query_run)
                                              {
                                              
                                             echo '<script> alert("Data Saved"); </script>';
                                              
                                               
                                               }
                                              else
                                              {
                                                 echo '<script> alert("Data Not Saved"); </script>';
                                              } 

                                           }
                                           else{
                                             //do nothing because timout already recorded
                                           }
                                   
                                  }
                                  else{
                                        //
                                  }
                                   
                                        
                                }
                                else{
                                  echo '<script> alert("gggg"); </script>';
                                }
                
                                
                        mysqli_free_result($query_run);
                        }
                         mysqli_close($mysqli);
                       
                        
}


}







  
?>
 