
<html>
<body>

<form action="insert.php" method="post">
    Titel: <input type="text" name="titel"><br>
    Genre: <input type="text" name="genre"><br>
    <input type ="submit">
</form>
</body>
</html>

<?php

$titel = $_POST['titel'];
$genre = $_POST['genre'];

$conn = new mysqli("localhost", "root", "", "filmclub");
$sql = "SELECT * FROM film";

if ($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

$sql = "insert into film(titel,genre) values('$titel','$genre')";

if ($conn->query($sql) === TRUE) {
    echo "ADDED: ".$titel.", ".$genre;
} else {
    echo "Error: ".$sql."<br>".$conn->error;
}

$conn->close();

?>