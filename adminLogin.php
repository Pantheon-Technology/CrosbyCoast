<!DOCTYPE html>
<html>
<head>
<title>Crosby Coast Forum - Admin Login</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="index.css">
<?php 
session_start();

// Check if the user is already logged in, if yes then redirect them to account
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: adminHomePage.php");
    exit();
}
include_once "config.php"; 

$username = $password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if(empty(trim($_POST["username"]))){
    $$error = "Please enter your Username";
  }else{
    $username = trim($_POST["username"]);
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
    $error = "Please enter your password";
  }else{
    $password = trim($_POST["password"]);
  }

  if(empty($error)){
    $sql = "SELECT id, username, `password` FROM users WHERE username = ?";

    if ($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        $param_username = $username;

        if (mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);
          if (mysqli_stmt_num_rows($stmt) == 1) {
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($password, $hashed_password)) {
                    // the password matches the username, start a new session
                    session_start();

                    // Store data about the current session in variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["UserID"] = $id;
                    $_SESSION["username"] = $username;

                    // Redirect user to my main web page
                    header("location: adminHomePage.php");
                } else {
                    // Password is not valid, display a generic error message
                    $error = "Invalid password.";
                }
            }
        } else {
            // Username doesn't exist, display a generic error message
            $error = "Invalid username";
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
}
  }

// Close connection
mysqli_close($conn);
}
?>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
</head>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-teal w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">Crosby Coastal Park Forum - Admin Login</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:250px;" id="mySidebar"><br>
  <div class="w3-container">
      <img src="Pictures/AnotherPlace.jpg" style="width:220px">
    </div>
    <h5>Menu</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="index.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-history fa-fw"></i> Return</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->

<div class="w3-main" style="margin-left:250px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h1 class ="w3-animate-top"><b>The Crosby Coastal Park Forum - Admin Login</b></h1>

  </header>

  <!--Events tab -->
  <div class="w3-panel w3-green w3-animate-right">
    <h3>Admin Login Form</h3>
    <form action = "<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <input class="w3-input w3-margin-bottom" style="width:20%" placeholder="Username" input type="text" required name ="username">
    <input class="w3-input w3-margin-bottom" style="width:20%" placeholder="Password" input type="password" required name="password">
    <button class="w3-button w3-black w3-margin-bottom" input type="submit" value="login">Submit Login</button>
    </form>
    <p><?php echo $error; ?>
  </div>

  <!-- End page content -->
</div>


<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>
<script src ="index.js"></script>

</body>
</html>