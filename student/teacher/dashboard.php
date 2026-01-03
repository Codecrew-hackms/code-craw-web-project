<?php
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'teacher'){
    header("Location: ../login1.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
</head>
<body>
<h2>Welcome Teacher <?php echo $_SESSION['name']; ?></h2>
<p>This is your dashboard. You can create courses here.</p>
<a href="../logout1.php">Logout</a>
</body>
</html>