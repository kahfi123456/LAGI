<?php
$password = 'admin123'; // Ganti dengan password yang ingin kamu hash
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);
echo $hashedPassword;
?>