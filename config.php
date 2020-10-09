<?php
phpinfo(); exit;
 if(session_status() == PHP_SESSION_NONE){
    //session has not started
    session_start();
}
  // connect with database
   // $servername = "localhost";
   // $username = "siteboos_sitebooster";
   // $password = "innerpeace628";
   // $dbname = "siteboos_generator";

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "siteboos_generator";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // Start a Session, You might start this somewhere else already.
  $link = $_SERVER['PHP_SELF'];
  $link_array = explode('/',$link);
  $page = end($link_array);
  
    
  if (!isset($_SESSION['loginfo']) && $page !== "index.php" ){
    header("Location: index.php");
    exit();
  }

  else if(isset($_SESSION['loginfo']) && $page == "index.php" ){
    header("Location: generate.php");
    exit();
}
?>