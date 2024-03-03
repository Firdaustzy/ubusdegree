<!-- Show these admin pages only when the admin is logged in -->
<?php  require '../assets/partials/_admin-check.php';   ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routes</title>
        <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- CSS -->
    <?php 
        require '../assets/styles/admin.php';
        require '../assets/styles/admin-options.php';
        $page="route";
    ?>
</head>
<body>
    <!-- Requiring the admin header files -->
    <?php require '../assets/partials/_student-header.php';?>

    <!-- Add, Edit and Delete Routes -->
    
          
        <?php
            $resultSql = "SELECT * FROM `routes` ORDER BY route_created DESC";
                            
            $resultSqlResult = mysqli_query($conn, $resultSql);
            if(!mysqli_num_rows($resultSqlResult)){ ?>
                <!-- Routes are not present -->
                <div class="container mt-4">
                    <div id="noRoutes" class="alert alert-dark " role="alert">
                        <h1 class="alert-heading">No Routes Found!!</h1>
                        <p class="fw-light">Be the first person to add one!</p>
                        <hr>
                        <div id="addRouteAlert" class="alert alert-success" role="alert">
                                Click on <button id="add-button" class="button btn-sm"type="button"data-bs-toggle="modal" data-bs-target="#addModal">ADD <i class="fas fa-plus"></i></button> to add a route!
                        </div>
                    </div>
                </div>
            <?php }
            else { ?>
                <!-- Routes Are present -->
                <section id="route">
                    <div id="head">
                        <h4>U-Bus Route Status</h4>
                    </div>
                    <div id="route-results">
                        <div>
                            
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <th>ID</th>
                                <th>Via Cities</th>
                                <th>Bus</th>
                                <th>Departure Date</th>
                                <th>Departure Time</th>
                                <th>Cost</th>
                        
                            </thead>
                            <?php
                                while($row = mysqli_fetch_assoc($resultSqlResult))
                                {
                                        // echo "<pre>";
                                        // var_export($row);
                                        // echo "</pre>";
                                    $id = $row["id"];
                                    $route_id = $row["route_id"];
                                    $route_cities = $row["route_cities"];
                                    $route_dep_time = $row["route_dep_time"];
                                    $route_dep_date = $row["route_dep_date"];
                                    $route_step_cost = $row["route_step_cost"];
                                    $bus_no = $row["bus_no"];
                                        ?>
                                    <tr>
                                        <td>
                                            <?php 
                                                echo $route_id;
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                echo $route_cities;
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                echo $bus_no;
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                echo $route_dep_date;
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                echo $route_dep_time;
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                echo 'RM'.$route_step_cost;?>
                                        </td>
                                        
                                    </tr>
                                <?php 
                                }
                            ?>
                        </table>
                    </div>
                    </section>
                <?php  }
            ?>
            </div>
    </main>
            <?php
                $busSql = "Select * from buses where bus_assigned=0";
                $resultBusSql = mysqli_query($conn, $busSql);
                $arr = array();
                while($row = mysqli_fetch_assoc($resultBusSql))
                    $arr[] = $row;
                $busJson = json_encode($arr);
            ?>
            <!-- Add Route Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add A Route</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addRouteForm" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
                            <div class="mb-3">
                                    <label for="viaCities" class="form-label">Via Cities</label>
                                <input type="text" class="form-control" id="viaCities" name="viaCities" placeholder="Comma Separated List" required>
                                <span id="error">

                                </span>
                            </div>
                            <input type="hidden" id="busJson" name="busJson" value='<?php echo $busJson; ?>'>
                            <div class="mb-3">
                                <label for="busno" class="form-label">Bus Number</label>
                                <!-- Search Functionality -->
                                <div class="searchBus">
                                    <input type="text" class="form-control  busnoInput" id="busno" name="busno" required>
                                    <div class="sugg">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="stepCost" class="form-label">Cost</label>
                                <input type="number" class="form-control" id="stepCost" name="stepCost" required>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Departure Date</label>
                                <input type="date" name="dep_date" id="date" min="<?php 
                                date_default_timezone_set("Asia/Kolkata");
                                echo date("Y-m-d");?>" value="
                                <?php 
                                echo date("Y-m-d");
                                ?>
                                " required>
                            </div>
                            <div class="mb-3">
                                <label for="time" class="form-label">Departure Time</label>
                                <input type="time" name="dep_time" id="time" min="
                                <?php
                                    echo date("H:i");
                                ?>
                                " required>
                            </div>
                            <button type="submit" class="btn btn-success" name="submit">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <!-- Add Anything -->
                    </div>
                    </div>
                </div>
        </div>
        
    <!-- External JS -->
    <script src="../assets/scripts/admin_routes.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>