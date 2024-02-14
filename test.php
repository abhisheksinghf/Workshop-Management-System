<?php
$username = 'qwertyio';
$password = 'weareteamqio@123';

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

echo "Encrypted Username: $username <br>";
echo "Encrypted Password: $hashedPassword";
?>
