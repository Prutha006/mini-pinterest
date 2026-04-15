<!DOCTYPE html>
<html>
<body>


<form method="GET">
    <input type="text" name="query" placeholder="Search pins...">
    <button type="submit">Search</button>
</form>

<hr>

<?php
$connect = new mysqli("localhost", "root", "", "mini_pinterest");

if (isset($_GET['query']) && $_GET['query'] != "") {
    $search = $_GET['query'];

    // Search results
    $sql = "SELECT * FROM posts 
            WHERE genre LIKE '%$search%' 
            OR description LIKE '%$search%'";
} else {
    // Random homepage
    $sql = "SELECT * FROM posts ORDER BY RAND()";
}

$result = $connect->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<img src='" . $row['image'] . "' width='200'><br>";
}
?>

</body>
</html>