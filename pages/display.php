<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// session_start();
// if (!$_SESSION["LoginAdmin"])
// {
/*      echo '<script type="text/javascript">';
echo 'window.location.href = "login.php";';
echo '</script>';*/
//      header('location: login.php');
//  }
require_once "../includes/connect.php";
require_once '../includes/session.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Com
    patible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* Style for the export button */
        .export-button {
            background-color: #28a745; /* Green color */
            color: #fff; /* White text */
        }

        footer{
            height: 80px;
            color: white;
            background-color: #333;
            text-align: center;
        }

        footer p{
            padding: 25px;
        }
        /* Style for the workshop title */
        .workshop-title {
            text-align: center;
            color: red;
            font-size: 30px;
            font-weight:bold;
            margin-top: 20px;
        }

        /* Style for the buttons */
        .button-container {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }
                /* Style for the table */
                table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #575c58; /* Light gray background for table headers */
            color:white;
        }

        /* Alternate row colors */
        tr:nth-child(even) {
            background-color: #f2f2f2; /* Grey background for even rows */
        }

        tr:nth-child(odd) {
            background-color: #fff; /* White background for odd rows */
        }

    </style>
</head>
<body>
<?php

// Initialize the workshopId variable
$workshopId = null;

// Check if the workshop ID is provided in the URL
if (isset($_GET['workshopId'])) {
    $workshopId = $_GET['workshopId'];

    // Query to fetch the workshop name based on the workshop ID
    $workshopNameQuery = "SELECT workshop_name FROM workshops WHERE id = $workshopId";
    $resultName = mysqli_query($conn, $workshopNameQuery);

    // Check if the query was successful
    if ($resultName) {
        // Fetch the workshop name
        $rowName = mysqli_fetch_assoc($resultName);
        $workshopName = $rowName['workshop_name'];

        // Query to fetch workshop details based on the workshop ID
        $sql = "SELECT * FROM $workshopName WHERE workshop_id = $workshopId";

        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if ($result) {
            // Check if there are registrations for the workshop
            if (mysqli_num_rows($result) > 0) {
                // Display workshop details in a table
                echo '<h2 class="workshop-title" style="margin:20px;">' . strtoupper($workshopName) . ' ' . '</h2>';
                ?>
                <div class="button-container">
                    <button class="btn btn-primary" id="dataAnalysisButton">Data Analysis</button>
                    <a href="export.php?workshopId=<?php echo $workshopId; ?>">
                        <button class="btn export-button">Export</button>
                    </a>
                </div>
                <table id="workshopTable" class="display">
                    <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>USN</th>
                        <th>Branch</th>
                        <th>Year</th>
                        <th>Division</th>
                        <th>Phone No</th>
                        <th>Email</th>
                        <th>Laptop</th>
                        <th>Localite</th>
                        <th>Bus Facility</th>
                        <th>Registration Date/Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $serialNumber = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $serialNumber . '</td>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['usn'] . '</td>';
                        echo '<td>' . $row['branch'] . '</td>';
                        echo '<td>' . $row['years'] . '</td>';
                        echo '<td>' . $row['division'] . '</td>';
                        echo '<td>' . $row['phone_no'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['laptop'] . '</td>';
                        echo '<td>' . $row['localite'] . '</td>';
                        echo '<td>' . $row['native'] . '</td>';
                        echo '<td>' . $row['registration_date'] . '</td>';
                        echo '</tr>';
                        $serialNumber++;
                    }
                    ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo "No registrations found for the selected workshop.";
            }
        } else {
            echo "Error fetching workshop details: " . mysqli_error($conn);
        }
    } else {
        echo "Error fetching workshop name: " . mysqli_error($conn);
    }
} else {
    echo "Workshop ID not provided in the URL.";
}

// Close the database connection here
mysqli_close($conn);
?>

<!-- Data Analysis Modal -->
<div id="dataAnalysisModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="dataAnalysisModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataAnalysisModalLabel">Data Analysis Results</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="dataAnalysisContent">
                <!-- Data analysis results will be displayed here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Initialize DataTable
    $(document).ready(function () {
        $('#workshopTable').DataTable();
    });

    // Add a click event listener to the "Data Analysis" button
    $(document).on('click', '#dataAnalysisButton', function () {
        // AJAX request to fetch the data analysis results from your PHP script
        var workshopId = <?php echo $workshopId; ?>; // Get the workshop ID from PHP
        $.ajax({
            url: 'data_analysis.php',
            type: 'GET',
            data: {workshopId: workshopId},
            success: function (response) {
                // Update the pop-up content with the fetched data
                $('#dataAnalysisContent').html(response);
                // Show the pop-up
                $('#dataAnalysisModal').modal('show');
            }
        });
    });
</script>
</body>
<footer>
    <p>&copy; Developed by Abhisheksingh | Team QWERTY.IO</p>
</footer>
</html>
