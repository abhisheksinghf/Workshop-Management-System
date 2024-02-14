<?php
// Include database connection code here if not already included
require_once "../includes/connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    // $workshop_id = $_POST["workshop_id"];
    $email = $_POST["email"];
    $usn = $_POST["usn"];

    // Initialize $dynamicTableName
    $getWorkshopDetails = "SELECT * FROM active_workshop";
    $workshopDetailsOp = mysqli_query($conn, $getWorkshopDetails);

    if ($workshopDetailsOp && mysqli_num_rows($workshopDetailsOp) > 0) {
        $row = mysqli_fetch_assoc($workshopDetailsOp);
        $workshopId = $row['id'];
        $workshopName = $row['workshop_name'];

        // $dynamicTableName = str_replace(' ', '', ucfirst($workshopName)).'_Workshop';
        // echo $dynamicTableName;
        // Check if the combination of email and usn already exists
        $checkQuery = "SELECT COUNT(*) as count FROM `$workshopName` WHERE email = '$email' OR usn = '$usn'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if ($checkResult) {
            $count = mysqli_fetch_assoc($checkResult)['count'];

            if ($count > 0) {
                // The combination of email and usn already exists
                echo '<script>alert("Email/USN Already Registered!")</script>';
                echo "<script>";
                echo "window.location.href = 'registration/register.php';";
                echo "</script>";
            } else {
                // Continue with the registration process
                $name = $_POST["name"];
                $email = $_POST["email"];
                $branch = $_POST["branch"];
                $year = $_POST["year"];
                $div = $_POST["div"];
                $phone_no = $_POST["phone_no"];
                $laptop = $_POST["laptop"];
                $localite = $_POST["localite"];
                $native = $_POST["native"];

               
                $query = "INSERT INTO $workshopName(`workshop_id`, `email`, `name`, `usn`, `branch`, `years`, `division`, `phone_no`, `laptop`, `localite`, `native`) VALUES ('$workshopId', '$email', '$name', '$usn', '$branch', '$year', '$div', '$phone_no', '$laptop', '$localite', '$native')";

    // Execute the query
                $result = mysqli_query($conn, $query); // Assuming you're using MySQLi
                if ($result) {
                    // echo "registration success"; 
                    echo "<script>";
                echo "window.location.href = 'success.html';";
                echo "</script>";
                    // header("Location: registration/front/success.html"); 
                } else {
                    // Registration failed, you can display an error message
                    echo "Registration failed. Please try again.";
                }
            }
        } else {
            // Query to check existing records failed
            echo "Error checking existing records. Please try again.";
        }
    }
}
?>