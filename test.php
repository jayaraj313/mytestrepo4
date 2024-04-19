<?php
mysql_connect('localhost','username','password'); 
mysql_select_db('database');

if(isset($_POST['username']) && isset($_POST['password'])){
$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'";
$result = mysql_query($query); 

if(mysql_num_rows($result)){
echo "Logged in successfully!";
} else {
echo "Incorrect username or password.";
        }
}
?>

<form method="post" action="login.php">
<label for="username">Username:</label>
<input type="text" id="username" name="username">

<label for="password">Password:</label>
<input type="text" id="password" name="password">

<input type="submit" value="Log In">
</form>
