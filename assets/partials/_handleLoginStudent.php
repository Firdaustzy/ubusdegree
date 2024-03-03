<?php
    require '_functions.php';
    $conn = db_connect();

    if(!$conn)
        die("Oh Shoot!! Connection Failed");

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM `userstudent` WHERE userstudent_name='$username';";
        $result = mysqli_query($conn, $sql);

        if($row = mysqli_fetch_assoc($result)){
            $hash = $row['userstudent_password'];
            if(password_verify($password, $hash))
            {
                // Login Sucessfull
                session_start();
                $_SESSION["loggedIn"] = true;
                $_SESSION["userstudent_id"] = $row["userstudent_id"];

                header("location: ../../student/dashboardstudent.php");
                exit;
            }
            
            // Login failure
            $error = true;
            header("location: index.php?error=$error");
        }
    }
?>