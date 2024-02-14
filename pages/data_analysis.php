<?php
// Include the database connection file
require_once "../includes/connect.php";
require_once '../includes/session.php';


if (isset($_GET['workshopId'])) {
    $workshopId = $_GET['workshopId'];

    $workshopNameQuery = "SELECT workshop_name FROM workshops WHERE id = $workshopId";
    $workshopNameResult = mysqli_query($conn, $workshopNameQuery);
    $workshopName = mysqli_fetch_array($workshopNameResult)['workshop_name'];
    // $tableName = strtolower(str_replace(' ', '', $workshopName)) . '_workshop';
    // $tableName = "Javascript_Workshop";

    echo "<h5 style='background-color:grey;color:white;text-align:center;text-transform:uppercase;'>".$workshopName."</h5>";

    // Calculate Total Registrations from Each Branch
    $totalBranchRegistrationsQuery = "SELECT branch, COUNT(*) AS branch_count FROM $workshopName WHERE workshop_id = $workshopId GROUP BY branch";
    $totalBranchRegistrationsResult = mysqli_query($conn, $totalBranchRegistrationsQuery);
    $branchRegistrations = array();

    while ($row = mysqli_fetch_assoc($totalBranchRegistrationsResult)) {
        $branchRegistrations[$row['branch']] = $row['branch_count'];
    }

    // Output the data analysis results as HTML content
    echo '<h2>Branch Analysis</h2>';
    echo '<table class="display">';
    echo '<tr><th>Branch</th><th>Registration Count</th></tr>';
    
    foreach ($branchRegistrations as $branch => $count) {
        echo '<tr>';
        echo '<td>' . $branch . '</td>';
        echo '<td>' . $count . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
} 

else {
    echo "Workshop ID not provided.";
}
$totalYearRegistrationsQuery = "SELECT years, COUNT(*) AS year_count FROM $workshopName WHERE workshop_id = $workshopId GROUP BY years";
    $totalYearRegistrationsResult = mysqli_query($conn, $totalYearRegistrationsQuery);
    $yearRegistrations = array();

    while ($row = mysqli_fetch_assoc($totalYearRegistrationsResult)) {
        $yearRegistrations[$row['years']] = $row['year_count'];
    }

    // Output the data analysis results as HTML content
    echo '<h2>Year Analysis</h2>';
    echo '<table>';
    echo '<tr><th>Year</th><th>Registration Count</th></tr>';
    
    foreach ($yearRegistrations as $year => $count) {
        echo '<tr>';
        echo '<td>' . $year . '</td>';
        echo '<td>' . $count . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';

    $totalHostellitesQuery = "SELECT COUNT(*) AS hostellite_count FROM $workshopName WHERE workshop_id = $workshopId AND localite = 'yes'";
    $totalHostellitesResult = mysqli_query($conn, $totalHostellitesQuery);
    $totalHostellites = mysqli_fetch_array($totalHostellitesResult)['hostellite_count'];

    // Calculate Total Locals
    $totalLocalsQuery = "SELECT COUNT(*) AS local_count FROM $workshopName WHERE workshop_id = $workshopId AND localite != 'yes'";
    $totalLocalsResult = mysqli_query($conn, $totalLocalsQuery);
    $totalLocals = mysqli_fetch_array($totalLocalsResult)['local_count'];

    // Output the data analysis results as HTML content
    echo '<h2>Hostellite/Localite Analysis</h2>';
    echo '<table>';
    echo '<tr><th>Category</th><th>Count</th></tr>';
    
    echo '<tr>';
    echo '<td>Locals</td>';
    echo '<td>' . $totalHostellites . '</td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<td>Hostellites</td>';
    echo '<td>' . $totalLocals . '</td>';
    echo '</tr>';
    
    echo '</table>';
    
    
    
    
    
    $totalHubliBusQuery = "SELECT COUNT(*) AS hublibus_count FROM $workshopName WHERE workshop_id = $workshopId AND native = 'hubli'";
    $totalHubliBusResult = mysqli_query($conn, $totalHubliBusQuery);
    $totalHubliBus = mysqli_fetch_array($totalHubliBusResult)['hublibus_count'];

    // Calculate Total Locals
    $totalDharwadBusQuery = "SELECT COUNT(*) AS dharwadbus_count FROM $workshopName WHERE workshop_id = $workshopId AND native = 'dharwad'";
    $totalDharwadBusResult = mysqli_query($conn, $totalDharwadBusQuery);
    $totalDharwadBus = mysqli_fetch_array($totalDharwadBusResult)['dharwadbus_count'];

    // Output the data analysis results as HTML content
    echo '<h2>Bus Requirement Analysis</h2>';
    echo '<table>';
    echo '<tr><th>Category</th><th>Count</th></tr>';
    
    echo '<tr>';
    echo '<td>Hubli</td>';
    echo '<td>' . $totalHubliBus . '</td>';
    echo '</tr>';
    
    echo '<tr>';
    echo '<td>Dharwad</td>';
    echo '<td>' . $totalDharwadBus . '</td>';
    echo '</tr>';
    
    echo '</table>';
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    $peopleWithoutLaptopQuery = "SELECT COUNT(*) AS laptop_unavailable_count FROM $workshopName WHERE workshop_id = $workshopId AND laptop = 'no'";
    $peopleWithoutLaptopResult = mysqli_query($conn, $peopleWithoutLaptopQuery);
    $peopleWithoutLaptop = mysqli_fetch_array($peopleWithoutLaptopResult)['laptop_unavailable_count'];

    // Output the data analysis results as HTML content
    echo '<h2>Laptop Analysis</h2>';
    echo '<table>';
    echo '<tr><th>Category</th><th>Count</th></tr>';
    
    echo '<tr>';
    echo '<td>People Who Cannot Bring Laptop</td>';
    echo '<td>' . $peopleWithoutLaptop . '</td>';
    echo '</tr>';
    
    echo '</table>';


// Close the database connection if needed (not necessary for this script)
mysqli_close($conn);
?>
