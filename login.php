<?php 
session_start();
require_once "includes/connect.php";


if(isset($_POST["btnlogin"])) {
    $username = $_POST["user_name"];
    $password = $_POST["password"];
    
    $query = "SELECT * FROM login WHERE user_name='$username'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
        
        if (password_verify($password, $hashedPassword)) {
            if ($row["role"] == "admin") {
                $_SESSION['LoginAdmin'] = $row["user_name"];
                header('Location: pages/admin_dashboard.php');
                exit;
            }
        } else {
            echo "<script type=\"text/javascript\">alert('Incorrect Email or Password! Please Try Again');</script>";
            header("Location: login.php");
            exit;
        }
    } else {
        echo "<script type=\"text/javascript\">alert('User not found');</script>";
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <!-- SEO/Indexing -->
    <meta name="title" content="Admin Login">
    <meta name="description" content="Login Panel for active team members of QWERTY.IO">
    <meta name="keywords" content="sdmcetqwerty, sdmcet qwertyio, qwerty sdmcet">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="revisit-after" content="3 days">
    <meta name="author" content="QwertyIO">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" sizes="120x120" href="assets/images/qwertyio120120.jpg" />
    <link rel="icon" type="image/x-icon" sizes="152x152" href="assets/images/qwertyio152152.jpg" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <style>
        .gradient-custom {
            background: #631c9c;
        }

        body {
            background: #631c9c;
        }
    </style>
</head>
<body>
    <section class="vh-100 gradient-custom">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card bg-dark text-white">
                        <div class="card-body p-5 text-center">
                            <img src="assets/img/logo.png" alt="Logo" class="mb-4" style="max-height: 100px;">
                            <form method="POST" action="login.php">
                                <div class="form-group">
                                    <input type="text" name="user_name" placeholder="Username" class="form-control form-control-lg" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Password" class="form-control form-control-lg" />
                                </div>
                                <button name="btnlogin" class="btn btn-success btn-lg btn-block" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>
