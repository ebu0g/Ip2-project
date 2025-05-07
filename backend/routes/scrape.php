<?php 
$host = 'localhost';
$db_name = 'department_recommendation';
$db_password = "@Hd36As85";
$db_user = "root";


$con = mysqli_connect($host, $db_user, $db_password, $db_name);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$html = file_get_contents('c:/Users/hp/OneDrive/Desktop/Ip2-project/frontend/department.html');
if (!$html) {
    die("Failed to fetch html content.");
}

$dom = new DOMDocument();
libxml_use_internal_errors(true);
$dom->loadHTML($html);
libxml_clear_errors();




$categories = $dom->getElementsByTagName('article');
foreach ($categories as $category){
    $name = $description = $highlight = $image_url = null;
    if($category->getAttribute('class') == 'department'){
        $name = $category->getElementsByTagName('h4')->item(0)->nodeValue;
        $description = $category->getElementsByTagName('p')->item(0)->nodeValue;
        $highlight = $category->getElementsByTagName('p')->item(1)->nodeValue;
        $image_url = $category->getElementsByTagName('img')->item(0)->getAttribute('src');
       

    }
   
    

    $stmt = $con->prepare("INSERT INTO departments (name, description, highlights, image_url) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $description, $highlight, $image_url);
    if ($stmt->execute()){
        echo "New record created successfully for department: $name\n";
    } else {
        echo "Error: " . $stmt->error . "\n";       
    }
    $stmt->close(); // Close the statement after each execution

    
}

?>

