<!DOCTYPE html>
<html>
<head>
<title>Crosby Coast Forum</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="index.css">
<?php include_once "config.php"; 
session_start();
if (isset($_GET['eventid'])) {
    $eventid = $_SESSION["eventid"] = $_GET['eventid'];
} else {
    $eventid = $_SESSION["eventid"];
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
  <span class="w3-bar-item w3-right">Crosby Coastal Park Forum</span>
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
    <a href="index.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-back fa-fw"></i> Return</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->

<div class="w3-main" style="margin-left:250px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h1 class ="w3-animate-top"><b>The Crosby Coastal Park Forum</b></h1>

  </header>

  <!--Events tab -->
  <div class="w3-panel w3-yellow w3-animate-right">
  <?php
     $sql = "SELECT * FROM crosbyEvent WHERE eventID = $eventid";
     $result = mysqli_query($conn, $sql);
   if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){    
      echo $row['eventImg'];
    echo "<div class='w3-third w3-margin'>" . "<img src='uploads/'". $row['eventImg'] .  "style='width:100%'>" . "</div>"; 
    echo "<div class = 'w3-half'>" . "<h2>" . $row['eventName'] . "</h2>" . "<p>" ."<h4>" . "Description:". "</h4>" . "</p>" . "<p>" . $row['eventDesc'] . "</p>" . "<p>" . "<h4>" . "Date:" . "</h4>" . $row['eventDate'] . " at " . $row['eventTime'] . "</p>" . "<a class='w3-button w3-black w3-margin-bottom' href=''>" . "Contact the Event Organiser" . "</a>" . "</div>";
}
   }
   else{
      echo "<h2>" . "You have attempted to reach this page before selecting an event!" . "</h2>";
  }
 
  $conn->close();

    ?>
<img src="uploads/ $row['eventImg']" style='width:100%'>
  </div>

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>Socials</h4>
    <p>Left blank intentionally</p>
  </footer>

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