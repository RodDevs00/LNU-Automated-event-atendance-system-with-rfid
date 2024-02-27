<?php

showLogs();

function showLogs()
{
	// Include config file
require_once "../../config.php";

$eventnew =  $_POST['event'];
                    // Attempt select query execution
                    $sql = "SELECT * FROM $eventnew ORDER BY attendance_no DESC ";
                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo ' <table id="attendanceTable" class="table mx-2">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Student No.</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Organization</th>";
                                        echo "<th>Course</th>";
                                        echo "<th>Time-in</th>";
                                        echo "<th>Time-out</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['student_no'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['organization'] . "</td>";
                                        echo "<td>" . $row['course'] . "</td>";
                                        echo "<td>" . $row['time_in'] . "</td>";
                                        echo "<td>" . $row['time_out'] . "</td>";
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
}
?>


                