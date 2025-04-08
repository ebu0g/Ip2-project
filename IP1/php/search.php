<?php
// Example array of data (Replace with your database query if needed)
$availableKeywords = [
    'Software',
    'Architecture',
    'Electrical',
    'Food science',
    'Biotechnology'
];

// Check if a search query is sent via GET
if (isset($_GET['q'])) {
    $query = $_GET['q'];
    $query = strtolower(trim($query)); // Clean up the input

    // Search for matching keywords
    $results = [];
    foreach ($availableKeywords as $keyword) {
        if (strpos(strtolower($keyword), $query) !== false) {
            $results[] = $keyword;
        }
    }

    // If there are results, return them
    if (count($results) > 0) {
        foreach ($results as $result) {
            echo "<li>" . htmlspecialchars($result) . "</li>";
        }
    } else {
        echo "";  
    }
}
?>
