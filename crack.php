<html>
<body>

<?php
echo "Hash: " . $_GET['hash'];
echo "</br><hr></br>";


$username = "bledd";
$password = "hiphop1234$";
$servername = "localhost";
$dbname = "RTPC";
echo "Searching for precomputed MD5 Hash...";
echo "</br></br>";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT PlainText FROM Rainbow_table WHERE MD5Hash='".$_GET['hash']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "Plain Text: " . $row["PlainText"]. "<br>";
  }
} else {
  echo "0 results";
}

echo "<hr></br>";
echo "Searching for precomputed SHA1 Hash...";
echo "</br></br>";
$sql = "SELECT PlainText FROM Rainbow_table WHERE SHA1Hash='".$_GET['hash']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "Plain Text: " . $row["PlainText"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
echo "</br><hr>";
?>

</body>
</html>
