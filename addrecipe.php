<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect basic info
    $title = htmlspecialchars($_POST['title']);
    $servings = intval($_POST['servings']);
    $description = htmlspecialchars($_POST['description']);
    $prep_time = intval($_POST['prep_time']);
    $cook_time = intval($_POST['cook_time']);

    // Collect Dynamic Ingredients (Arrays)
    $ingredients = $_POST['ingredients'] ?? [];
    $qtys = $_POST['qtys'] ?? [];
    $units = $_POST['units'] ?? [];

    // Collect Dynamic Steps (Array)
    $steps = $_POST['steps'] ?? [];

    // Logic for Database Insertion (Example)
    /*
    $conn = new mysqli("localhost", "user", "pass", "flavourtrack");
    $stmt = $conn->prepare("INSERT INTO recipes (title, servings, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $title, $servings, $description);
    $stmt->execute();
    */

    // For demonstration: Output a success message
    echo "<h1>Recipe Saved Successfully!</h1>";
    echo "<p>Title: $title</p>";
    echo "<h3>Ingredients Count: " . count($ingredients) . "</h3>";
    
    // Redirect back after 3 seconds
    header("refresh:3;url=index.html");
} else {
    echo "Invalid Request";
}
?>