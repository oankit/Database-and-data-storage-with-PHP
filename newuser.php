<!DOCTYPE html>
<html>
<?php
$host = "localhost";
$database = "lab9";
//$user = "webuser";
//$password = "P@ssw0rd";
$user = "dVader";
$password = "password";
$refURL = $_SERVER['HTTP_REFERER'];
$connection = mysqli_connect($host, $user, $password, $database);

//error handling
$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}
//request method and verify that parameters are set
else
{
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ( isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) 
  && isset($_POST['email']) && isset($_POST['password']) ) {
 $user = $_POST['username'];
 $firstname=  $_POST['firstname'];
 $lastname=  $_POST['lastname'];
 $email=  $_POST['email'];
 $password = $_POST['password'];
//check email
$check_email = mysqli_query($connection, "SELECT email FROM users where email = '$email' ");
//check username
$check_username = mysqli_query($connection, "SELECT username FROM users where username = '$user' ");

if(mysqli_num_rows($check_email) > 0){
  echo('User already exists with this name and/or email </br>');
  echo "<a href='".$refURL."'>Return to User Entry</a>";
 }
else{
  //hash password
  $password = md5($_POST['password']);

 $query = "INSERT INTO users (username , firstName ,lastName, email, password) VALUES('$user', ' $firstname', '$lastname', '$email', '$password')";
 $result = mysqli_query($connection, $query);
 echo('An account for the user '.$user.' has been created');
 
}
  }
}

mysqli_close($connection);

}








/*
try {
  //step 1 connection
  $connString = "mysql:host=localhost;dbname=lab9";
  //$user = "webuser";
  //$pass = "P@ssw0rd";
  $user = "dVader";
  $pass = "password";
  $refURL = $_SERVER['HTTP_REFERER'];
  $pdo = new PDO($connString,$user,$pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//step 2 validate the request type and make sure that all parameters are set
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ( isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) 
    && isset($_POST['email']) && isset($_POST['password']) ) {
   $validate= True;
   $user = $_POST['username'];
   $firstname=  $_POST['firstname'];
   $lastname=  $_POST['lastname'];
   $email=  $_POST['email'];
   $password = $_POST['password'];

   //$username = $pod->quote($username);
   $stmt1 = $pdo ->prepare("SELECT email FROM users where email = '$email' ");
   $stmt2 = $pdo ->prepare("SELECT username FROM users where username = '$user' ");
   //execute the statement
   $stmt1->bindParam(':email', $user, PDO::PARAM_STR);
   $stmt1->execute(); 
   $stmt1->bindParam(':email', $email, PDO::PARAM_STR);
   $stmt2->execute(); 
   //fetch result
   $check_email = $stmt1->fetch();
   $check_username = $stmt2->fetch();
   if($check_email || $check_username){
       echo('User already exists with this name and/or email');
       echo "<a href='".$refURL."'>Return to User Entry</a>";
   }
   else{
    $sql = "INSERT INTO 'users' (username , firstName ,lastName, email, password) 
  VALUES('$user', ' $firstname', '$lastname', '$email', '$password')";
  $result = $pdo->query($sql); //execute query
  //or $result = mysqli_query($connection,$query);
   }
    
  
    }
  
  while ($row = $result->fetch()) {
  echo $row['ID'] . " - " . $row['CategoryName'] . ",<br/>";
  } //process query
}

  
  $pdo = null;

}
  catch (PDOException $e) {
  die( $e->getMessage() );
  }
  */



    /* //good connection, so do your thing
    $sql = "SELECT * FROM users;";

    $results = mysqli_query($connection, $sql);

    //and fetch requsults
    while ($row = mysqli_fetch_assoc($results))
    {
      echo $row['username']." ".$row['firstName']." ".$row['lastName']." ".$row['email']." ".$row['password']."<br/>";
    }

    mysqli_free_result($results);
    mysqli_close($connection);
    */





?>

</html>