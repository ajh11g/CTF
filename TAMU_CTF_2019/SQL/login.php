<?php
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
  echo "<html>";
  if (isset($_POST["username"]) && isset($_POST["password"])) {
//    $servername = "localhost";
    $servername = "mysql:host=localhost;dbname=SqliDB";

    $username = "sqli-user";
    $password = 'AxU3a9w-azMC7LKzxrVJ^tu5qnM_98Eb';
    $dbname = "SqliDB";
//    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn = new PDO($servername, $username, $password);

//    if ($conn->connect_error)
//        die("Connection failed: " . $conn->connect_error);
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT User, Password FROM login WHERE User=? AND Password=? ";
    $query = $conn->prepare($sql);
    $query->execute(array($user,$pass));
    if($query->rowCount() >= 1) {
      echo "You are logged in as " . $user;
      echo "<html>You logged in as " . $user . "</html>\n";
    } else {
      echo "Sorry to say, that's invalid login info!";
    }

//    $sql = "SELECT * FROM login WHERE User='$user' AND Password='$pass'";
//    if ($result = $conn->query($sql))
//    {
//      if ($result->num_rows >= 1)
//      {
//        $row = $result->fetch_assoc(); 
//        echo "You logged in as " . $row["User"];
//        $row = $result->fetch_assoc();
//        echo "<html>You logged in as " . $row["User"] . "</html>\n";
//      }
//      else {
//        echo "Sorry to say, that's invalid login info!";
//      }
//    }
//    $conn->close();
    $conn=null;
  }
  else
    echo "Must supply username and password...";
  echo "</html>";
?>
