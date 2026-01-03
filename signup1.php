<?php
include("db1.php");

if(isset($_POST['signup'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // 1. Check if email exists using Prepared Statements
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $check = $stmt->get_result();

    if($check->num_rows > 0){
        $error = "Email already exists!";
    } else {
        // 2. HASH the password before saving it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // 3. Insert user into database
        $insert = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $insert->bind_param("ssss", $name, $email, $hashed_password, $role);
        
        if($insert->execute()){
            $success = "Signup successful! You can login now.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h2>LMS Sign Up</h2>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <?php if(isset($success)) echo "<p style='color:green'>$success</p>"; ?>

    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role" required>
            <option value="">Select Role</option>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select>
        <button type="submit" name="signup">Sign Up</button>
        <br>
        <a href="login1.php">Already have an account? Login</a>
    </form>
</body>
</html>