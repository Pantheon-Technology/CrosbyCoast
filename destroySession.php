<?php
// starts a new session
session_start();

// Unset all of the session data created when logging in
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to the home page
header("location: adminLogin.php");
exit();
?>