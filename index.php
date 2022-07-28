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
<?php include_once "config.php"; ?>
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
    <h5>Menu</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="#ABOUT" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-anchor fa-fw"></i> About Crosby Beach</a>
    <a href="#EVENTS" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i> News / Events</a>
    <a href="#LOCATION" class="w3-bar-item w3-button w3-padding"><i class="fa fa-map fa-fw"></i> Location</a>
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

  <div id="ABOUT" class="w3-panel w3-animate-bottom">
    <h3>About</h3>
    <div id="crosbyInfo-el" class = "w3-half w3-green w3-card-4 w3-padding" onclick="displayCrosbyInfo();">
    <h5>Click for information on Crosby Beach</h5>
    </div>
    <div id="ironMenInfo-el" class = "w3-half w3-blue w3-card-4 w3-padding" onclick ="displayIronMenInfo()">
    <h5>Click for information about the Iron Men</h5>
    </div>
  </div>

  <!--Events tab -->
  <div id="EVENTS" class="w3-panel w3-dark-grey w3-padding-8 w3-animate-right">
    <h3>Events</h3>
     <?php
     $sql = "SELECT * FROM crosbyEvent";
     $result = mysqli_query($conn, $sql);

   if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      echo "<div class = 'w3-quarter w3-orange w3-card-4 w3-padding w3-animate-zoom  w3-margin-top w3-margin-bottom'>" . "<h4>" . "<b>" . $row["eventName"] . "</b>" . "</h4>" . "</p>" . "<p>" . $row["eventDesc"] . "</p>" . "<p>" . $row["eventDate"] . " at " . $row["eventTime"] . "<p>". "<button class='w3-black'>" . "Find out more" . "</button>" . "</div>";
     }
   }
   else{
      echo "0 results";
  }
 
  $conn->close();

    ?>
  </div>

  <!-- Location Tab -->
  <div id="LOCATION" class="w3-panel w3-animate-zoom w3-yellow w3-padding-32">
    <h3>Location</h3>
    <div class="w3-third w3-margin-right">
        <img src="Pictures/GoogleMapsLocation.jpg" style="width:100%">
        </div>
        <div class = "w3-half"> 
            <h5><b> Address : Cambridge Road or Mariners Road or Hall Road West, Crosby, Merseyside </b></h5>
            <h6><b>Travelling by car</b></h6>
            <p>On site parking - Free parking at Cambridge Road, Mariners Road and Hall Road car parks.</p>
            <h6><b>Travelling by train</b></h6>
            <p>Different parts of Crosby Beach can be reached by train via the Northern Line (Merseytravel) stopping at:</p>
              <ul><li>Waterloo Station: 3/4 mile walk</li>
              <li>Blundellsands & Crosby: 3/4 mile walk</li>
              <li>Hall Road: 2 Minute Walk</li></ul>
        </div>
  </div>

  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>Socials</h4>
    <p>Left blank intentionally</p>
  </footer>

  <!-- End page content -->
</div>
<script src="index.js"></script>
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