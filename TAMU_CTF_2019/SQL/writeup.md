# SQL

## Type: Secure Coding

## Points: 419

## Description:
>Now that you have broken the SQL Injection challenge it's your turn to fix it!
>
>To solve this challenge you must first fork the challenge and then modify the files in this repository and attempt to fix the vulnerability that you found.
>
>Everytime you make a commit your files are tested on the backend system. The results can be found under CI/CD->Jobs and then the last test ran.
>
>If you pass all of the tests the flag will be printed at the bottom of the CI/CD display. Otherwise you will either get an error or statement saying what happened.

The goal of this challenge, as stated in the description, is to fix the SQL injection bug that was seen in one of the other challenges.

One way to prevent SQL injection is with the use of prepared statements. Using PHP Data Objects (PDO) is method of implementing perpared statements here. By replacing the "User" and "Password" parameters with placeholders and setting their values outside the query, we are able to prevent SQL injection in this scenario and obtain the flag.

Main portion of login.php (before):
```
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $sql = "SELECT * FROM login WHERE User='$user' AND Password='$pass'";
    if ($result = $conn->query($sql))
    {
      if ($result->num_rows >= 1)
      {
        $row = $result->fetch_assoc(); 
        echo "You logged in as " . $row["User"];
        $row = $result->fetch_assoc();
        echo "<html>You logged in as " . $row["User"] . "</html>\n";
      }
      else {
        echo "Sorry to say, that's invalid login info!";
      }
    }
    $conn->close();

```

After:

```
    $conn = new PDO($servername, $username, $password);

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
```

Flag: `gigem{the_best_damn_sql_anywhere}`


### References:
* https://websitebeaver.com/php-pdo-prepared-statements-to-prevent-sql-injection