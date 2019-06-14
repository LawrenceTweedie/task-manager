<?php
//получение данных из $_POST
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


//проверка данных
foreach($_POST as $input) {
    if(empty($input)) {
        include 'errors.php';
        exit;
    }
}

$pdo = new PDO('mysql:host=localhost;dbname=task-manager', 'tweedie', '3301');
$sql = 'SELECT id from users where email=:email';
$statement = $pdo->prepare($sql);
$statement->execute([':email'	=>	$email]);
$user = $statement->fetchColumn();
if($user) {
    $errorMessage = 'Пользователь с таким email уже существует';
    include 'errors.php';
    exit;
}

$sql = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
$statement = $pdo->prepare($sql);
$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
$result = $statement->execute($_POST);
if(!$result) {
    $errorMessage = 'Ошибка регистрации';
    include 'errors.php';
    exit;
}

header('Location: /login-form.php'); exit;
