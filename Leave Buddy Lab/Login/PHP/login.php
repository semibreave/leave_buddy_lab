<?php
// Replace these with your MySQL database credentials
$host = 'localhost';
$DB_username = 'root';
$DB_password = 'H0l1dayz';
$database = 'leave_buddy';

// Function to connect to the database
function connectToDatabase($host, $username, $password, $database)
{
    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

// Function to perform the MySQL query
function runQuery($conn, $username, $password)
{
    $username = mysqli_real_escape_string($conn, $username); // Sanitize input to prevent SQL injection
    $password = mysqli_real_escape_string($conn, $password);

    // Assuming your table name is 'users'
    $query = "SELECT * FROM employees WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
 

      // Check if any rows were returned
      if (mysqli_num_rows($result) > 0) {
        
        $row = mysqli_fetch_assoc($result);
      
       $id = $row['ID'];
         return $id;

        
        
    } 
    
    else {
        
        
        return "Failed";
    }

    mysqli_close($conn);
}

// Check if the request method is POST (for form submission)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the submitted username and password from the POST data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform your authentication logic here (e.g., checking against a database)
    // For this example, let's assume the correct username and password are "ola"
    if (empty($_POST["username"]) || $password == "") {
        echo "Empty";
    } 
    
    else if (!empty($_POST["username"]) && !empty($_POST["password"])) {

        $conn = connectToDatabase($host, $DB_username, $DB_password, $database);
        $result = runQuery($conn, $username, $password);
        if ($result != null)
        {
            
            echo $result;
            
        } 
        else if($result == "Failed") {
            
            echo "Failed";
        }

    }

} 

else {
    // If the login form is accessed directly without a POST request, handle it accordingly
    // (e.g., display an error message or redirect to an error page)
   // echo "Please submit the login form.";
}



?>
