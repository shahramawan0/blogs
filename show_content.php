<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "blogger");

$sql = "SELECT content FROM posts WHERE id = 2"; // Adjust the query as needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo $row["content"];
    }
} else {
    echo "No content found.";
}

$conn->close();
?>
