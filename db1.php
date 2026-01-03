<?php
$conn = new mysqli('localhost', 'root','','lmsdb' );
if(!$conn){
    echo "Error!: {$conn->connect_error}";
}
?>