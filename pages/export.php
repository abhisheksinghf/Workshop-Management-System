<?php  


error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../includes/connect.php";
require_once '../includes/session.php';


    // Check the connection
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>

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
                // Create a temporary CSV file on the server
                $csvFileName = "workshop_data.csv";
                $csvFilePath = $_SERVER['DOCUMENT_ROOT'] . '/WORKSHOP_UPDATE/register/main/registration/' . $csvFileName;
                // echo "$csvFilePath";
                $output = fopen($csvFilePath, 'w');

                // Write headers to the CSV file
                $header = array(
                    'Serial No.',
                    'Name',
                    'USN',
                    'Branch',
                    'Year',
                    'Division',
                    'Phone No',
                    'E-Mail',
                    'Laptop',
                    'Localite',
                    'Buses',
                    'Registration Date/Time'
                );
                fputcsv($output, $header);

                // Loop through the data and write to the CSV file
                $serialNumber = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    // Format 'Laptop' and 'Hostellite' values as 'Yes' or 'No'
                    // $row['laptop'] = $row['laptop'] ? 'Yes' : 'No';
                    // $row['hostellite'] = $row['hostellite'] ? 'Yes' : 'No';

                    // Create an array with the row data
                    $rowData = array(
                        $serialNumber,
                        $row['name'],
                        $row['usn'],
                        $row['branch'],
                        $row['years'],
                        $row['division'],
                        $row['phone_no'],
                        $row['email'],
                        $row['laptop'],
                        $row['localite'],
                        $row['native'],
                        $row['registration_date']
                    );

                    // Write the row to the CSV file
                    fputcsv($output, $rowData);

                    // Increment the serial number
                    $serialNumber++;
                }

                // Close the CSV file
                fclose($output);

                // Provide a download link for the user
                echo '<h2 style="color:green">Export Successfull ✅!!</h2>';
                echo '<a href="../registration/workshop_data.csv" download="">Click to Download Workshop Registration CSV File! ⬇️</a>';
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