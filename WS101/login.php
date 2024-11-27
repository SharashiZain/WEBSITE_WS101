<?php
require_once 'db.connect.php';  // pangalan ng database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // dapat sa signup_tbl yan kasi wala naman saved data sa login e login nga diba 
    $sql = "SELECT Password, Name FROM signup_tbl WHERE Email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();  

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($stored_password, $name);
            $stmt->fetch();

            if ($password === $stored_password) {
                echo "Welcome, " . htmlspecialchars($name) . "!";
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No account found with this email.";
        }
        $stmt->close();  
    } else {
        echo "Error preparing statement: " . $conn->error;  
    }

    echo '<br><br><a href="index.html"><button>Return to Form</button></a>';
    $conn->close();  
}
?>
