<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    @$username = $_POST['username'];
    @$hearing = $_POST['hearing'];
    @$gender = $_POST['gender'];
    @$phone = $_POST['phone'];
    @$email = $_POST['email'];
    @$dob = $_POST['dob'];
    @$nid = $_POST['nid'];
    @$passward = $_POST['passward'];
    @$confirmPassword = $_POST['confirmPassword'];
    
     if(@$passward == @$confirmPassword)
     {
        
           $hashedPassword = password_hash($passward, PASSWORD_DEFAULT);
           echo "Passwords match SuccessFully\n";

     }

    $conn = new mysqli('localhost', 'root', '', 'survey_response');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO survey_response (username, hearing, gender, phone, email, dob, nid, passward, confirmPassword) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssississ", $username, $hearing, $gender, $phone, $email, $dob, $nid, $hashedPassword, $confirmPassword);
        if ($stmt->execute()) {
            echo "Registration Successful...";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
}
?>
