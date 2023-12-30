<?php 
$dirty_name = '<script>alert("Malicious Script!");</script>John Doe';
// Sanitize the dirty input
$sanitized_name = htmlspecialchars($dirty_name, ENT_QUOTES, 'UTF-8');
// Display the sanitized name
echo "Sanitized Name: " . $sanitized_name;

?>