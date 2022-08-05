<!DOCTYPE html>
<html>
<head>
<title>Crosby Coast Forum - Admin Create Event</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="index.css">
<?php include_once "config.php"; 
session_start();

$eventImg = "";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG & PNG files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $eventImg = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

// Define variables and initialize with empty values
$eventName = $eventDesc = $eventDate = $eventTime = "";
$error = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["eventName"]))) {
        $error = "Please enter a name for the event.";
    } else {
        // Prepare a select statement
        $sql = "SELECT eventID FROM crosbyEvent WHERE eventName = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_eventName);

            // Set parameters to be bound
            $param_eventName = trim($_POST["eventName"]);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // store the result of the excuting statement
                mysqli_stmt_store_result($stmt);
                // checks if the username already exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $error = "This event name has been taken, please use another";
                } else {
                    $eventName = trim($_POST["eventName"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Check input errors before inserting in database
    if (empty($error)) {

        // Prepare an insert statement, inserts the information into the adminaccount table in the database
        $sql = "INSERT INTO crosbyEvent (eventImg, eventName, eventDesc, eventDate, eventTime) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_eventImg, $param_eventName, $param_eventDesc, $param_eventDate, $param_eventTime);

            // Set parameters to be bound
            $param_eventName = trim($_POST["eventName"]);
            $param_eventDesc = trim($_POST["eventDesc"]);
            $param_eventDate = trim($_POST["eventDate"]);
            $param_eventTime = trim($_POST["eventTime"]);
            $param_eventImg =  $eventImg;

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to HOME page once account has been created
                header("location: adminHomePage.php");
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
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
</head>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-teal w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">Crosby Coastal Park Forum - Admin Create Event</span>
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
    <h1 class ="w3-animate-top"><b>The Crosby Coastal Park Forum - Admin Create Event</b></h1>

  </header>

  <!--Events tab -->
  <div class="w3-panel w3-green w3-animate-right">
    <h3>Event Creation Form</h3>
    <p> Use the form below to create an event </p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); "upload.php" ?>" method="post" enctype="multipart/form-data">
    <p><input class="w3-input w3-margin-bottom" style="width:20%" placeholder="Event Name" input type="text" name="eventName">
    <textarea class="w3-input w3-margin-bottom" style="width:20%" input type="text" name="eventDesc">Event Description</textarea></p>
    <p><b> Event Date and Time </b></p>
    <p><input class="w3-margin-right" type = "date" name="eventDate"><input input type="time" name="eventTime"></p>
    <input type="file" name="fileToUpload" id="fileToUpload"></p>
  <button class="w3-button w3-black w3-margin-bottom" input type="submit">Upload Event</button>
</form>



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