<?php 
require_once __DIR__ . '/../src/bootstrap.php';

$email = trim(readline("Enter admin email: "));
$password = readline("Enter admin password: ");

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        exit ("Invalid email format. Please try again.\n");
}
if(mb_strlen($password) < 8){
    exit ("Password must be at least 8 characters long. Please try again.\n");
}
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = db() -> prepare('INSERT INTO admins (email, password_hash) VALUES (:email, :hash)');
$stmt -> execute(['email' => $email, 'hash' => $hash]);

echo "Admin user created successfully: $email\n";

?>