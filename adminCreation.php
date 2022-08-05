<!-- IMPORTANT!!! THIS PAGE CAN NOT BE ACCESSED IN ANYWAY FROM THE WEBSITE, IT IS PURELY TO SET UP AN ADMIN ACCOUNT AND USE THE SYSTEM -->
<!DOCTYPE html>
<html>
<head>
<title>Admin Creation</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amatic+SC">
<style>
body, html {height: 100%}
body,h1,h2,h3,h4,h5,h6 {font-family: "Amatic SC", sans-serif}
.menu {display: none}

</style>
</head>
<body>
<?php
// starts a session
session_start();

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters to be bound
            $param_username = trim($_POST["username"]);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // store the result of the excuting statement
                mysqli_stmt_store_result($stmt);
                // checks if the username already exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken. Please try another";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement, inserts the information into the adminaccount table in the database
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters to be bound
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to HOME page once account has been created
                header("location: adminLogin.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!-- ADMIN Navbar (sit on top) -->
<div class="w3-top w3-hide-small">
  <div class="w3-bar w3-xlarge w3-black w3-opacity w3-hover-opacity-off" id="myNavbar">
    <a href="AdminHome.html" class="w3-bar-item w3-button">HOME</a>
    <a href="index.html" class="w3-bar-item w3-button">MENU</a>
    <a href="BusinessStatistics.html" class="w3-bar-item w3-button">STATS</a>
    <a href="ChefCreation.html" class="w3-bar-item w3-button">Chef creation</a>
    <a href="ViewOrdersAdmin.html" class="w3-bar-item w3-button">View Orders</a>
    <a href="MenuCreation.html" class="w3-bar-item w3-button">Menu creation</a>
    <a href="logout.html" class="w3-bar-item w3-button">Logout</a>
  </div>
</div>
<!-- Main class -->
<div class="w3-container w3-padding-64 w3-blue-grey w3-grayscale-min w3-xlarge">
  <div class="w3-content">
  <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">Express-Taurant</h1>
    <h2 class="w3-center w3-text-white" style="margin-bottom:64px">Admin Creation Form</h2>
    <p>Please Enter a username and Password to create a new admin.</p>
    <!-- Input form to add admin to the database -->
    <form action="<?php
echo htmlspecialchars($_SERVER["PHP_SELF"]);
?>" method="post">
        <!-- input box for username -->
      <p><input class="w3-input w3-padding-16 w3-border" type="text" auto_complete="no" placeholder="username" required name="username"></p>
      <?php
        // display appropriate error message
                echo (! empty($username_err)) ? 'is-invalid' : '';
                ?>
                <span class="invalid-feedback"><?php

                echo $username_err;
                ?></span>

        <!-- Input box for password -->
      <p><input class="w3-input w3-padding-16 w3-border" type="password" auto_complete="no" placeholder="Password" required name="password"></p>
      <?php
        // display appropriate error message
                echo (! empty($password_err)) ? 'is-invalid' : '';
                ?>
                <span class="invalid-feedback"><?php

                echo $password_err;
                ?></span>
        <!-- Input box for password -->
      <p><input class="w3-input w3-padding-16 w3-border" type="password" auto_complete="no" placeholder="Re-enter Password" required name="confirm_password"></p>
      <?php
      // display appropriate error message
      echo (! empty($confirm_password_err)) ? 'is-invalid' : '';
                ?>
                <span class="invalid-feedback"><?php

                echo $confirm_password_err;
                ?></span>
        <!-- Create data or reset form -->
      <p><button class="w3-button w3-light-grey w3-block" type="submit">Create</button></p>
      <p><button class="w3-button w3-light-grey w3-block" type="reset">Reset data</button></p>
    </form>
  </div>
</div>

</body>
</html>