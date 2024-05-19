
<?php
require "dbcon.php";

// Check if the form is submitted
if(isset($_POST['f_name']) && isset($_POST['l_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['weight']) && isset($_POST['height']) && isset($_POST['pnum'])) {
    $firstname = $_POST['f_name'];
    $lastname = $_POST['l_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $phonenum = $_POST['pnum'];

    // SQL query to check if email exists
    $sql = "select * FROM signup WHERE email='$email'";
    $res = mysqli_query($con, $sql) or die(mysqli_error($con));
    
    if (mysqli_num_rows($res) >= 1) {  
        echo "<script> alert('Email already exists') </script>";
        require "Register_page_1.html";
    } else {
        // SQL query to insert data
        $insert_sql = "INSERT INTO signup (first_name, last_name, password, email, weight, height, phone) VALUES ('$firstname', '$lastname', '$password', '$email', '$weight', '$height', '$phonenum')";
        // echo "SQL Query: " . $insert_sql . "<br>"; // Debugging output
        if (mysqli_query($con, $insert_sql)) {
            echo "<script>alert('Signed up successfully')</script>";
            require "login.html";      
            exit();
        } 
    }
}
mysqli_close($con); 
?>
