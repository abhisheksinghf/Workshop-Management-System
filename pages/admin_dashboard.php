<?php  

    require_once "../includes/connect.php";
    require_once '../includes/session.php';
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
        }

        header h1 {
            margin: 0;
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
        header a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #fff;
            border-radius: 4px;
            height: 36px;
        }

        header a:hover {
            background-color: #fff;
            color: #333;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        /* Workshop Card Styles */
        .workshop-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin: 10px 0;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .workshop-card h3 {
            color: #333;
            font-size: 20px;
            margin-top: 0;
        }

        .workshop-card p {
            color: #777;
            font-size: 14px;
            margin: 5px 0;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            main {
                padding: 10px;
            }

            .workshop-card {
                padding: 10px;
            }
        }
        .search-container {
            margin-top: 20px;
            text-align: center;
        }

        input[type="text"] {
            width: 60%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #333;
        }

        .search-button {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .search-button:hover {
            background-color: #444;
        }
        @keyframes blink {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0;
        }
    }
    </style>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
        <a href="../logout.php">Logout</a>
    </header>
    <main>
    <h3>WORKSHOPS</h3>
    <div class="search-container">
            <input type="text" id="workshop-search" placeholder="Search workshops...">
            <button class="btn btn-success" onclick="searchWorkshops()">Search</button>
        </div>

        <!-- Button to trigger modal -->
        <button class="btn btn-primary" style="margin:10px;" data-toggle="modal" data-target="#newWorkshopModal">NEW WORKSHOP</button>



        <!-- Button to trigger modal for changing active workshop -->
        <button class="btn btn-danger" data-toggle="modal" data-target="#changeActiveWorkshopModal">Change Active Workshop</button>

        <!-- Modal for Changing Active Workshop -->
        <div class="modal fade" id="changeActiveWorkshopModal" tabindex="-1" role="dialog" aria-labelledby="changeActiveWorkshopModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changeActiveWorkshopModalLabel">Change Active Workshop</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="changeActiveWorkshopForm" action="active.php" method="POST">
                            <div class="form-group">
                                <label for="activeWorkshop">Select Active Workshop</label>
                                <select class="form-control" id="activeWorkshop" name="activeWorkshop1">
                                    <?php
                                    // Fetch all workshops from the database
                                    $workshopsQuery = "SELECT * FROM `workshops`";
                                    $workshopsResult = mysqli_query($conn, $workshopsQuery);

                                    if ($workshopsResult && mysqli_num_rows($workshopsResult) > 0) {
                                        while ($workshopRow = mysqli_fetch_assoc($workshopsResult)) {
                                            $workshopId = $workshopRow["id"];
                                            $workshopName = $workshopRow["workshop_name"];
                                            echo '<option name="selectedWorkshopId" value="' . $workshopId . '">' . $workshopName . '</option>';
                                        }
                                    } else {
                                        echo '<option value="" disabled>No workshops found</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="actie">
        <?php
        $getWorkshopName = "SELECT workshop_name FROM active_workshop";
        $workshopNameOp = mysqli_query($conn, $getWorkshopName);

        if ($workshopNameOp && mysqli_num_rows($workshopNameOp) > 0) {
        $row = mysqli_fetch_assoc($workshopNameOp);
        $workshopName = $row['workshop_name'];
        echo "<h3 style='text-align:center; margin:25px; color:red;animation: blink 1s infinite;'>Active :  <strong>$workshopName</strong></h3>";
        }
        ?>
</div>
        <!-- Workshop Cards -->
    <?php

        // require_once "qwerty_dbconnect.php";

        $sql = "SELECT * FROM `workshops`";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $workshopId = $row["id"];
            $workshopName = $row["workshop_name"];
            $workshopDate = $row["workshop_date"];
            $workshopLocation = $row["workshop_location"];

            // Generate HTML for the workshop card
            echo '<a href="display?workshopId=' . $workshopId . '">';
            echo '<div class="workshop-card">';
            echo '<h3>' . $workshopName . '</h3>';
            echo '<p>ID: ' . $workshopId . '</p>';
            echo '<p>Date: ' . $workshopDate . '</p>';
            echo '<p>Location: ' . $workshopLocation . '</p>';
            // You can add more details here
            echo '</div>';
            echo '</a>';
        }
    } else {
        echo "No workshops found.";
    }
?>
        <!-- Add more workshop cards as needed -->

        <!-- Modal for New Workshop -->
        <div class="modal fade" id="newWorkshopModal" tabindex="-1" role="dialog" aria-labelledby="newWorkshopModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newWorkshopModalLabel">New Workshop Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="newWorkshopForm" action="admin_dashboard.php" method="POST">
<?php
                        $randomWorkshopID = rand(1000, 9999);

echo '<div class="form-group">';
echo '<label for="workshopID">Workshop ID</label>';
echo '<input type="text" class="form-control" id="workshopID" name="workshopID" value="' . $randomWorkshopID . '" readonly>';
echo '</div>';
?>
                            <div class="form-group">
                                <label for="workshopName">Workshop Name</label>
                                <input type="text" class="form-control" id="workshopName" name="workshopName" required>
                            </div>
                            <div class="form-group">
                                <label for="workshopDate">Workshop Date</label>
                                <input type="date" class="form-control" id="workshopDate" name="workshopDate" required>
                            </div>
                            <div class="form-group">
                                <label for="workshopLocation">Workshop Location</label>
                                <input type="text" class="form-control" id="workshopLocation" name="workshopLocation" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Workshop</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // JavaScript function for workshop search
        function searchWorkshops() {
            var input, filter, workshopCards, workshop, title, i;
            input = document.getElementById("workshop-search");
            filter = input.value.toUpperCase();
            workshopCards = document.querySelectorAll(".workshop-card");

            for (i = 0; i < workshopCards.length; i++) {
                workshop = workshopCards[i];
                title = workshop.querySelector("h3");

                if (title.innerText.toUpperCase().indexOf(filter) > -1) {
                    workshop.style.display = "";
                } else {
                    workshop.style.display = "none";
                }
            }
        }
        function showSuccessModal() {
            $("#successModal").modal("show");
        }
    </script>
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

</body>
<?php
// require_once "co.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $wid = $_POST["workshopID"];
    $wname = $_POST["workshopName"];
    $wdate = $_POST["workshopDate"];
    $wloc = $_POST["workshopLocation"];
    
    $newName = str_replace(' ', '', ucwords($wname)) . '_Workshop';

    // SQL query to insert the new workshop
    $sql = "INSERT INTO `workshops`(`id`, `workshop_name`, `workshop_date`, `workshop_location`) VALUES ('$wid','$newName','$wdate','$wloc')";
    
    // Prepare the statement
    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo "<script>showSuccessModal();</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    $sql2 = "CREATE TABLE $newName (
        slNo INT AUTO_INCREMENT,
        workshop_id INT,
        email VARCHAR(50),
        usn VARCHAR(20),
        name VARCHAR(50),
        branch VARCHAR(50),
        years VARCHAR(6),
        division VARCHAR(10),
        phone_no VARCHAR(15),
        laptop VARCHAR(3),
        localite VARCHAR(3),
        native VARCHAR(3),
        registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (email, usn),
        UNIQUE KEY (slNo)
    );";
    
    $result2 = mysqli_query($conn, $sql2);
    
    if(!$result2)
    {
      echo "hdeh";
    }
    // Close the database connection
    mysqli_close($conn);
}
?>
<script>
    // Add event listener to the form submit
    document.getElementById("changeActiveWorkshopForm").addEventListener("submit", function(event) {
        // Prevent the form from submitting normally
        event.preventDefault();
        
        // Show confirmation dialog
        if (confirm("Are you sure you want to change the active workshop?")) {
            // If user confirms, show another confirmation dialog
            if (confirm("Are you absolutely sure?")) {
                // If user confirms again, submit the form
                this.submit();
            }
        }
    });
</script>
<footer>
    <p>&copy; Developed by Abhisheksingh | Team QWERTY.IO</p>
</footer>
</html>
