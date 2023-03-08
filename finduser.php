<!DOCTYPE html>
<html>
<?php
$host = "localhost";
$database = "lab9";
//$user = "webuser";
//$password = "P@ssw0rd";
$user = "dVader";
$password = "password";
$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}

else
{
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username'])) {
        $user = $_POST['username'];
        $check_exist = mysqli_query($connection, "SELECT username, firstname, lastname, email FROM users where username = '$user' ");
      //display table 
        if(mysqli_num_rows($check_exist) > 0){
            $row= mysqli_fetch_assoc($check_exist);
            $firstname= $row['firstname'];
             $lastname= $row['lastname'];
              $email= $row['email'];
            echo("<fieldset>
            <legend>User:".$user."</legend>
                <table>
                <tr>
                    <td>First Name: ".$firstname."</td>
                </tr>
                <tr>
                    <td>Last Name: ".$lastname."</td>
                </tr>
                <tr>
                <td>Email: ".$email."</td>
                </tr>
            </table>
            </fieldset>");
        }
        else{
            echo('user does not exist');
        }
    }
}
mysqli_close($connection);

}

?>


</html>