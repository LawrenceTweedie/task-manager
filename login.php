<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


foreach($_POST as $input) {
    if(empty($input)) {
        include 'errors.php';
        exit;
    }
}

$pdo = new PDO('mysql:host=localhost;dbname=task-manager', 'tweedie', '3301');
$sql = 'SELECT id, username, email from users where email=:email AND password=:password';
$statement = $pdo->prepare($sql);
$statement->execute([
    ':email'	=>	$email,
    ':password' => password_verify($password)
]);
$user = $statement->fetch(PDO::FETCH_ASSOC);