<?php
try {
    $dbh = new PDO("mysql:host=localhost;dbname=filmclub", "root", "");
    $id = $_GET['id'];
    $sql = "SELECT * FROM film WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $film = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($film) {
        echo 'Titel: ' . $film["titel"] . "<br>" . "Genre: " . $film['genre'] . "<br/>";
    } else {
        echo "Film not found.";
    }
} catch (PDOException $e) {
    echo "Error is: " . $e->getMessage();
}

echo "<a href='index.php'>BACK</a>";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Film</title>
</head>
<body>
<form method="post" action="">
    <label for="titel">New Titel</label>
    <input type="text" id="titel" name="titel" value="<?php echo htmlspecialchars($film['titel'] ?? ''); ?>"> <!-- Populate with current data -->

    <label for="genre">New Genre</label>
    <input type="text" id="genre" name="genre" value="<?php echo htmlspecialchars($film['genre'] ?? ''); ?>"> <!-- Populate with current data -->

    <input type="submit" name="send" value="bewerken">
    <button type="delete" name="delete" value="delete">Delete</button>
</form>

<?php
if (isset($_POST["send"])) {

    $titel = filter_input(INPUT_POST, 'titel', FILTER_SANITIZE_SPECIAL_CHARS);
    $titel = trim($titel);
    $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_SPECIAL_CHARS);
    $genre = trim($genre);


    if (empty($titel)) {
        echo "Please enter a title.<br>";
    }
    if (empty($genre)) {
        echo "Please enter a genre.<br>";
    }

    if (!empty($titel) && !empty($genre)) {
        try {
            $sth = $dbh->prepare("UPDATE film SET titel = :titel, genre = :genre WHERE id = :id");
            $sth->bindParam(':titel', $titel);
            $sth->bindParam(':genre', $genre);
            $sth->bindParam(':id', $id, PDO::PARAM_INT);

            if ($sth->execute()) {
                echo "<p>Data updated successfully!</p>";
                header("Location: index.php");
                exit();
            } else {
                echo "<p>Error: Unable to update data into the database.</p>";
            }
        } catch (PDOException $e) {
            echo "Error during query execution: " . $e->getMessage();
        }
    }
}

if (isset($_POST["delete"])) {
        $id = $_GET['id'];
        $dbh = new PDO("mysql:host=localhost;dbname=filmclub", "root", ""); // Assuming the database connection

        $sql = "DELETE FROM film WHERE id = :id";
        $sth = $dbh->prepare($sql);
        $sth->bindParam(':id', $id, PDO::PARAM_INT);

        if ($sth->execute()) {
            echo "Deleted successfully";
            header("Location: index.php");
            exit();
        } else {
            echo "Something went wrong, deletion failed.";
        }
}
?>

</body>
</html>
