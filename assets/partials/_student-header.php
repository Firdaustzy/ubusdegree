<?php

    require '_functions.php';
    $conn = db_connect();

    // Getting user details
    $user_id = $_SESSION['userstudent_id'];
    $sql = "SELECT * FROM userstudent WHERE userstudent_id = $user_id";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result))
    {
        $user_fullname1 = $row["userstudent_fullname"];
        $user_name1 = $row["userstudent_name"];
    }
?>

<!-- <header>
        <nav id="navbar">
            <ul>
                <li class="nav-item">
                    <?php 
                        echo $user_name;
                    ?>
                </li>
                <li class="nav-item">
                    <img class="adminDp" src="../assets/img/admin_pic.jpg" alt="Admin Profile Pic" width="22px" height="22px">
                </li>
            </ul>
        </nav>
    </header> -->
    <main id="container">
        <div id="sidebar">
            <h4><i class="fas fa-bus"></i> U-BUS </h4>
            <div>
                <img class="adminDp" src="../assets/img/userav-min.png" height="125px" alt="Admin Profile Pic">
                <p>
                    <?php  echo '@'.$user_name1;  ?>
                </p>
                <p>Unisel Students</p>
            </div>
            <ul id="options">
                <li class="option <?php if($page=='dashboard'){ echo 'active';}?>"> 
                    <a href="./dashboard.php">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                
               
                <li class="option <?php if($page=='bus'){ echo 'active';}?>">
                    <a href="./busstudent.php">
                    <i class="fas fa-bus"></i> Buses
                    </a>
                </li>
                <li class="option <?php if($page=='route'){ echo 'active';}?>">
                    <a href="./routestudent.php">
                    <i class="fas fa-road"></i> Routes    
                    </a>
                </li>
                
                <li class="option <?php if($page=='customer'){ echo 'active';}?>">
                    <a href="./customerstudent.php">
                    <i class="fas fa-users"></i> Customers
                    </a>
                </li>
                <li class="option <?php if($page=='booking'){ echo 'active';}?>">
                    <a href="./bookingstudent.php">
                    <i class="fas fa-ticket-alt"></i> Bookings
                    </a>
                </li>
                <li class="option <?php if($page=='seat'){ echo 'active';}?>">
                    <a href="./seatstudent.php">
                    <i class="fas fa-th"></i> Seats
                    </a>
                </li>
                
            </ul>
        </div>
        <div id="main-content">
            <section id="welcome">
                <ul>
                    <li class="welcome-item">Welcome to U-Bus Offical Website, 
                        <span id="USER">
                            <?php 
                                echo $user_fullname1;
                            ?>
                        </span>
                    </li>
                    <li class="welcome-item">
                        <button id="logout" class="btn-sm">
                            <a href="../assets/partials/_logout.php">LOGOUT</a>
                        </button>
                    </li>
                </ul>
            </section>