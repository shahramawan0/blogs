<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "blogger");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Save the content
    $content = $conn->real_escape_string($_POST['content']);
    $sql = "INSERT INTO posts (content) VALUES ('$content')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
