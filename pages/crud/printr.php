   <?php
require_once "../../config.php";
            
                    
                    $eventnws = $_POST["pr"];
                    if(!empty($_POST["org"]) && empty($_POST["course"])){
                        $orgy = $_POST["org"];
                    $sql = "SELECT * FROM $eventnws WHERE organization ='$orgy' ORDER BY name ASC";
                    }
                    elseif(empty($_POST["org"]) && !empty($_POST["course"])){
                    $crs =  $_POST["course"];
                    $sql = "SELECT * FROM $eventnws WHERE course ='$crs' ORDER BY name ASC";
                    }
                    elseif(!empty($_POST["org"]) && !empty($_POST["course"])){
                        $orgy = $_POST["org"];
                        $crs =  $_POST["course"];
                    $sql = "SELECT * FROM $eventnws WHERE course ='$crs' AND organization ='$orgy' ORDER BY name ASC ";
                    }
                    else{
                    $sql = "SELECT * FROM $eventnws ORDER BY name ASC";
                    }

                    if($result = $mysqli->query($sql)){
                        if($result->num_rows > 0){
                            echo ' <table id="attendanceTable" class="table table-sm table-bordered print px-5 ">';
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
                    ?>