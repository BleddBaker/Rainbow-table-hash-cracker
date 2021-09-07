<html>
<body>

<?php
echo "Plain Text: " . $_GET['plain'];
echo "</br>";
echo "MD5 Hash: " . md5($_GET['plain']);
echo "</br>";
echo "SHA1 Hash: " . sha1($_GET['plain']);
echo "</br>";

$username = "bledd";
$password = "hiphop1234$";
$servername = "localhost";
$dbname = "RTPC";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Rainbow_table WHERE PlainText='".$_GET['plain']."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "Hashes already in database<br>";
  }
} else {
  $sql = "INSERT INTO Rainbow_table (PlainText, MD5Hash, SHA1Hash) VALUES ('" . $_GET['plain']."' , '".md5($_GET['plain'])."' , '".sha1($_GET['plain'])."' )";

  if ($conn->query($sql) === TRUE) {
    echo "Hashes precomupted and added to Rainbow Table successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
echo "</br><hr>";

?>

</body>
</html>
