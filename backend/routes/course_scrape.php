
<?php 
$host = 'localhost';
$db_name = 'department_recommendation';
$db_password = "@Hd36As85";
$db_user = "root";

$con = mysqli_connect($host, $db_user, $db_password, $db_name);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$html = file_get_contents('c:/Users/hp/OneDrive/Desktop/Ip2-project/frontend/data.html');
if (!$html) {
    die("Failed to fetch HTML content.");
}

$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML($html);
libxml_clear_errors();

// Use DOMXPath to navigate the table rows
$xpath = new DOMXPath($dom);
$rows = $xpath->query("//table/tbody/tr");

foreach ($rows as $row) {
    $cols = $row->getElementsByTagName('td');
    if ($cols->length < 6) {
        // Skip incomplete rows silently
        continue;
    }

    $year = $cols->item(0) ? trim($cols->item(0)->nodeValue) : "N/A";
    $semester = $cols->item(1) ? trim($cols->item(1)->nodeValue) : "N/A";
    $course_code = $cols->item(2) ? trim($cols->item(2)->nodeValue) : "N/A";
    $course_Title = $cols->item(3) ? trim($cols->item(3)->nodeValue) : "N/A";
    $credit_hours = $cols->item(4) ? trim($cols->item(4)->nodeValue) : "N/A";
    $description = $cols->item(5) ? trim($cols->item(5)->nodeValue) : "N/A";

    echo "Year: $year\n";
    echo "Semester: $semester\n";
    echo "Course Code: $course_code\n";
    echo "Course Title: $course_Title\n";
    echo "Credit Hours: $credit_hours\n";
    echo "Description: $description\n\n";

    // Check if the course already exists
    $check_query = $con->prepare("SELECT id FROM courses WHERE name = ?");
    $check_query->bind_param("s", $course_Title);
    $check_query->execute();
    $check_query->store_result();

    if ($check_query->num_rows > 0) {
        echo "Skipping duplicate course: $course_Title\n";
    } else {
        // Insert the course if it doesn't exist
        $stmt = $con->prepare("INSERT INTO courses (year, semester, course_code, name, credit_hours, description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $year, $semester, $course_code, $course_Title, $credit_hours, $description);
        if ($stmt->execute()) {
            echo "New record created successfully for course: $course_Title\n";
        } else {
            echo "Error: " . $stmt->error . "\n";       
        }
        $stmt->close(); // Close the statement after each execution
    }
    $check_query->close(); // Close the check query
}
?>