<?php
require "dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prevent SQL injection using prepared statements
    $query = "SELECT * FROM signup WHERE email=? AND password=?";
    $stmt = mysqli_prepare($con, $query);
    if (!$stmt) {
        die("Error in prepared statement: " . mysqli_error($con)); // Check for query preparation error
    }
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die("Error in fetching result: " . mysqli_error($con)); // Check for query execution error
    }

    if (mysqli_num_rows($result) >= 1) {
        echo "<script> alert('sign in sueccsfully') </script>";
        require "home_Page.html";
    } else {
        echo "<script> alert('Invalid email or password') </script>";
        require "logIn.html";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>

 