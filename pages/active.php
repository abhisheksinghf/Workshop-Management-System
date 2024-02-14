<?php
// session_start();
// if (!$_SESSION["LoginAdmin"]) {
//     header('location: login.php');
// }
require_once "../includes/connect.php";
require_once '../includes/session.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $workshopId = $_POST["activeWorkshop1"];

    echo "<h2>Redirecting....</h2>";
}

// Retrieve workshop name based on the given ID
$getWorkshopNameQuery = "SELECT workshop_name FROM workshops WHERE id = $workshopId";
$workshopNameResult = mysqli_query($conn, $getWorkshopNameQuery);

if ($workshopNameResult && mysqli_num_rows($workshopNameResult) > 0) {
    $row = mysqli_fetch_assoc($workshopNameResult);
    $workshopName = $row['workshop_name'];
    // echo $workshopName;
    // Delete existing record (if any) from the active_workshop table
    $deleteQuery = "DELETE FROM active_workshop";
    mysqli_query($conn, $deleteQuery);

    // Insert the new active workshop into the active_workshop table
    $insertQuery = "INSERT INTO active_workshop (id, workshop_name) VALUES ($workshopId, '$workshopName')";
    $res = mysqli_query($conn, $insertQuery);

    if ($res) {
        echo "<script>alert('Active Workshop changed successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    echo "<script>";
    echo "window.location.href = 'admin_dashboard.php';";
    echo "</script>";
}
?>

<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Workshop Created</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Workshop has been created successfully!
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    // No need for the showSuccessModal function
</script>
