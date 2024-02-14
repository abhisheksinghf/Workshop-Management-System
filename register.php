<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" sizes="120x120" href="assets/img/qwertyio120120.jpg" />
    <link rel="icon" type="image/x-icon" sizes="152x152" href="assets/img/qwertyio152152.jpg" />
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #4158D0;
            background-image: linear-gradient(43deg, #4158D0 0%, #C850C0 46%, #FFCC70 100%);
        }
        .container {
            background-image: url(bg-3.png);
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 30px;
            position: relative; /* Needed for logo positioning */
        }
        .logo {
            position: absolute;
            top: 30px; /* Adjust as needed */
            right: 30px; /* Adjust as needed */
            max-width: 40px;
        }
        h4 {
            text-align: center;
            margin-bottom: 30px;
            color: purple;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .required {
            color: red;
        }
        label {
            font-weight: bold;
            color: #333;
        }
        .form-control {
            background-color: #f2f2f2;
        }
        .btn-primary {
            font-size: 1.3em;
            background-color: #a92a9f;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        /* Radio button styles */
        .radio {
            &-input {
                visibility: hidden;
            }

            &-label {
                position: relative;
                padding-left: 35px;
                &:after {
                    content: "";
                    display: block;
                    width: 12px;
                    height: 12px;
                    position: absolute;
                    left: 4px;
                    top: 4px;
                    border-radius: 50%;
                }
            }

            &-border {
                width: 20px;
                height: 20px;
                display: inline-block;
                outline: solid 3px #d449e3;
                border-radius: 50%;
                position: absolute;
                left: 0px;
                top: 0px;
            }

            &-input:checked + &-label:after {
                transition: all 0.5s;
                background-color: #64236b;
            }
        }

        /* Additional question CSS */
        .hidden-question {
            display: none;
        }

        .rights {
            padding: 10px;
            text-align: center;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo beside the title -->
        <h4>
            <img src="" alt="" class="logo">Registration Form 📝
        </h4>
        <hr>
        <form action="pages/process.php" method="post">
            <input type="hidden" name="workshop_id" value="1234">
            <div class="form-group">
                <label for="name">Name <span class="required">*</span></label>
                <input type="text" class="form-control" placeholder="Enter your name" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" class="form-control" placeholder="Enter your email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone No <span class="required">*</span></label>
                <input type="tel" class="form-control" placeholder="Enter your phone number" id="phone" name="phone_no" required>
            </div>
            <div class="form-group">
                <label for="usn">USN <span class="required">*</span></label>
                <input type="text" class="form-control" placeholder="Enter your USN" id="usn" name="usn" required>
            </div>
            
            <div class="form-group">
                <label for="branch">Choose Branch <span class="required">*</span></label>
                <select class="form-control" id="branch" name="branch" required>
                    <option value="">Select one</option>
                    <option value="Artificial Intelligence & Machine Learning">Artificial Intelligence & Machine Learning</option>
                    <option value="Computer Science & Engineering">Computer Science & Engineering</option>
                    <option value="Information Science & Engineering">Information Science & Engineering</option>
                    <option value="Electrical & Communication Engineering">Electronics & Communication Engineering</option>
                    <option value="Electrical & Electronics Engineering">Electrical & Electronics Engineering</option>
                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                    <option value="Chemical Engineering">Chemical Engineering</option>
                    <option value="Civil Engineering">Civil Engineering</option>
                </select>
            </div>
            <div class="form-group">
                <label for="year">Choose Year <span class="required">*</span></label>
                <select class="form-control" id="year" name="year" required>
                    <option value="">Select one</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                </select>
            </div>
            <div class="form-group">
                <label for="division">Division <span class="required">*</span></label>
                <input type="text" class="form-control" placeholder="Enter your division" id="division" name="div" required>
            </div>
            <div class="form-group">
                <label for="laptop">Can you bring a laptop? <span class="required">*</span></label><br>
                <input type=radio id="laptop-yes" class="radio-input" name="laptop" value="yes" required>
                <label for="laptop-yes" class="radio-label"><span class="radio-border"></span>Yes</label>

                <input type=radio id="laptop-no" class="radio-input" name="laptop" value="no" required>
                <label for="laptop-no" class="radio-label"><span class="radio-border"></span>No</label>
            </div>
            <div class="form-group">
                <label for="localite">Are you Localite? <span class="required">*</span></label><br>
                <input type=radio id="localite-yes" class="radio-input" name="localite" value="yes">
                <label for="localite-yes" class="radio-label"><span class="radio-border"></span>Yes</label>

                <input type=radio id="localite-no" class="radio-input" name="localite" value="no">
                <label for="localite-no" class="radio-label"><span class="radio-border"></span>No</label>
            </div>

            <!-- Additional question that appears when "Yes" is selected -->
            <div class="form-group hidden-question" id="additional-question">
                <label>Bus Facility ?</label><br>
                <input type=radio id="yes" class="radio-input" name="native" value="Yes">
                <label for="yes" class="radio-label"><span class="radio-border"></span>Yes</label>

                <input type=radio id="no" class="radio-input" name="native" value="No">
                <label for="no" class="radio-label"><span class="radio-border"></span>No</label><!--
                
                <input type=radio id="unrequired" class="radio-input" name="native" value="Unrequired">
                <label for="unrequired" class="radio-label"><span class="radio-border"></span>Not Required</label>-->
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

            <!-- Thank you GIF placeholder -->
            <div class="text-center mt-3">
                <br /><br />
                <span>Forms Developed and Maintained By Team QWERTY.IO</span>
                <!--<img src="thankyou.gif" alt="Thank You GIF" style="max-width: 200px;">-->
            </div>
        </form>
    </div>
    <div class="rights">
        <p>&#169; 2023 | All rights reserved.</p>
    </div>

    <script>
        // Add event listener to the "Are you Localite?" radio buttons
        const localiteYes = document.getElementById("localite-yes");
        const additionalQuestion = document.getElementById("additional-question");

        localiteYes.addEventListener("change", function () {
            if (this.checked) {
                additionalQuestion.style.display = "block";
            } else {
                additionalQuestion.style.display = "none";
            }
        });

        const localiteNo = document.getElementById("localite-no");
        const additionalQuestion1 = document.getElementById("additional-question");

        localiteNo.addEventListener("change", function () {
            if (this.checked) {
                additionalQuestion1.style.display = "none";
                document.getElementById("yes").checked = false;
                document.getElementById("no").checked = false;
                // document.getElementById("unrequired").checked = false;
            } else {
                additionalQuestion1.style.display = "block";
            }
        });
        function validateName() {
            const nameField = document.getElementById("name");
            const name = nameField.value;
    
            if (/\d/.test(name)) {
                alert("Name should not contain numbers.");
                nameField.value = ""; // Clear the field
            }
        }
    
        // Function to validate the division field
        function validateDivision() {
            const divisionField = document.getElementById("division");
            const division = divisionField.value;
    
            if (!/^[A-Za-z]$/.test(division)) {
                alert("Division should contain a single alphabet character.");
                divisionField.value = ""; // Clear the field
            }
        }
    
        // Function to validate the phone number field
        function validatePhoneNumber() {
            const phoneField = document.getElementById("phone");
            const phoneNumber = phoneField.value;
    
            if (!/^\d{10}$/.test(phoneNumber)) {
                alert("Phone number should be 10 digits long.");
                phoneField.value = ""; // Clear the field
            }
        }
    
        // Add event listeners to call the validation functions on change
        document.getElementById("name").addEventListener("change", validateName);
        document.getElementById("division").addEventListener("change", validateDivision);
        document.getElementById("phone").addEventListener("change", validatePhoneNumber);
    
    </script>
    <!-- Link to Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>